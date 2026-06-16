@extends('layouts.app')

@section('content')
<div class="max-w-[1000px] mx-auto">
    <!-- Progress Indicator -->
    <div class="uni-card p-5 mb-8">
        <div class="flex items-center justify-between relative">
            <div class="absolute top-5 left-[60px] right-[60px] h-[2px] bg-slate-100 z-0"></div>
            <div class="absolute top-5 left-[60px] h-[2px] bg-emerald-400 z-0" style="width: calc(100%)"></div>

            <div class="step-indicator">
                <div class="step-circle completed">
                    <span class="material-symbols-outlined text-[18px]">check</span>
                </div>
                <span class="text-[11px] font-medium text-emerald-600">Thông tin</span>
            </div>
            <div class="step-indicator">
                <div class="step-circle completed">
                    <span class="material-symbols-outlined text-[18px]">check</span>
                </div>
                <span class="text-[11px] font-medium text-emerald-600">Thiết kế</span>
            </div>
            <div class="step-indicator">
                <div class="step-circle active">3</div>
                <span class="text-[11px] font-semibold text-primary">Xem trước</span>
            </div>
        </div>
    </div>

    <!-- Preview Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-[24px] font-bold text-primary font-heading">Xem trước sự kiện</h1>
            <p class="text-[13px] text-slate-400 mt-1">Kiểm tra trang sự kiện trước khi xuất bản.</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="badge-draft flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[14px]">edit_note</span>
                Bản nháp
            </span>
        </div>
    </div>

    <!-- Preview Frame -->
    <div class="uni-card overflow-hidden mb-8">
        <!-- Mock Browser Bar -->
        <div class="bg-slate-50 px-4 py-2.5 border-b border-slate-100 flex items-center gap-3">
            <div class="flex gap-1.5">
                <span class="w-3 h-3 rounded-full bg-red-400"></span>
                <span class="w-3 h-3 rounded-full bg-amber-400"></span>
                <span class="w-3 h-3 rounded-full bg-emerald-400"></span>
            </div>
            <div class="flex-1 bg-white rounded-lg px-3 py-1 text-[11px] text-slate-400 border border-slate-200">
                {{ url('/events/' . $event->slug) }}
            </div>
            <a href="{{ route('events.show', $event->slug) }}" target="_blank" class="text-slate-400 hover:text-primary transition-colors" title="Mở trong tab mới">
                <span class="material-symbols-outlined text-[18px]">open_in_new</span>
            </a>
        </div>

        <!-- Preview Content -->
        <div class="bg-white">
            <!-- Hero -->
            <div class="relative h-[280px] w-full overflow-hidden bg-slate-900">
                <div class="absolute inset-0 bg-cover bg-center scale-105"
                    style="background-image: url('{{ $event->bannerImage ? Storage::url($event->bannerImage->url) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=1200&q=80' }}');">
                </div>
                <div class="absolute inset-0 hero-overlay"></div>
                <div class="absolute inset-0 flex flex-col justify-end max-w-[900px] mx-auto w-full px-6 pb-6 z-10">
                    <div class="flex gap-2 mb-2">
                        <span class="px-2.5 py-1 bg-brand-orange text-white rounded-md text-[10px] uppercase font-bold tracking-wider">{{ $event->category?->name ?? 'Workshop' }}</span>
                    </div>
                    <h1 class="text-[24px] md:text-[30px] font-bold text-white mb-1.5 font-heading leading-tight">{{ $event->title }}</h1>
                    <p class="text-slate-200/90 text-[13px] max-w-xl font-light leading-relaxed">{{ Str::limit($event->description, 120) }}</p>
                </div>
            </div>

            <!-- Content -->
            <div class="max-w-[900px] mx-auto px-6 py-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-5">
                    <div class="p-5 bg-slate-50/50 rounded-xl border border-slate-100">
                        <h3 class="text-[15px] font-bold text-primary mb-2 font-heading">Giới thiệu</h3>
                        <p class="text-slate-600 text-[13px] leading-relaxed">{{ $event->description }}</p>
                    </div>

                    @if($event->speakers->count() > 0)
                    <div class="bg-gradient-to-r from-slate-900 to-slate-800 text-white p-4 rounded-xl flex gap-4 items-center">
                        <div class="w-12 h-12 rounded-lg overflow-hidden shrink-0 border border-white/10">
                            <img class="w-full h-full object-cover" src="{{ $event->speakers->first()?->photo_url ?? 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80' }}"/>
                        </div>
                        <div>
                            <span class="text-brand-orange text-[9px] font-bold uppercase tracking-widest">Keynote Speaker</span>
                            <h3 class="text-[14px] font-bold font-heading">{{ $event->speakers->first()->name }}</h3>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="space-y-4">
                    <div class="p-4 bg-white rounded-xl border border-slate-100">
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-[16px] text-slate-400">calendar_today</span>
                                <div>
                                    <p class="text-[10px] text-slate-400">Ngày</p>
                                    <p class="text-[12px] font-semibold text-primary">{{ $event->event_date->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-[16px] text-slate-400">schedule</span>
                                <div>
                                    <p class="text-[10px] text-slate-400">Thời gian</p>
                                    <p class="text-[12px] font-semibold text-primary">{{ $event->event_date->format('H:i') }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-[16px] text-slate-400">location_on</span>
                                <div>
                                    <p class="text-[10px] text-slate-400">Địa điểm</p>
                                    <p class="text-[12px] font-semibold text-primary">{{ $event->location }}</p>
                                </div>
                            </div>
                        </div>
                        <button class="w-full mt-4 py-2 bg-brand-orange text-white rounded-lg text-[12px] font-bold pointer-events-none">
                            Đăng ký ngay
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.events.design', $event) }}" class="btn-ghost flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            Quay lại thiết kế
        </a>
        <div class="flex gap-3">
            <form action="{{ route('admin.events.update', $event) }}" method="POST" class="inline">
                @csrf
                @method('PUT')
                <input type="hidden" name="title" value="{{ $event->title }}">
                <input type="hidden" name="slug" value="{{ $event->slug }}">
                <input type="hidden" name="description" value="{{ $event->description }}">
                <input type="hidden" name="event_date" value="{{ $event->event_date }}">
                <input type="hidden" name="location" value="{{ $event->location }}">
                <input type="hidden" name="status" value="draft">
                <button type="submit" class="btn-ghost border border-slate-200">
                    <span class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px]">save</span>
                        Lưu nháp
                    </span>
                </button>
            </form>
            <form action="{{ route('admin.events.update', $event) }}" method="POST" class="inline">
                @csrf
                @method('PUT')
                <input type="hidden" name="title" value="{{ $event->title }}">
                <input type="hidden" name="slug" value="{{ $event->slug }}">
                <input type="hidden" name="description" value="{{ $event->description }}">
                <input type="hidden" name="event_date" value="{{ $event->event_date }}">
                <input type="hidden" name="location" value="{{ $event->location }}">
                <input type="hidden" name="status" value="published">
                <button type="submit" class="btn-orange flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">publish</span>
                    Xuất bản sự kiện
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
