<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $oldName = $user->name;
        $oldEmail = $user->email;
        
        $user->fill($request->validated());

        $changes = [];
        if ($user->isDirty('name')) {
            $changes[] = "Thay đổi họ tên từ '{$oldName}' thành '{$user->name}'";
        }
        
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
            $changes[] = "Thay đổi email từ '{$oldEmail}' thành '{$user->email}'";
        }

        $user->save();

        foreach ($changes as $change) {
            $this->logActivity($user->id, $change);
        }

        return Redirect::route('admin.profile.edit')->with('success', 'Đã cập nhật thông tin hồ sơ thành công.');
    }

    /**
     * Show activity log.
     */
    public function activity(Request $request): View
    {
        $path = storage_path('app/profile_activities.json');
        
        $activities = [];
        if (file_exists($path)) {
            $content = file_get_contents($path);
            $allActivities = json_decode($content, true) ?: [];
            // Sort by created_at desc
            usort($allActivities, function($a, $b) {
                return strcmp($b['created_at'], $a['created_at']);
            });
            $activities = $allActivities;
        }

        return view('profile.activity', compact('activities'));
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Helper to log profile activities to JSON
     */
    private function logActivity($userId, $activityDescription)
    {
        $path = storage_path('app/profile_activities.json');
        
        $activities = [];
        if (file_exists($path)) {
            $content = file_get_contents($path);
            $activities = json_decode($content, true) ?: [];
        }
        
        $activities[] = [
            'user_id' => $userId,
            'activity' => $activityDescription,
            'created_at' => now()->toDateTimeString(),
        ];
        
        $dir = dirname($path);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        
        file_put_contents($path, json_encode($activities, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}
