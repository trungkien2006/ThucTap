@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-xl font-bold text-foreground font-heading leading-tight">Cài đặt tài khoản</h1>
        <p class="text-xs text-muted-foreground mt-1">Quản lý thông tin cá nhân và cài đặt bảo mật cho tài khoản của bạn</p>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="flex items-center gap-2.5 p-3.5 text-xs text-emerald-800 bg-emerald-50 dark:bg-emerald-950/20 dark:text-emerald-400 rounded-xl border border-emerald-100 dark:border-emerald-900/30">
            <i data-lucide="check-circle-2" class="h-4 w-4"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if(session('status') === 'password-updated')
        <div class="flex items-center gap-2.5 p-3.5 text-xs text-emerald-800 bg-emerald-50 dark:bg-emerald-950/20 dark:text-emerald-400 rounded-xl border border-emerald-100 dark:border-emerald-900/30">
            <i data-lucide="check-circle-2" class="h-4 w-4"></i>
            <span>Mật khẩu đã được thay đổi thành công.</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Update Profile Card -->
        <div class="bg-card rounded-xl border border-border p-5 shadow-sm space-y-4">
            <div class="flex items-center gap-2 pb-3 border-b border-border">
                <i data-lucide="user" class="h-5 w-5 text-primary"></i>
                <h2 class="text-sm font-bold text-foreground">Thông tin cá nhân</h2>
            </div>
            
            <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-xs font-semibold text-foreground mb-1.5" for="name">Họ và tên <span class="text-red-400">*</span></label>
                    <input class="flex h-10 w-full rounded-lg border border-input px-3 text-xs bg-muted/40 focus:outline-none focus:border-ring transition-all" id="name" name="name" value="{{ old('name', $user->name) }}" required type="text"/>
                    @error('name') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-foreground mb-1.5" for="email">Địa chỉ Email <span class="text-red-400">*</span></label>
                    <input class="flex h-10 w-full rounded-lg border border-input px-3 text-xs bg-muted/40 focus:outline-none focus:border-ring transition-all" id="email" name="email" value="{{ old('email', $user->email) }}" required type="email"/>
                    @error('email') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit" class="inline-flex items-center justify-center rounded-lg text-xs font-semibold bg-primary text-primary-foreground shadow hover:bg-primary/90 h-9 px-4 gap-1.5 hover:scale-[1.02] active:scale-[0.98] transition-all">
                        <i data-lucide="save" class="h-4 w-4"></i>
                        Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>

        <!-- Update Password Card -->
        <div class="bg-card rounded-xl border border-border p-5 shadow-sm space-y-4">
            <div class="flex items-center gap-2 pb-3 border-b border-border">
                <i data-lucide="lock" class="h-5 w-5 text-primary"></i>
                <h2 class="text-sm font-bold text-foreground">Đổi mật khẩu</h2>
            </div>
            
            <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-xs font-semibold text-foreground mb-1.5" for="update_password_current_password">Mật khẩu hiện tại</label>
                    <input class="flex h-10 w-full rounded-lg border border-input px-3 text-xs bg-muted/40 focus:outline-none focus:border-ring transition-all" id="update_password_current_password" name="current_password" type="password" required autocomplete="current-password"/>
                    @error('current_password', 'updatePassword') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-foreground mb-1.5" for="update_password_password">Mật khẩu mới</label>
                    <input class="flex h-10 w-full rounded-lg border border-input px-3 text-xs bg-muted/40 focus:outline-none focus:border-ring transition-all" id="update_password_password" name="password" type="password" required autocomplete="new-password"/>
                    @error('password', 'updatePassword') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-foreground mb-1.5" for="update_password_password_confirmation">Xác nhận mật khẩu mới</label>
                    <input class="flex h-10 w-full rounded-lg border border-input px-3 text-xs bg-muted/40 focus:outline-none focus:border-ring transition-all" id="update_password_password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"/>
                    @error('password_confirmation', 'updatePassword') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit" class="inline-flex items-center justify-center rounded-lg text-xs font-semibold bg-primary text-primary-foreground shadow hover:bg-primary/90 h-9 px-4 gap-1.5 hover:scale-[1.02] active:scale-[0.98] transition-all">
                        <i data-lucide="key-round" class="h-4 w-4"></i>
                        Cập nhật mật khẩu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
