@extends('layouts.app')
@php
    $pageTitle = 'Event Archive';
    $breadcrumbs = [['label' => 'Event Archive']];
@endphp

@section('content')
<div class="space-y-4">
    <div class="flex items-end justify-between flex-wrap gap-3">
        <div>
            <h1 class="text-[22px] font-semibold tracking-tight">Lưu trữ sự kiện</h1>
            <p class="text-xs text-muted-foreground mt-0.5">Kho lưu trữ hình ảnh, video của các sự kiện trường</p>
        </div>
    </div>

    {{-- Search & Filters --}}
    <div class="bg-card rounded-2xl border-none shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 transition-all duration-300 p-4">
        <form method="GET" action="{{ route('admin.archive.index') }}" class="flex flex-wrap items-center gap-2 w-full">
            <div class="relative flex-1 min-w-[220px]">
                <i data-lucide="search" class="absolute left-3.5 top-1/2 -translate-y-1/2 h-5 w-5 text-muted-foreground"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm sự kiện đã lưu trữ…" class="h-11 w-full rounded-xl border border-input pl-10 text-sm bg-background focus:outline-none focus:border-ring transition-all">
            </div>
            
            <select name="academic_year" onchange="this.form.submit()" class="h-11 border border-input rounded-xl text-sm bg-background px-3 focus:outline-none focus:border-ring transition-all text-muted-foreground">
                <option value="">Tất cả Năm học</option>
                @foreach($academicYears as $year)
                    <option value="{{ $year }}" {{ request('academic_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endforeach
            </select>

            <select name="semester" onchange="this.form.submit()" class="h-11 border border-input rounded-xl text-sm bg-background px-3 focus:outline-none focus:border-ring transition-all text-muted-foreground">
                <option value="">Tất cả Học kỳ</option>
                <option value="1" {{ request('semester') == '1' ? 'selected' : '' }}>Học kỳ Thu</option>
                <option value="2" {{ request('semester') == '2' ? 'selected' : '' }}>Học kỳ Xuân</option>
                <option value="3" {{ request('semester') == '3' ? 'selected' : '' }}>Học kỳ Hè</option>
            </select>

            <select name="category_id" onchange="this.form.submit()" class="h-11 border border-input rounded-xl text-sm bg-background px-3 focus:outline-none focus:border-ring transition-all text-muted-foreground">
                <option value="">Tất cả Danh mục</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>

            <button type="submit" class="inline-flex items-center justify-center rounded-xl text-xs font-semibold bg-primary text-primary-foreground h-11 px-4 hover:scale-[1.02] active:scale-[0.98] transition-all">Lọc</button>
            @if(request('search') || request('academic_year') || request('semester') || request('category_id'))
                <a href="{{ route('admin.archive.index') }}" class="inline-flex items-center justify-center rounded-xl text-xs font-semibold border border-input bg-background h-11 px-4 hover:bg-accent transition-all">Xóa lọc</a>
            @endif
        </form>
    </div>

    {{-- Archived events --}}
    @php
    $grouped = $events->groupBy(function($e) {
        return $e->event_date->format('Y');
    });
    @endphp

    @if($events->isEmpty())
    <div class="py-16 text-center bg-card rounded-2xl border-none shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 transition-all duration-300">
        <i data-lucide="archive" class="h-10 w-10 text-muted-foreground/30 mx-auto mb-3"></i>
        <p class="text-sm text-muted-foreground">Không có sự kiện nào trong lưu trữ.</p>
    </div>
    @else
    <div class="space-y-6">
        @foreach($grouped as $year => $yearEvents)
        <section class="space-y-3">
            <div class="flex items-center gap-3">
                <div class="h-7 w-1 rounded-full bg-primary"></div>
                <h2 class="text-sm font-semibold">{{ $year }}</h2>
                <span class="inline-flex items-center h-5 px-1.5 rounded text-[10px] font-medium bg-secondary text-secondary-foreground">{{ $yearEvents->count() }} sự kiện</span>
                <div class="flex-1 h-px bg-border"></div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
                @foreach($yearEvents as $e)
                <div class="bg-card rounded-2xl border-none shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 transition-all duration-300 overflow-hidden bg-card rounded-2xl border-none shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 transition-all duration-300-hover">
                    <div class="aspect-[16/9] bg-gradient-to-br from-primary/25 via-primary/10 to-accent grid place-items-center relative overflow-hidden">
                        @if($e->bannerImage)
                            <img src="{{ \App\Helpers\FileHelper::url($e->bannerImage->url) }}" class="w-full h-full object-cover" alt="">
                        @else
                            <i data-lucide="image" class="h-8 w-8 text-primary/50"></i>
                        @endif
                        <span class="absolute top-2 left-2 inline-flex items-center h-5 px-1.5 rounded text-[10px] font-medium bg-background/90 text-foreground">
                            {{ $e->category?->name ?? 'General' }}
                        </span>
                    </div>
                    <div class="p-3 space-y-2">
                        <div class="font-medium text-sm leading-snug line-clamp-2">{{ $e->title }}</div>
                        <div class="flex items-center gap-1.5 text-[11px] text-muted-foreground">
                            <i data-lucide="calendar" class="h-3 w-3"></i>
                            {{ $e->event_date->format('d/m/Y') }}
                        </div>
                        <div class="flex items-center justify-between text-[11px] text-muted-foreground pt-2 border-t border-border">
                            <span class="inline-flex items-center gap-1"><i data-lucide="eye" class="h-3 w-3"></i>{{ number_format($e->views_count ?? 0) }}</span>
                            <div class="flex items-center gap-1">
                                <a href="{{ route('admin.events.edit', $e) }}" class="h-6 w-6 rounded flex items-center justify-center hover:bg-accent text-muted-foreground hover:text-foreground transition-all" title="Sửa">
                                    <i data-lucide="pencil" class="h-3 w-3"></i>
                                </a>
                                <form action="{{ route('admin.events.destroy', $e) }}" method="POST" class="inline" onsubmit="return confirm('Xóa sự kiện này?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="h-6 w-6 rounded flex items-center justify-center hover:bg-red-50 hover:text-red-500 text-muted-foreground transition-all" title="Xóa">
                                        <i data-lucide="trash-2" class="h-3 w-3"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endforeach
    </div>
    @endif
</div>
@endsection
