<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminUserController extends Controller
{
    /**
     * Hiển thị danh sách tài khoản Admin.
     */
    public function index()
    {
        abort_unless(auth()->user()->isSuperAdmin(), 403, 'Chỉ Admin gốc mới có quyền xem danh sách này.');

        // Hiển thị danh sách tất cả tài khoản trừ tài khoản gốc đang đăng nhập
        $users = User::where('id', '!=', auth()->id())->orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Hiển thị form tạo tài khoản admin mới.
     */
    public function create()
    {
        abort_unless(auth()->user()->isSuperAdmin(), 403, 'Chỉ Admin gốc mới có quyền tạo tài khoản.');
        return view('admin.users.create');
    }

    /**
     * Xử lý dữ liệu và tạo tài khoản.
     */
    public function store(Request $request)
    {
        abort_unless(auth()->user()->isSuperAdmin(), 403, 'Chỉ Admin gốc mới có quyền tạo tài khoản.');

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin', // Gán quyền admin (hệ thống tự phân biệt Super Admin qua email)
        ]);

        return back()->with('success', 'Tạo tài khoản Sub Admin mới thành công! (' . $user->email . ')');
    }

    /**
     * Xoá tài khoản Admin.
     */
    public function destroy(User $user)
    {
        abort_unless(auth()->user()->isSuperAdmin(), 403, 'Chỉ Admin gốc mới có quyền xoá tài khoản.');
        
        // Không cho phép xoá tài khoản gốc (nếu lỡ truyền ID lên)
        if ($user->email === 'admin@school.edu') {
            return back()->with('error', 'Không thể xoá tài khoản Admin gốc!');
        }

        $user->delete();
        return back()->with('success', 'Đã xoá tài khoản thành công!');
    }
}
