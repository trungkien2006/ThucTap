@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.events.index') }}" class="w-10 h-10 rounded-xl border border-border flex items-center justify-center text-muted-foreground hover:bg-accent hover:text-foreground transition-all">
            <i data-lucide="arrow-left" class="h-5 w-5"></i>
        </a>
        <div>
            <div class="flex items-center gap-2 flex-wrap">
                <h1 class="text-[24px] font-bold text-foreground font-heading leading-tight">{{ $event->title }}</h1>
                @if($event->is_published)
                    <span class="inline-flex items-center rounded-full bg-emerald-50 dark:bg-emerald-950/20 px-2 py-0.5 text-xs font-medium text-emerald-700 dark:text-emerald-400 ring-1 ring-inset ring-emerald-600/10">Đã xuất bản</span>
                @else
                    <span class="inline-flex items-center rounded-full bg-amber-50 dark:bg-amber-950/20 px-2 py-0.5 text-xs font-medium text-amber-700 dark:text-amber-400 ring-1 ring-inset ring-amber-600/10">Bản nháp</span>
                @endif
            </div>
            <p class="text-xs text-muted-foreground mt-1">Sự kiện tạo bởi {{ $event->creator->name ?? 'Hệ thống' }} · {{ $event->created_at ? $event->created_at->format('d/m/Y') : '—' }}</p>
        </div>
    </div>
    <div class="flex items-center gap-2 flex-wrap">
        <a href="{{ route('events.show', $event->slug) }}" target="_blank" class="inline-flex items-center justify-center rounded-md text-xs font-medium transition-colors border border-border bg-background hover:bg-accent hover:text-accent-foreground h-9 px-4 gap-1.5 hover:scale-[1.02] active:scale-[0.98] transition-all">
            <i data-lucide="external-link" class="h-3.5 w-3.5"></i>
            Xem trang
        </a>
        <a href="{{ route('admin.events.design', $event) }}" class="inline-flex items-center justify-center rounded-md text-xs font-medium transition-colors bg-primary text-primary-foreground shadow hover:bg-primary/90 h-9 px-4 gap-1.5 hover:scale-[1.02] active:scale-[0.98] transition-all">
            <i data-lucide="palette" class="h-3.5 w-3.5"></i>
            Thiết kế
        </a>
        <a href="{{ route('admin.events.edit', $event) }}" class="inline-flex items-center justify-center rounded-md text-xs font-medium transition-colors border border-input bg-orange-500 hover:bg-orange-600 text-white h-9 px-4 gap-1.5 hover:scale-[1.02] active:scale-[0.98] transition-all">
            <i data-lucide="edit" class="h-3.5 w-3.5"></i>
            Chỉnh sửa
        </a>
    </div>
</div>

<!-- Event Banner (if available) -->
@if($event->bannerImage)
    <div class="w-full h-[220px] md:h-[300px] rounded-xl overflow-hidden shadow-sm mb-6 border border-border">
        <img src="{{ \App\Helpers\FileHelper::url($event->bannerImage->url) }}" class="w-full h-full object-cover" alt="Event Banner">
    </div>
@endif

