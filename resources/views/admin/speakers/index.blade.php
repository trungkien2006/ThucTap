@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
    <div>
        <h1 class="text-[24px] font-bold text-primary font-heading leading-tight">Quản lý Diễn giả</h1>
        <p class="text-[13px] text-slate-400 mt-1">Thêm, chỉnh sửa và quản lý danh sách diễn giả cho sự kiện.</p>
    </div>
    <a href="{{ route('admin.speakers.create') }}" class="btn-primary flex items-center gap-2 w-fit">
        <span class="material-symbols-outlined text-[18px]">person_add</span>
        Thêm diễn giả
    </a>
</div>

<!-- Search -->
<div class="uni-card p-4 mb-6">
    <form method="GET" class="flex items-center gap-3">
        <div class="relative flex-1">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-400 text-[18px]">search</span>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm diễn giả theo tên..." class="uni-input pl-10"/>
        </div>
        <button type="submit" class="btn-primary py-2.5">Tìm kiếm</button>
    </form>
</div>

<!-- Speakers Grid -->
@if($speakers->count() > 0)
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 mb-8">
    @foreach($speakers as $speaker)
    <div class="uni-card-hover overflow-hidden">
        <div class="h-48 bg-slate-100 overflow-hidden">
            @if($speaker->photo_url)
                <a href="{{ route('admin.speakers.edit', $speaker) }}" class="block w-full h-full">
                    <img src="{{ $speaker->photo_url }}" alt="{{ $speaker->name }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                </a>
            @else
                <a href="{{ route('admin.speakers.edit', $speaker) }}" class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 hover:opacity-80 transition-opacity">
                    <span class="material-symbols-outlined text-[48px] text-slate-300">person</span>
                </a>
            @endif
        </div>
        <div class="p-4">
            <h3 class="text-[14px] font-bold text-primary font-heading mb-1">{{ $speaker->name }}</h3>
            <p class="text-[12px] text-slate-400 line-clamp-2">{{ Str::limit($speaker->bio, 80) ?? 'Chưa có thông tin' }}</p>

            <div class="flex items-center gap-2 mt-3 pt-3 border-t border-slate-100">
                <span class="text-[11px] text-slate-400">{{ $speaker->events()->count() }} sự kiện</span>
                <div class="flex-1"></div>
                <a href="{{ route('admin.speakers.edit', $speaker) }}" class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-400 hover:bg-slate-50 hover:text-primary transition-all" title="Sửa">
                    <span class="material-symbols-outlined text-[16px]">edit</span>
                </a>
                <form action="{{ route('admin.speakers.destroy', $speaker) }}" method="POST" class="inline" onsubmit="return confirm('Xóa diễn giả này?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-400 hover:bg-red-50 hover:text-red-500 transition-all" title="Xóa">
                        <span class="material-symbols-outlined text-[16px]">delete</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

@if($speakers->hasPages())
<div class="flex justify-center">
    {{ $speakers->links() }}
</div>
@endif
@else
<div class="uni-card p-16 text-center">
    <span class="material-symbols-outlined text-[48px] text-slate-200 mb-3">group_off</span>
    <p class="text-[14px] text-slate-400 mb-4">Chưa có diễn giả nào.</p>
    <a href="{{ route('admin.speakers.create') }}" class="btn-orange inline-flex items-center gap-2">
        <span class="material-symbols-outlined text-[18px]">person_add</span>
        Thêm diễn giả đầu tiên
    </a>
</div>
@endif
@endsection
