@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.events.index') }}" class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 hover:bg-slate-50 hover:text-primary transition-all">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
        </a>
        <div>
            <h1 class="text-[24px] font-bold text-primary font-heading leading-tight">{{ $event->title }}</h1>
            <p class="text-[13px] text-slate-400 mt-0.5">Quản lý chi tiết và theo dõi đăng ký.</p>
        </div>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('events.show', $event->slug) }}" target="_blank" class="btn-ghost border border-slate-200 flex items-center gap-1.5">
            <span class="material-symbols-outlined text-[16px]">visibility</span>
            Xem trang
        </a>
        <a href="{{ route('admin.events.design', $event) }}" class="btn-primary flex items-center gap-1.5">
            <span class="material-symbols-outlined text-[16px]">palette</span>
            Thiết kế
        </a>
        <a href="{{ route('admin.events.edit', $event) }}" class="btn-orange flex items-center gap-1.5">
            <span class="material-symbols-outlined text-[16px]">edit</span>
            Chỉnh sửa
        </a>
    </div>
</div>

<!-- Stats -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    <div class="stat-card border-l-4 border-blue-400">
        <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-500">
            <span class="material-symbols-outlined text-[22px]">visibility</span>
        </div>
        <div class="mt-4">
            <p class="stat-label">Tổng lượt xem</p>
            <p class="stat-value">{{ number_format($event->views_count ?? 0) }}</p>
        </div>
    </div>
    <div class="stat-card border-l-4 border-emerald-400">
        <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-500">
            <span class="material-symbols-outlined text-[22px]">favorite</span>
        </div>
        <div class="mt-4">
            <p class="stat-label">Lượt thích</p>
            <p class="stat-value">{{ number_format($event->likes_count ?? 0) }}</p>
        </div>
    </div>
    <div class="stat-card border-l-4 border-brand-orange">
        <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center text-brand-orange">
            <span class="material-symbols-outlined text-[22px]">perm_media</span>
        </div>
        <div class="mt-4">
            <p class="stat-label">Media & Tài liệu</p>
            <p class="stat-value">{{ $event->media->count() }}</p>
        </div>
    </div>
    <div class="stat-card border-l-4 border-purple-400">
        <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center text-purple-500">
            <span class="material-symbols-outlined text-[22px]">visibility</span>
        </div>
        <div class="mt-4">
            <p class="stat-label">Lượt xem</p>
            <p class="stat-value">{{ $event->views_count }}</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Event Details -->
    <div class="lg:col-span-2">
        <div class="uni-card p-6 h-full">
            <h3 class="text-[16px] font-bold text-primary font-heading flex items-center gap-2 mb-5 border-b border-slate-100 pb-3">
                <span class="w-1 h-5 bg-primary rounded-full"></span>
                Chi tiết sự kiện
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="space-y-1">
                    <p class="uni-section-title">Ngày & Giờ</p>
                    <p class="text-[14px] font-semibold text-primary">{{ $event->event_date->format('d/m/Y — H:i') }}</p>
                </div>
                <div class="space-y-1">
                    <p class="uni-section-title">Địa điểm</p>
                    <p class="text-[14px] font-semibold text-primary">{{ $event->location }}</p>
                </div>
                <div class="space-y-1">
                    <p class="uni-section-title">Loại sự kiện</p>
                    <p class="text-[14px] font-semibold text-primary capitalize">{{ $event->category?->name ?? 'N/A' }}</p>
                </div>
                <div class="space-y-1">
                    <p class="uni-section-title">Trạng thái</p>
                    @if($event->status == 'published')
                        <span class="badge-success">Đã xuất bản</span>
                    @else
                        <span class="badge-draft">Bản nháp</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- QR Code -->
    <div class="lg:col-span-1">
        <div class="uni-card p-6 text-center h-full flex flex-col justify-center items-center">
            <h3 class="text-[14px] font-bold text-primary font-heading mb-1">Mã QR sự kiện</h3>
            <p class="text-[11px] text-slate-400 mb-5">Quét để truy cập trang sự kiện</p>
            <div class="p-4 bg-white border border-slate-100 rounded-xl shadow-sm mb-4 inline-block">
                {!! SimpleSoftwareIO\QrCode\Facades\QrCode::size(180)->generate(route('events.show', $event->slug)) !!}
            </div>
            <button onclick="navigator.clipboard.writeText('{{ route('events.show', $event->slug) }}'); alert('Đã sao chép link!');" class="flex items-center gap-1.5 text-brand-orange hover:underline text-[12px] font-semibold mx-auto">
                <span class="material-symbols-outlined text-[14px]">content_copy</span> Sao chép link
            </button>
        </div>
    </div>
</div>


@endsection
