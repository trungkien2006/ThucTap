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

        if ($registration->checked_in) {
            return view('admin.checkin.success', [
                'registration' => $registration,
                'status' => 'already_checked_in',
                'message' => 'Sinh viên này ĐÃ ĐIỂM DANH TRƯỚC ĐÓ vào lúc ' . $registration->checked_in_at->format('H:i d/m/Y')
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
        $registration->checked_in = true;
        $registration->checked_in_at = now();
        $registration->save();

        return view('admin.checkin.success', [
            'registration' => $registration,
            'status' => 'success',
            'message' => 'ĐIỂM DANH THÀNH CÔNG!'
        ]);
    }
}