<!-- Stats Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
    <div class="bg-card rounded-xl border border-border p-4 shadow-sm flex items-center gap-4">
        <div class="h-10 w-10 rounded-xl bg-blue-50 dark:bg-blue-950/20 text-blue-500 flex items-center justify-center shrink-0">
            <i data-lucide="eye" class="h-5 w-5"></i>
        </div>
        <div>
            <p class="text-[11px] font-medium text-muted-foreground uppercase tracking-wider">Lượt xem</p>
            <p class="text-xl font-bold text-foreground mt-0.5 tabular-nums">{{ number_format($event->views_count ?? 0) }}</p>
        </div>
    </div>
    <div class="bg-card rounded-xl border border-border p-4 shadow-sm flex items-center gap-4">
        <div class="h-10 w-10 rounded-xl bg-emerald-50 dark:bg-emerald-950/20 text-emerald-500 flex items-center justify-center shrink-0">
            <i data-lucide="heart" class="h-5 w-5"></i>
        </div>
        <div>
            <p class="text-[11px] font-medium text-muted-foreground uppercase tracking-wider">Lượt thích</p>
            <p class="text-xl font-bold text-foreground mt-0.5 tabular-nums">{{ number_format($event->likes_count ?? 0) }}</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left Column: Details & Description & Speakers & Schedule -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Event General Information -->
        <div class="bg-card rounded-xl border border-border p-6 shadow-sm">
            <h3 class="text-sm font-bold text-foreground flex items-center gap-2 mb-5 pb-3 border-b border-border">
                <span class="w-1.5 h-4.5 bg-primary rounded-full"></span>
                Thông tin chung
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 text-xs">
                <div class="space-y-1">
                    <span class="text-muted-foreground">Năm học & Học kỳ</span>
                    <p class="font-semibold text-foreground text-sm">
                        {{ $event->academic_year ?? '—' }} @if($event->semester) ({{ $event->semester }}) @endif
                    </p>
                </div>
                <div class="space-y-1">
                    <span class="text-muted-foreground">Thời gian bắt đầu</span>
                    <p class="font-semibold text-foreground text-sm">
                        {{ $event->event_date ? $event->event_date->format('d/m/Y — H:i') : '—' }}
                    </p>
                </div>
                <div class="space-y-1">
                    <span class="text-muted-foreground">Thời gian kết thúc</span>
                    <p class="font-semibold text-foreground text-sm">
                        {{ $event->end_date ? $event->end_date->format('d/m/Y — H:i') : '—' }}
                    </p>
                </div>
                <div class="space-y-1">
                    <span class="text-muted-foreground">Địa điểm</span>
                    <p class="font-semibold text-foreground text-sm">{{ $event->location }}</p>
                </div>
                <div class="space-y-1">
                    <span class="text-muted-foreground">Danh mục</span>
                    <p class="font-semibold text-foreground text-sm capitalize">{{ $event->category?->name ?? '—' }}</p>
                </div>
                <div class="space-y-1">
                    <span class="text-muted-foreground">Chuyên ngành</span>
                    <p class="text-[13px] font-semibold text-primary mt-1">{{ $event->departments->pluck('name')->implode(', ') ?: '—' }}</p>
                </div>
            </div>
        </div>

        <!-- Event Description -->
        <div class="bg-card rounded-xl border border-border p-6 shadow-sm">
            <h3 class="text-sm font-bold text-foreground flex items-center gap-2 mb-4 pb-3 border-b border-border">
                <span class="w-1.5 h-4.5 bg-primary rounded-full"></span>
                Mô tả sự kiện
            </h3>
            <div class="prose dark:prose-invert max-w-none text-xs text-muted-foreground leading-relaxed">
                @if($event->description)
                    {!! $event->description !!}
                @else
                    <p class="italic text-muted-foreground/60">Không có mô tả chi tiết cho sự kiện này.</p>
                @endif
            </div>
        </div>

        <!-- Event Speakers -->
        <div class="bg-card rounded-xl border border-border p-6 shadow-sm">
            <h3 class="text-sm font-bold text-foreground flex items-center gap-2 mb-5 pb-3 border-b border-border">
                <span class="w-1.5 h-4.5 bg-primary rounded-full"></span>
                Diễn giả & Khách mời ({{ $event->speakers->count() }})
            </h3>
            @if($event->speakers->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($event->speakers as $speaker)
                        <div class="flex gap-3 p-3 rounded-lg border border-border bg-muted/20">
                            <div class="h-12 w-12 rounded-full overflow-hidden shrink-0 bg-muted border border-border">
                                @if($speaker->photo_url)
                                    @php
                                        $photoUrl = (strpos($speaker->photo_url, 'http') === 0 || strpos($speaker->photo_url, '/') === 0) ? $speaker->photo_url : \App\Helpers\FileHelper::url($speaker->photo_url);
                                    @endphp
                                    <img src="{{ $photoUrl }}" class="w-full h-full object-cover" alt="">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-primary/10 text-primary font-bold text-sm">
                                        {{ substr($speaker->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-xs font-bold text-foreground truncate">{{ $speaker->name }}</h4>
                                <p class="text-[10px] text-muted-foreground truncate">{{ $speaker->title ?? 'Diễn giả' }}</p>
                                @if($speaker->pivot && $speaker->pivot->role)
                                    <span class="inline-flex items-center rounded-md bg-primary/10 px-1.5 py-0.5 text-[9px] font-medium text-primary mt-1">
                                        {{ $speaker->pivot->role }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-6 border border-dashed border-border rounded-lg bg-muted/10">
                    <i data-lucide="users" class="h-8 w-8 text-muted-foreground/30 mx-auto mb-2"></i>
                    <p class="text-xs text-muted-foreground">Chưa liên kết diễn giả nào cho sự kiện.</p>
                </div>
            @endif
        </div>

        <!-- Event Schedule -->
        <div class="bg-card rounded-xl border border-border p-6 shadow-sm">
            <h3 class="text-sm font-bold text-foreground flex items-center gap-2 mb-5 pb-3 border-b border-border">
                <span class="w-1.5 h-4.5 bg-primary rounded-full"></span>
                Lịch trình chi tiết
            </h3>
            @if($event->scheduleItems->count() > 0)
                <div class="relative pl-6 border-l border-border space-y-6 ml-2.5">
                    @foreach($event->scheduleItems as $item)
                        <div class="relative">
                            <!-- Bullet -->
                            <span class="absolute -left-[31px] top-1 h-3.5 w-3.5 rounded-full border-2 border-background bg-primary shadow-sm"></span>
                            
                            <div class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-1 mb-1">
                                <h4 class="text-xs font-bold text-foreground">{{ $item->title }}</h4>
                                <span class="text-[10px] text-primary font-semibold font-mono bg-primary/10 px-2 py-0.5 rounded-md shrink-0">
                                    {{ $item->start_time ? $item->start_time->format('H:i') : '' }}
                                    @if($item->end_time) - {{ $item->end_time->format('H:i') }} @endif
                                </span>
                            </div>
                            @if($item->description)
                                <p class="text-[11px] text-muted-foreground mt-0.5 leading-relaxed">{{ $item->description }}</p>
                            @endif
                            @if($item->speaker)
                                <div class="flex items-center gap-1.5 mt-2">
                                    <i data-lucide="mic" class="h-3 w-3 text-muted-foreground"></i>
                                    <span class="text-[10px] text-muted-foreground font-medium">Diễn giả: {{ $item->speaker->name }}</span>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-6 border border-dashed border-border rounded-lg bg-muted/10">
                    <i data-lucide="calendar" class="h-8 w-8 text-muted-foreground/30 mx-auto mb-2"></i>
                    <p class="text-xs text-muted-foreground">Chưa có lịch trình chi tiết.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Right Column: QR Code & Documents & Media Gallery -->
    <div class="space-y-6">
        <!-- QR Code -->
        <div class="bg-card rounded-xl border border-border p-6 shadow-sm text-center flex flex-col justify-center items-center">
            <h3 class="text-sm font-bold text-foreground mb-1">Mã QR sự kiện</h3>
            <p class="text-[10px] text-muted-foreground mb-5">Quét để truy cập nhanh</p>
            <div class="p-4 bg-white dark:bg-white/90 border border-border rounded-xl shadow-sm mb-4 inline-block">
                {!! SimpleSoftwareIO\QrCode\Facades\QrCode::size(150)->generate(route('events.show', $event->slug)) !!}
            </div>
            <button onclick="navigator.clipboard.writeText('{{ route('events.show', $event->slug) }}'); alert('Đã sao chép link!');" class="inline-flex items-center justify-center rounded-lg text-xs font-semibold border border-border bg-background hover:bg-accent text-foreground h-9 px-4 gap-1.5 w-full transition-all">
                <i data-lucide="copy" class="h-3.5 w-3.5"></i> 
                Sao chép liên kết
            </button>
        </div>


        <!-- Gallery / Media -->
        <div class="bg-card rounded-xl border border-border p-6 shadow-sm">
            <h3 class="text-sm font-bold text-foreground flex items-center gap-2 mb-4 pb-3 border-b border-border">
                <span class="w-1.5 h-4.5 bg-primary rounded-full"></span>
                Thư viện ảnh/video ({{ $event->galleryImages->count() + $event->videos->count() }})
            </h3>
            @php
                $allMedia = $event->media()->whereIn('type', ['image', 'video'])->get();
            @endphp
            @if($allMedia->count() > 0)
                <div class="grid grid-cols-3 gap-2">
                    @foreach($allMedia->take(6) as $m)
                        <a href="{{ \App\Helpers\FileHelper::url($m->url) }}" target="_blank" class="aspect-square rounded-lg overflow-hidden border border-border hover:opacity-85 transition-opacity relative group bg-muted/40 grid place-items-center">
                            @if($m->type === 'image')
                                <img src="{{ \App\Helpers\FileHelper::url($m->url) }}" class="w-full h-full object-cover" alt="">
                            @else
                                <i data-lucide="video" class="h-5 w-5 text-primary/70"></i>
                                <span class="absolute bottom-1 right-1 bg-black/70 text-white text-[8px] px-1 rounded">video</span>
                            @endif
                        </a>
                    @endforeach
                </div>
                @if($allMedia->count() > 6)
                    <a href="{{ route('admin.media.index', ['search' => $event->title]) }}" class="block text-center text-xs text-primary font-medium hover:underline mt-3">
                        Xem tất cả tệp media
                    </a>
                @endif
            @else
                <p class="text-xs text-muted-foreground italic text-center py-4">Chưa có tệp hình ảnh/video.</p>
            @endif
        </div>
    </div>
</div>
@endsection
