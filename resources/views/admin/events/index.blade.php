@extends('layouts.app')

@section('content')
@php
    $totalRegistrations = 0;
    $totalCheckins = 0;
    foreach($events as $e) {
        $totalRegistrations += $e->registrations()->count();
        $totalCheckins += $e->registrations()->whereHas('checkins')->count();
    }
    $totalEvents = \App\Models\Event::count();
    $activeEvents = \App\Models\Event::where('event_date', '>=', now())->count();
    $livePages = \App\Models\Event::where('is_published', true)->count();
    $archivedEvents = \App\Models\Event::where('event_date', '<', now())->count();
    $totalSpeakers = \App\Models\Speaker::count();
    $totalMediaSize = \App\Models\EventMedia::count();
    $totalDocuments = \App\Models\EventDocument::count();
@endphp

<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
    <div>
        <h1 class="text-[28px] font-bold text-primary font-heading leading-tight">
            Xin chào, {{ Auth::user()->name }} 👋
        </h1>
        <p class="text-[14px] text-slate-400 mt-1">Tổng quan về các sự kiện và hoạt động của bạn.</p>
    </div>
    <a href="{{ route('admin.events.create') }}" class="btn-orange flex items-center gap-2 w-fit">
        <span class="material-symbols-outlined text-[18px]">add</span>
        Tạo sự kiện mới
    </a>
</div>

<!-- Primary Stats -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    <!-- Total Registrations -->
    <div class="stat-card border-l-4 border-brand-orange">
        <div class="flex justify-between items-start">
            <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center text-brand-orange">
                <span class="material-symbols-outlined text-[22px]">groups</span>
            </div>
        </div>
        <div class="mt-5">
            <p class="stat-label">Tổng đăng ký</p>
            <p class="stat-value">{{ $totalRegistrations }}</p>
        </div>
    </div>

    <!-- Active Events -->
    <div class="stat-card border-l-4 border-emerald-400">
        <div class="flex justify-between items-start">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-500">
                <span class="material-symbols-outlined text-[22px]">event_available</span>
            </div>
        </div>
        <div class="mt-5">
            <p class="stat-label">Sự kiện đang hoạt động</p>
            <p class="stat-value">{{ $activeEvents }}</p>
        </div>
    </div>

    <!-- Published Events -->
    <div class="stat-card border-l-4 border-blue-400">
        <div class="flex justify-between items-start">
            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-500">
                <span class="material-symbols-outlined text-[22px]">sensors</span>
            </div>
            <span class="flex items-center gap-1.5">
                <span class="flex h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-emerald-500 text-[10px] font-bold uppercase">Live</span>
            </span>
        </div>
        <div class="mt-5">
            <p class="stat-label">Đã xuất bản</p>
            <p class="stat-value">{{ $livePages }}</p>
        </div>
    </div>

    <!-- Checked In -->
    <div class="stat-card border-l-4 border-purple-400">
        <div class="flex justify-between items-start">
            <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center text-purple-500">
                <span class="material-symbols-outlined text-[22px]">how_to_reg</span>
            </div>
        </div>
        <div class="mt-5">
            <p class="stat-label">Đã check-in</p>
            <p class="stat-value">{{ $totalCheckins }}</p>
        </div>
    </div>
</div>

<!-- See More Stats (collapsed) -->
<div id="moreStatsSection" class="hidden mb-8">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
        <!-- Archived Events -->
        <div class="stat-card border-l-4 border-slate-300">
            <div class="flex justify-between items-start">
                <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400">
                    <span class="material-symbols-outlined text-[22px]">archive</span>
                </div>
            </div>
            <div class="mt-5">
                <p class="stat-label">Sự kiện đã qua</p>
                <p class="stat-value text-slate-500">{{ $archivedEvents }}</p>
            </div>
        </div>

        <!-- Total Media -->
        <div class="stat-card border-l-4 border-indigo-300">
            <div class="flex justify-between items-start">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-500">
                    <span class="material-symbols-outlined text-[22px]">perm_media</span>
                </div>
            </div>
            <div class="mt-5">
                <p class="stat-label">Tổng Media & Tài liệu</p>
                <p class="stat-value text-indigo-600">{{ $totalMediaSize + $totalDocuments }}</p>
            </div>
        </div>

        <!-- Total Speakers -->
        <div class="stat-card border-l-4 border-teal-300">
            <div class="flex justify-between items-start">
                <div class="w-10 h-10 rounded-xl bg-teal-50 flex items-center justify-center text-teal-500">
                    <span class="material-symbols-outlined text-[22px]">record_voice_over</span>
                </div>
            </div>
            <div class="mt-5">
                <p class="stat-label">Diễn giả được mời</p>
                <p class="stat-value text-teal-600">{{ $totalSpeakers }}</p>
            </div>
        </div>
    </div>
</div>

