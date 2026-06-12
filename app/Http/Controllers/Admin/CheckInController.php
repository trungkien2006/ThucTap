<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;

class CheckInController extends Controller
{
    public function scan($token)
    {
        $registration = Registration::where('confirmation_token', $token)->firstOrFail();

        $latestCheckin = $registration->checkins()->latest('checked_in_at')->first();

        if ($latestCheckin && $latestCheckin->checked_in_at->diffInMinutes(now()) < 5) {
            return view('admin.checkin.success', [
                'registration' => $registration,
                'status' => 'warning',
                'title' => 'Thao Tác Quá Nhanh',
                'message' => 'Sinh viên này vừa điểm danh cách đây ít phút vào lúc ' . $latestCheckin->checked_in_at->format('H:i d/m/Y') . '. Vui lòng thử lại sau.'
            ]);
        }

        if (!$registration->email_confirmed) {
            return view('admin.checkin.success', [
                'registration' => $registration,
                'status' => 'not_confirmed',
                'message' => 'LỖI: Sinh viên này chưa xác nhận Email đăng ký!'
            ]);
        }

        // Proceed to check in
        $registration->checkins()->create([
            'checked_in_at' => now(),
        ]);

        $count = $registration->checkins()->count();

        return view('admin.checkin.success', [
            'registration' => $registration,
            'status' => 'success',
            'message' => $count > 1 ? "ĐIỂM DANH THÀNH CÔNG (Lần $count)!" : 'ĐIỂM DANH THÀNH CÔNG!'
        ]);
    }
}
