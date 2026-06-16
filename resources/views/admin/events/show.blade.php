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
            <span class="material-symbols-outlined text-[22px]">groups</span>
        </div>
        <div class="mt-4">
            <p class="stat-label">Tổng đăng ký</p>
            <p class="stat-value">{{ $event->registrations->count() }}</p>
        </div>
    </div>
    <div class="stat-card border-l-4 border-emerald-400">
        <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-500">
            <span class="material-symbols-outlined text-[22px]">mark_email_read</span>
        </div>
        <div class="mt-4">
            <p class="stat-label">Xác nhận email</p>
            <p class="stat-value">{{ $event->registrations->where('email_confirmed', true)->count() }}</p>
        </div>
    </div>
    <div class="stat-card border-l-4 border-brand-orange">
        <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center text-brand-orange">
            <span class="material-symbols-outlined text-[22px]">how_to_reg</span>
        </div>
        <div class="mt-4">
            <p class="stat-label">Đã check-in</p>
            <p class="stat-value">{{ $event->registrations->filter(fn($reg) => $reg->checkins->count() > 0)->count() }}</p>
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
                    <p class="uni-section-title">Sức chứa</p>
                    <p class="text-[14px] font-semibold text-primary">{{ $event->max_attendees ? $event->max_attendees . ' người' : 'Không giới hạn' }}</p>
                </div>
                <div class="space-y-1">
                    <p class="uni-section-title">Trạng thái</p>
                    @if($event->status == 'published')
                        <span class="badge-success">Đã xuất bản</span>
                    @else
                        <span class="badge-draft">Bản nháp</span>
                    @endif
                </div>
                <div class="space-y-1">
                    <p class="uni-section-title">Đăng ký</p>
                    @if($event->registration_open)
                        <span class="badge-info">Đang mở</span>
                    @else
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-red-50 text-red-500 border border-red-200">Đã đóng</span>
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

<!-- Registrations -->
<section class="uni-card overflow-hidden">
    <div class="px-6 py-5 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
        <div>
            <h3 class="text-[16px] font-bold text-primary font-heading flex items-center gap-2">
                <span class="w-1 h-5 bg-primary rounded-full"></span>
                Danh sách đăng ký
            </h3>
            <p class="text-[12px] text-slate-400 mt-0.5">Quản lý người tham dự sự kiện</p>
        </div>
        <button class="btn-ghost border border-slate-200 flex items-center gap-1.5 text-[12px]">
            <span class="material-symbols-outlined text-[16px]">file_download</span> Xuất CSV
        </button>
    </div>

    @if($event->registrations->count() > 0)
    <div class="overflow-x-auto">
        <table class="w-full text-left uni-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Người tham dự</th>
                    <th>MSSV</th>
                    <th>Email</th>
                    <th>Check-in</th>
                    <th>Thời gian đăng ký</th>
                </tr>
            </thead>
            <tbody>
                @foreach($event->registrations->sortByDesc('created_at') as $index => $reg)
                <tr>
                    <td class="text-[13px] text-slate-400">{{ $index + 1 }}</td>
                    <td>
                        <p class="text-[13px] font-semibold text-primary">{{ $reg->full_name }}</p>
                        <p class="text-[11px] text-slate-400">{{ $reg->email }}</p>
                    </td>
                    <td class="text-[13px] text-primary">
                        {{ $reg->student_id ?? '—' }}
                        @if($reg->department)
                            <span class="block text-[10px] text-slate-400">{{ $reg->department->name }}</span>
                        @endif
                    </td>
                    <td>
                        @if($reg->email_confirmed)
                            <span class="badge-success flex items-center gap-1 w-fit">
                                <span class="material-symbols-outlined text-[12px]">check_circle</span> Đã xác nhận
                            </span>
                        @else
                            <span class="badge-draft flex items-center gap-1 w-fit">
                                <span class="material-symbols-outlined text-[12px]">schedule</span> Chờ
                            </span>
                        @endif
                    </td>
                    <td>
                        @if($reg->checkins->count() > 0)
                            <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-orange-50 text-brand-orange border border-orange-200 flex items-center gap-1 w-fit">
                                <span class="material-symbols-outlined text-[12px]">how_to_reg</span> {{ $reg->checkins->count() }}x
                            </span>
                            <span class="block text-[10px] text-slate-400 mt-0.5">{{ $reg->checkins->sortByDesc('checked_in_at')->first()->checked_in_at->format('H:i, d/m') }}</span>
                        @else
                            <span class="badge-draft">Chưa</span>
                        @endif
                    </td>
                    <td class="text-[12px] text-slate-400">
                        {{ $reg->created_at->format('d/m/Y — H:i') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="p-16 text-center">
        <span class="material-symbols-outlined text-[48px] text-slate-200 mb-3">person_off</span>
        <p class="text-[14px] text-slate-400">Chưa có ai đăng ký sự kiện này.</p>
    </div>
    @endif
</section>
@endsection
