<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventRegistered;

class PublicRegistrationController extends Controller
{
    public function store(Request $request, Event $event)
    {
        if (!$event->registration_open) {
            return back()->with('error', 'Sự kiện này đã đóng đăng ký.');
        }

        if ($event->max_attendees && $event->registrations()->count() >= $event->max_attendees) {
            return back()->with('error', 'Sự kiện đã đạt số lượng người tham gia tối đa.');
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'student_id' => 'nullable|string|max:50',
            'department' => 'nullable|string|max:100',
        ]);

        // Check if email already registered for this event
        if (Registration::where('event_id', $event->id)->where('email', $validated['email'])->exists()) {
            return back()->with('error', 'Email này đã đăng ký tham gia sự kiện này rồi.');
        }

        $validated['event_id'] = $event->id;
        $validated['confirmation_token'] = Str::random(60);
        $validated['email_confirmed'] = false;

        $registration = Registration::create($validated);

        // Send confirmation email
        Mail::to($registration->email)->send(new EventRegistered($registration));

        return back()->with('success', 'Đăng ký thành công! Vui lòng kiểm tra email của bạn để xác nhận và nhận mã QR Check-in.');
    }

    public function confirm($token)
    {
        $registration = Registration::where('confirmation_token', $token)->firstOrFail();

        if (!$registration->email_confirmed) {
            $registration->email_confirmed = true;
            $registration->save();
        }

        return view('events.registration-success', compact('registration'));
    }
}
