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
</div>

<!-- Banner Preview -->
<div class="mb-8 uni-card overflow-hidden p-0">
    @if(!empty($event->banner))
        <div class="relative w-full h-[200px] md:h-[300px] bg-slate-100">
            <img src="{{ Storage::url($event->banner) }}" alt="Banner sự kiện" class="w-full h-full object-cover" />
            <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-lg text-[12px] font-bold text-slate-700 shadow-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-[16px]">image</span> Banner sự kiện
            </div>
        </div>
    @else
        <div class="w-full h-[200px] bg-slate-50 flex flex-col items-center justify-center border-b border-slate-100">
            <div class="w-12 h-12 rounded-full bg-slate-200 flex items-center justify-center text-slate-400 mb-3">
                <span class="material-symbols-outlined text-[24px]">broken_image</span>
            </div>
            <p class="text-[14px] font-medium text-slate-500">Chưa có banner sự kiện</p>
            <p class="text-[12px] text-slate-400 mt-1">Admin nhìn phát biết giao diện sự kiện đang dùng ảnh nào</p>
        </div>
    @endif
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
            <span class="material-symbols-outlined text-[22px]">app_registration</span>
        </div>
        <div class="mt-4">
            <p class="stat-label">Đăng ký</p>
            <p class="stat-value">{{ number_format($event->registrations_count ?? 0) }}</p>
        </div>
    </div>
    <div class="stat-card border-l-4 border-purple-400">
        <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center text-purple-500">
            <span class="material-symbols-outlined text-[22px]">location_on</span>
        </div>
        <div class="mt-4">
            <p class="stat-label">Check-in</p>
            <p class="stat-value">{{ number_format($event->checkins_count ?? 0) }}</p>
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

        <!-- Khối Tiến độ hoàn thiện -->
        @php
            $checklist = [
                'Banner' => !empty($event->banner),
                'Mô tả' => !empty($event->description),
                'Media' => isset($event->media) && $event->media->count() > 0,
                'Diễn giả' => isset($event->speakers) && $event->speakers->count() > 0,
                'Đăng ký' => isset($event->registrations_count) && $event->registrations_count > 0,
                'Check-in' => isset($event->checkins_count) && $event->checkins_count > 0,
            ];
            $completed = count(array_filter($checklist));
            $total = count($checklist);
            $percentage = $total > 0 ? round(($completed / $total) * 100) : 0;
        @endphp
        <div class="uni-card p-6 mt-6">
            <h3 class="text-[16px] font-bold text-primary font-heading flex items-center gap-2 mb-5 border-b border-slate-100 pb-3">
                <span class="w-1 h-5 bg-emerald-500 rounded-full"></span>
                Tiến độ hoàn thiện Landing Page
            </h3>
            <div class="mb-4">
                <div class="flex justify-between items-end mb-2">
                    <span class="text-[13px] font-semibold text-slate-600">Hoàn thiện</span>
                    <span class="text-[20px] font-bold text-emerald-500">{{ $percentage }}%</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                    <div class="bg-emerald-500 h-2.5 rounded-full transition-all duration-500" style="width: {{ $percentage }}%"></div>
                </div>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mt-5">
                @foreach($checklist as $label => $isDone)
                    <div class="flex items-center gap-2 p-2 rounded-lg {{ $isDone ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-50 text-slate-400' }}">
                        <span class="material-symbols-outlined text-[18px]">
                            {{ $isDone ? 'check_circle' : 'cancel' }}
                        </span>
                        <span class="text-[13px] font-medium">{{ $label }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Menu nhanh bên phải -->
    <div class="lg:col-span-1 space-y-6">
        <div class="uni-card p-0 overflow-hidden">
            <div class="bg-slate-50 px-5 py-4 border-b border-slate-100 flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px] text-primary">bolt</span>
                <h3 class="text-[14px] font-bold text-primary font-heading">Menu nhanh</h3>
            </div>
            
            <!-- QR Code Section -->
            <div class="p-5 text-center border-b border-slate-100">
                <div class="inline-block p-3 bg-white border border-slate-100 rounded-xl shadow-sm mb-3">
                    {!! SimpleSoftwareIO\QrCode\Facades\QrCode::size(140)->generate(route('events.show', $event->slug)) !!}
                </div>
                <p class="text-[12px] font-medium text-slate-500">Quét QR Code truy cập trang</p>
            </div>

            <!-- Action Links -->
            <div class="p-2 flex flex-col">
                <button onclick="navigator.clipboard.writeText('{{ route('events.show', $event->slug) }}'); alert('Đã sao chép link!');" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-slate-50 text-slate-600 hover:text-brand-orange transition-colors text-left rounded-lg">
                    <span class="material-symbols-outlined text-[18px]">content_copy</span>
                    <span class="text-[13px] font-semibold">Sao chép link</span>
                </button>
                <a href="#" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-slate-50 text-slate-600 transition-colors rounded-lg">
                    <span class="material-symbols-outlined text-[18px]">download</span>
                    <span class="text-[13px] font-semibold">Tải QR (PNG)</span>
                </a>
                <a href="#" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-slate-50 text-slate-600 transition-colors rounded-lg">
                    <span class="material-symbols-outlined text-[18px]">code</span>
                    <span class="text-[13px] font-semibold">Tải QR (SVG)</span>
                </a>
                <a href="{{ route('events.show', $event->slug) }}" target="_blank" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-slate-50 text-slate-600 transition-colors rounded-lg">
                    <span class="material-symbols-outlined text-[18px]">open_in_new</span>
                    <span class="text-[13px] font-semibold">Xem Landing Page</span>
                </a>
                <button class="w-full flex items-center gap-3 px-4 py-3 hover:bg-slate-50 text-slate-600 transition-colors text-left rounded-lg">
                    <span class="material-symbols-outlined text-[18px]">share</span>
                    <span class="text-[13px] font-semibold">Chia sẻ</span>
                </button>
            </div>
        </div>
    </div>
</div>


@endsection
