@extends('layouts.app')
@php
    $pageTitle = 'Khoa / Bộ phận';
    $breadcrumbs = [['label' => 'Khoa / Bộ phận']];
@endphp

@section('content')
<div class="space-y-4">
    {{-- Page Header --}}
    <div class="flex items-end justify-between flex-wrap gap-3">
        <div>
            <h1 class="text-[22px] font-semibold tracking-tight">Khoa / Bộ phận</h1>
            <p class="text-xs text-muted-foreground mt-0.5">Quản lý các khoa và bộ phận tổ chức sự kiện</p>
        </div>
        <button onclick="document.getElementById('newDepartmentModal').classList.remove('hidden')" class="inline-flex items-center gap-1.5 h-11 px-5 text-sm font-semibold bg-primary text-primary-foreground hover:bg-primary/90 rounded-xl transition-all shadow-sm">
            <i data-lucide="plus" class="h-5 w-5"></i> Khoa/Bộ phận mới
        </button>
    </div>

    @php
    $palettes = [
        'from-blue-500/20 to-blue-500/5 text-blue-600',
        'from-emerald-500/20 to-emerald-500/5 text-emerald-600',
        'from-amber-500/20 to-amber-500/5 text-amber-600',
        'from-violet-500/20 to-violet-500/5 text-violet-600',
        'from-rose-500/20 to-rose-500/5 text-rose-600',
        'from-cyan-500/20 to-cyan-500/5 text-cyan-600',
    ];
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
        @forelse($departments as $i => $dept)
        <div class="bg-card rounded-lg border border-border p-4 shadow-none flex flex-col gap-3">
            <div class="flex items-start justify-between">
                <div class="h-9 w-9 rounded-md bg-gradient-to-br grid place-items-center {{ $palettes[$i % count($palettes)] }}">
                    <i data-lucide="building" class="h-4 w-4"></i>
                </div>
                <div class="flex items-center gap-1">
                    <a href="{{ route('admin.departments.edit', $dept) }}" class="h-9 w-9 rounded-lg flex items-center justify-center text-muted-foreground hover:bg-accent hover:text-foreground transition-all" title="Sửa">
                        <i data-lucide="pencil" class="h-4 w-4"></i>
                    </a>
                </div>
            </div>
            <div>
                <div class="text-sm font-semibold flex items-center gap-1.5">
                    <span>{{ $dept->name }}</span>
                </div>
                <div class="text-[11px] text-muted-foreground mt-0.5">Slug: /{{ Str::slug($dept->name) }}</div>
            </div>
            <div class="flex items-center justify-between pt-2 border-t border-border">
                <div>
                    <div class="text-lg font-semibold tabular-nums">{{ $dept->events_count }}</div>
                    <div class="text-[11px] text-muted-foreground">sự kiện</div>
                </div>
                <div class="text-right">
                    <div class="text-lg font-semibold tabular-nums">{{ number_format($dept->total_views ?? 0) }}</div>
                    <div class="text-[11px] text-muted-foreground">lượt xem</div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-12 text-center bg-card rounded-lg border border-border shadow-none">
            <i data-lucide="building" class="h-10 w-10 text-muted-foreground/30 mx-auto mb-3"></i>
            <p class="text-sm text-muted-foreground">Chưa có khoa hoặc bộ phận nào.</p>
        </div>
        @endforelse
    </div>
</div>

{{-- New Department Modal --}}
<div id="newDepartmentModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center hidden">
    <div class="bg-card border border-border rounded-xl shadow-lg w-full max-w-md p-6 space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="text-sm font-bold text-foreground">Thêm khoa/bộ phận mới</h3>
            <button onclick="document.getElementById('newDepartmentModal').classList.add('hidden')" class="text-muted-foreground hover:text-foreground">
                <i data-lucide="x" class="h-4 w-4"></i>
            </button>
        </div>
        <form action="{{ route('admin.departments.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="space-y-2">
                <label for="new_name" class="text-xs font-semibold text-foreground">Tên khoa / bộ phận</label>
                <input type="text" name="name" id="new_name" required class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm focus:outline-none focus:ring-1 focus:ring-ring" />
            </div>
            <div class="flex justify-end gap-2.5 pt-4 border-t border-border">
                <button type="button" onclick="document.getElementById('newDepartmentModal').classList.add('hidden')" class="h-9 px-4 rounded-md text-xs font-medium border border-input bg-background hover:bg-accent">Hủy</button>
                <button type="submit" class="h-9 px-4 rounded-md text-xs font-medium bg-primary text-primary-foreground hover:bg-primary/90 shadow">Lưu</button>
            </div>
        </form>
    </div>
</div>
@endsection
