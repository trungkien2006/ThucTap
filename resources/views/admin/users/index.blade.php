@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-foreground font-heading leading-tight">Danh sách tài khoản Admin</h1>
            <p class="text-xs text-muted-foreground mt-1">Quản lý các tài khoản quản trị viên trong hệ thống (chỉ hiển thị cho Admin gốc).</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center justify-center rounded-lg text-xs font-semibold bg-primary text-primary-foreground shadow hover:bg-primary/90 h-9 px-4 gap-1.5 transition-all">
            <i data-lucide="plus" class="h-4 w-4"></i>
            Tạo tài khoản mới
        </a>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="flex items-center gap-2.5 p-3.5 text-xs text-emerald-800 bg-emerald-50 dark:bg-emerald-950/20 dark:text-emerald-400 rounded-xl border border-emerald-100 dark:border-emerald-900/30">
            <i data-lucide="check-circle-2" class="h-4 w-4"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="flex items-center gap-2.5 p-3.5 text-xs text-rose-800 bg-rose-50 dark:bg-rose-950/20 dark:text-rose-400 rounded-xl border border-rose-100 dark:border-rose-900/30">
            <i data-lucide="alert-circle" class="h-4 w-4"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <div class="bg-card rounded-xl border border-border shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-border bg-muted/40">
                        <th class="h-10 px-4 font-semibold text-xs text-muted-foreground w-12">#</th>
                        <th class="h-10 px-4 font-semibold text-xs text-muted-foreground">Họ và tên</th>
                        <th class="h-10 px-4 font-semibold text-xs text-muted-foreground">Email</th>
                        <th class="h-10 px-4 font-semibold text-xs text-muted-foreground">Quyền hạn</th>
                        <th class="h-10 px-4 font-semibold text-xs text-muted-foreground">Ngày tạo</th>
                        <th class="h-10 px-4 font-semibold text-xs text-muted-foreground text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse($users as $index => $user)
                        <tr class="hover:bg-muted/30 transition-colors">
                            <td class="p-4 text-xs">{{ $index + 1 }}</td>
                            <td class="p-4">
                                <div class="font-medium text-foreground text-xs">{{ $user->name }}</div>
                            </td>
                            <td class="p-4 text-xs text-muted-foreground">{{ $user->email }}</td>
                            <td class="p-4">
                                <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[10px] font-semibold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                    Sub Admin
                                </span>
                            </td>
                            <td class="p-4 text-xs text-muted-foreground">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                            <td class="p-4 text-right">
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xoá tài khoản này không? Mọi dữ liệu do họ tạo vẫn sẽ được giữ lại.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center rounded-md text-xs font-medium text-destructive hover:text-destructive hover:bg-destructive/10 h-8 px-3 transition-colors" title="Xoá tài khoản">
                                        <i data-lucide="trash-2" class="h-4 w-4 mr-1.5"></i> Xoá
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-muted-foreground text-xs">
                                <div class="flex flex-col items-center justify-center space-y-3">
                                    <i data-lucide="users" class="h-10 w-10 text-muted/50"></i>
                                    <p>Chưa có tài khoản Sub Admin nào được tạo.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
