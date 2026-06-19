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
    <div class="uni-card overflow-clip mb-8">
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
        <div class="bg-white pb-16">
            @php
                $titleStyles = [];
                if (!empty($event->title_font_family)) {
                    $titleStyles[] = "font-family: '{$event->title_font_family}', sans-serif;";
                }
                if (!empty($event->title_font_size)) {
                    $titleStyles[] = "font-size: {$event->title_font_size}px;";
                }
                if (!empty($event->title_color)) {
                    $titleStyles[] = "color: {$event->title_color} !important;";
                }
                if (!empty($event->title_outline_width) && $event->title_outline_width != '0') {
                    $outlineColor = $event->title_outline_color ?? '#000000';
                    $titleStyles[] = "-webkit-text-stroke: {$event->title_outline_width}px {$outlineColor};";
                    $titleStyles[] = "text-shadow: 0px 2px 4px rgba(0,0,0,0.5);";
                }
                $titleStyleStr = implode(' ', $titleStyles);

                $descStyles = [];
                if (!empty($event->desc_font_family)) {
                    $descStyles[] = "font-family: '{$event->desc_font_family}', sans-serif;";
                }
                if (!empty($event->desc_font_size)) {
                    $descStyles[] = "font-size: {$event->desc_font_size}px;";
                }
                if (!empty($event->desc_color)) {
                    $descStyles[] = "color: {$event->desc_color} !important;";
                }
                $descStyleStr = implode(' ', $descStyles);
            @endphp

            <!-- Hero Section -->
            <section class="relative h-[320px] w-full overflow-hidden bg-slate-900">
                <div class="absolute inset-0 bg-cover bg-center scale-105 transition-transform"
                    style="background-image: url('{{ $event->bannerImage ? Storage::url($event->bannerImage->url) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=1200&q=80' }}');">
                </div>
                <div class="absolute inset-0 hero-overlay" style="background: linear-gradient(to top, rgba(15,23,42,0.95), rgba(15,23,42,0.2) 60%, transparent);"></div>

                <div class="absolute inset-0 flex flex-col justify-end max-w-[1140px] mx-auto w-full px-6 pb-8 z-10">
                    <div class="flex gap-2 mb-3">
                        <span class="px-2.5 py-1 bg-brand-orange text-white rounded-md text-[10px] uppercase font-bold tracking-wider">{{ $event->category?->name ?? 'Sự kiện' }}</span>
                    </div>
                    <h1 class="text-[28px] md:text-[36px] font-bold text-white mb-2 font-heading leading-tight" style="{{ $titleStyleStr }}">
                        {{ $event->title }}
                    </h1>
                </div>
            </section>

            <!-- Content Grid -->
            <div class="max-w-[1140px] mx-auto px-6 mt-10 grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Left Column -->
                <div class="lg:col-span-8 space-y-8">
                    <!-- Intro Card (Article Layout) -->
                    <div class="bg-white rounded-2xl p-8 border border-slate-200/60 shadow-sm">
                        <div class="article-content">
                            {{-- Global Description (Short Summary) --}}
                            @if($event->description)
                            <h3 class="text-[18px] font-bold text-primary mb-3 font-heading flex items-center gap-2">
                                <span class="w-1 h-5 bg-primary rounded-full"></span>Giới thiệu sự kiện
                            </h3>
                            <div class="text-slate-600 text-[16px] leading-[1.8] mb-8 text-justify break-words font-medium" style="{{ $descStyleStr }}">
                                {!! nl2br(e($event->description)) !!}
                            </div>
                            @endif

                            {{-- Article Blocks --}}
                            @foreach($event->galleryImages->take(4) as $block)
                                @if($block->content)
                                    <div class="text-slate-800 text-[16px] leading-[1.8] mb-6 text-justify break-words">
                                        {!! nl2br(e($block->content)) !!}
                                    </div>
                                @endif

                                @if($block->url)
                                    <figure class="mb-6">
                                        <div class="rounded-xl overflow-hidden bg-slate-100 shadow-sm">
                                            @if($block->type === 'video')
                                                <video src="{{ Storage::url($block->url) }}" class="w-full h-auto object-cover max-h-[500px]" autoplay loop muted playsinline controls></video>
                                            @else
                                                <img src="{{ Storage::url($block->url) }}" class="w-full h-auto object-contain max-h-[500px] mx-auto" alt=""/>
                                            @endif
                                        </div>
                                        @if($block->caption)
                                        <figcaption class="mt-3 text-[14px] text-slate-600 bg-slate-50/50 p-3 rounded-lg border-l-4 border-brand-orange break-words">
                                            {{ $block->caption }}
                                        </figcaption>
                                        @endif
                                    </figure>
                                @endif

                                {{-- Tài liệu đính kèm nếu có --}}
                                @if($block->document_url)
                                    <div class="mb-6">
                                        <a href="{{ Storage::url($block->document_url) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-semibold rounded-xl text-sm border border-emerald-200 transition-all">
                                            <span class="material-symbols-outlined text-lg">download</span>
                                            Tải tài liệu: {{ $block->document_name ?? basename($block->document_url) }}
                                        </a>
                                    </div>
                                @endif

                                {{-- URL liên kết ngoài nếu có --}}
                                @if($block->action_url)
                                    <div class="mb-6">
                                        <a href="{{ $block->action_url }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 font-semibold rounded-xl text-sm border border-blue-200 transition-all">
                                            <span class="material-symbols-outlined text-lg">open_in_new</span>
                                            Xem liên kết ngoài
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>

                <!-- Right Column -->
                <div class="lg:col-span-4 space-y-6" style="position: sticky; top: 88px; align-self: start; height: max-content;">
                    <!-- Registration Card -->
                    <div class="bg-white rounded-2xl p-5 border border-slate-200/60 shadow-sm">
                        <div class="flex justify-between items-center mb-4 border-b border-slate-100 pb-3">
                            <span class="text-[13px] text-slate-500 font-medium">Cổng đăng ký</span>
                            <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md bg-emerald-50 text-emerald-600 text-[11px] font-bold uppercase tracking-wider">
                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                                Đang mở
                            </span>
                        </div>

                        <div class="space-y-3.5 mb-5">
                            <div class="flex items-center gap-3.5 p-1.5">
                                <div class="w-9 h-9 rounded-xl bg-slate-50 flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                                </div>
                                <div>
                                    <p class="text-[11px] text-slate-400 font-medium">Ngày diễn ra</p>
                                    <p class="text-[13px] font-semibold text-primary">{{ $event->event_date->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3.5 p-1.5">
                                <div class="w-9 h-9 rounded-xl bg-slate-50 flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined text-[18px]">schedule</span>
                                </div>
                                <div>
                                    <p class="text-[11px] text-slate-400 font-medium">Thời gian</p>
                                    <p class="text-[13px] font-semibold text-primary">{{ $event->event_date->format('H:i') }} - {{ $event->end_date ? $event->end_date->format('H:i') : '17:00' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3.5 p-1.5">
                                <div class="w-9 h-9 rounded-xl bg-slate-50 flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined text-[18px]">location_on</span>
                                </div>
                                <div>
                                    <p class="text-[11px] text-slate-400 font-medium">Địa điểm</p>
                                    <p class="text-[13px] font-semibold text-primary">{{ $event->location }}</p>
                                </div>
                            </div>
                        </div>

                        <button class="w-full py-2.5 bg-brand-orange hover:bg-orange-600 text-white rounded-xl text-[13px] font-bold transition-all shadow-md shadow-orange-500/10 cursor-pointer">
                            Giữ chỗ (Giới hạn: {{ $event->max_attendees ?? 50 }} slot)
                        </button>
                    </div>

                    <!-- Schedule Card -->
                    <div class="bg-white rounded-2xl p-5 border border-slate-200/60 shadow-sm">
                        <h4 class="text-[13px] font-bold text-primary mb-3 font-heading flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px] text-brand-orange">format_list_bulleted</span>
                            Lịch hoạt động sự kiện
                        </h4>
                        <div class="text-[12px] text-slate-600 bg-slate-50 p-3 rounded-xl border border-slate-100 whitespace-pre-line leading-relaxed">
                            {{ $event->scheduleItems->map(fn($s) => $s->start_time . ' - ' . $s->title)->implode("\n") ?: "Chưa có lịch hoạt động" }}
                        </div>
                    </div>

                    <!-- Speaker Card -->
                    @if($event->speakers->count() > 0)
                    <div class="bg-white rounded-2xl p-5 border border-slate-200/60 shadow-sm flex gap-4 items-center">
                        <div class="w-16 h-16 rounded-xl overflow-hidden shrink-0 border border-slate-200 shadow-inner bg-slate-50">
                            <img class="w-full h-full object-cover" src="{{ $event->speakers->first()->photo_url ? asset($event->speakers->first()->photo_url) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80' }}"/>
                        </div>
                        <div>
                            <span class="text-brand-orange text-[10px] font-bold uppercase tracking-widest block mb-0.5">Keynote Speaker</span>
                            <h3 class="text-[16px] font-bold font-heading text-primary">
                                {{ $event->speakers->first()->name }}
                            </h3>
                            <p class="text-[12px] text-slate-400 font-light mt-0.5">{{ Str::limit($event->speakers->first()->bio, 100) }}</p>
                        </div>
                    </div>
                    @endif
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
