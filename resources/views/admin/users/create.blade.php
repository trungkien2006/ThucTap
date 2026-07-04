@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex flex-col gap-1">
        <h1 class="text-xl font-bold text-foreground font-heading leading-tight">Tạo tài khoản Admin</h1>
        <p class="text-xs text-muted-foreground">Thêm một tài khoản quản trị viên (Sub Admin) mới vào hệ thống.</p>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="flex items-center gap-2.5 p-3.5 text-xs text-emerald-800 bg-emerald-50 dark:bg-emerald-950/20 dark:text-emerald-400 rounded-xl border border-emerald-100 dark:border-emerald-900/30">
            <i data-lucide="check-circle-2" class="h-4 w-4"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-card rounded-xl border border-border shadow-sm overflow-hidden">
        <form method="POST" action="{{ route('admin.users.store') }}" class="p-6 space-y-4">
            @csrf

            <!-- Name -->
            <div class="space-y-1.5">
                <label for="name" class="text-xs font-semibold text-foreground">Họ và tên</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                    class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-xs shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50">
                @error('name')
                    <p class="text-[11px] text-destructive mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="space-y-1.5">
                <label for="email" class="text-xs font-semibold text-foreground">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                    class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-xs shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50">
                @error('email')
                    <p class="text-[11px] text-destructive mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="space-y-1.5">
                <label for="password" class="text-xs font-semibold text-foreground">Mật khẩu</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-xs shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50">
                @error('password')
                    <p class="text-[11px] text-destructive mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="space-y-1.5">
                <label for="password_confirmation" class="text-xs font-semibold text-foreground">Xác nhận mật khẩu</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                    class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-xs shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50">
                @error('password_confirmation')
                    <p class="text-[11px] text-destructive mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4 flex items-center justify-end">
                <button type="submit" class="inline-flex items-center justify-center rounded-md text-xs font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground shadow hover:bg-primary/90 h-9 px-4 py-2">
                    Tạo tài khoản
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