<div class="flex justify-center mb-8">
    <button onclick="toggleMoreStats()" id="moreStatsBtn" class="btn-ghost flex items-center gap-1.5 text-[12px]">
        <span class="material-symbols-outlined text-[16px]">expand_more</span>
        <span id="moreStatsBtnText">Xem thêm thống kê</span>
    </button>
</div>

<!-- Recent Events Table -->
<section class="uni-card overflow-hidden">
    <div class="px-6 py-5 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
        <div>
            <h3 class="text-[16px] font-bold text-primary font-heading flex items-center gap-2">
                <span class="w-1 h-5 bg-primary rounded-full"></span>
                Sự kiện gần đây
            </h3>
            <p class="text-[12px] text-slate-400 mt-0.5">Quản lý và theo dõi các sự kiện của bạn</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.events.create') }}" class="btn-primary flex items-center gap-1.5 text-[12px] py-2 px-3">
                <span class="material-symbols-outlined text-[16px]">add</span>
                Tạo mới
            </a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left uni-table">
            <thead>
                <tr>
                    <th>Sự kiện</th>
                    <th>Ngày</th>
                    <th>Trạng thái</th>
                    <th>Đăng ký</th>
                    <th class="text-right">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <td>
                        <div class="flex items-center gap-3.5">
                            <div class="w-11 h-11 rounded-xl bg-slate-50 flex items-center justify-center overflow-hidden shrink-0 border border-slate-100">
                                @if($event->bannerImage)
                                    <img src="{{ Storage::url($event->bannerImage->url) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                                @else
                                    <span class="material-symbols-outlined text-slate-300 text-[20px]">image</span>
                                @endif
                            </div>
                            <div>
                                <a href="{{ route('admin.events.show', $event) }}" class="text-[13px] font-semibold text-primary hover:text-brand-orange transition-colors">{{ $event->title }}</a>
                                <p class="text-[11px] text-slate-400 mt-0.5">{{ Str::limit($event->location, 35) }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="text-[13px] text-primary font-medium">{{ $event->event_date->format('d/m/Y') }}</p>
                        <p class="text-[11px] text-slate-400">{{ $event->event_date->format('H:i') }}</p>
                    </td>
                    <td>
                        @if($event->status == 'published')
                            <span class="badge-success flex items-center gap-1 w-fit">
                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                Đã xuất bản
                            </span>
                        @else
                            <span class="badge-draft">Bản nháp</span>
                        @endif
                    </td>
                    <td>
                        @php
                            $regs = $event->registrations()->count();
                            $max = $event->max_attendees ?: 1;
                            $percent = $event->max_attendees ? min(100, round(($regs / $max) * 100)) : 100;
                        @endphp
                        <div class="flex items-center gap-2">
                            @if($event->max_attendees)
                                <div class="w-20 bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                    <div class="bg-brand-orange h-full rounded-full" style="width: {{ $percent }}%"></div>
                                </div>
                                <span class="text-[12px] font-semibold text-slate-600">{{ $regs }}/{{ $event->max_attendees }}</span>
                            @else
                                <span class="text-[12px] font-semibold text-slate-600">{{ $regs }}</span>
                                <span class="text-[10px] text-slate-400">(Không giới hạn)</span>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="flex items-center justify-end gap-1">
                            <a href="{{ route('admin.events.show', $event) }}" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:bg-slate-50 hover:text-brand-orange transition-all" title="Xem chi tiết">
                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                            </a>
                            <a href="{{ route('admin.events.edit', $event) }}" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:bg-slate-50 hover:text-primary transition-all" title="Chỉnh sửa">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                            </a>
                            <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline" onsubmit="return confirm('Bạn có chắc muốn xóa sự kiện này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:bg-red-50 hover:text-red-500 transition-all" title="Xóa">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($events->hasPages())
    <div class="p-5 border-t border-slate-100">
        {{ $events->links() }}
    </div>
    @endif

    @if($events->count() == 0)
    <div class="p-16 text-center">
        <span class="material-symbols-outlined text-[48px] text-slate-200 mb-3">event_busy</span>
        <p class="text-[14px] text-slate-400 mb-4">Chưa có sự kiện nào. Hãy tạo sự kiện đầu tiên!</p>
        <a href="{{ route('admin.events.create') }}" class="btn-orange inline-flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">add</span>
            Tạo sự kiện mới
        </a>
    </div>
    @endif
</section>

@endsection

@push('scripts')
<script>
function toggleMoreStats() {
    const section = document.getElementById('moreStatsSection');
    const btn = document.getElementById('moreStatsBtn');
    const btnText = document.getElementById('moreStatsBtnText');
    const icon = btn.querySelector('.material-symbols-outlined');

    if (section.classList.contains('hidden')) {
        section.classList.remove('hidden');
        btnText.textContent = 'Ẩn bớt';
        icon.textContent = 'expand_less';
    } else {
        section.classList.add('hidden');
        btnText.textContent = 'Xem thêm thống kê';
        icon.textContent = 'expand_more';
    }
}
</script>
@endpush
