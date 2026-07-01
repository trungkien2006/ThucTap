<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => $validated['password'],
        ]);

        // Log activity
        $path = storage_path('app/profile_activities.json');
        $activities = [];
        if (file_exists($path)) {
            $content = file_get_contents($path);
            $activities = json_decode($content, true) ?: [];
        }
        $activities[] = [
            'user_id' => $request->user()->id,
            'activity' => 'Thay đổi mật khẩu tài khoản',
            'created_at' => now()->toDateTimeString(),
        ];
        $dir = dirname($path);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        file_put_contents($path, json_encode($activities, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return back()->with('status', 'password-updated');
    }
}
