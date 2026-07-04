@extends('layouts.app')

@php
    $pageTitle = 'Speakers & Guests';
    $breadcrumbs = [['label' => 'Speakers / Guests']];
@endphp

@section('content')
    <div class="space-y-4">
        {{-- Header & Toolbar --}}
        <div class="flex items-end justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-[22px] font-semibold tracking-tight">Diễn giả &amp; Khách mời</h1>
                <p class="text-xs text-muted-foreground mt-0.5">Danh sách diễn giả và khách mời của các sự kiện</p>
            </div>
            <div class="flex items-center gap-2">
                <form method="GET" action="{{ route('admin.speakers.index') }}" class="relative w-64 hidden md:flex items-center gap-1.5">
                    <div class="relative flex-1">
                        <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-muted-foreground"></i>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm diễn giả…"
                            class="h-11 w-full rounded-xl border border-input pl-10 pr-3 text-sm bg-background focus:outline-none focus:border-ring transition-all">
                    </div>
                    <button type="submit" class="inline-flex items-center justify-center rounded-xl text-xs font-semibold bg-primary text-primary-foreground h-11 px-3 hover:scale-[1.02] active:scale-[0.98] transition-all">Tìm</button>
                    @if(request('search'))
                        <a href="{{ route('admin.speakers.index') }}" class="inline-flex items-center justify-center rounded-xl text-xs font-semibold border border-input bg-background h-11 px-3 hover:bg-accent transition-all">Xóa</a>
                    @endif
                </form>
                <a href="{{ route('admin.speakers.create') }}"
                    class="inline-flex items-center gap-1.5 h-11 px-5 text-sm font-semibold bg-primary text-primary-foreground hover:bg-primary/90 rounded-xl transition-all shadow-sm">
                    <i data-lucide="plus" class="h-5 w-5"></i> Thêm diễn giả
                </a>
            </div>
        </div>

        {{-- Speakers & Guests Split Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            {{-- Speakers Column --}}
            <div>
                <div class="flex items-center gap-2 mb-4 border-b border-border pb-2">
                    <span class="w-1.5 h-5 bg-blue-500 rounded-full"></span>
                    <h2 class="text-[16px] font-semibold tracking-tight text-foreground">Diễn giả</h2>
                    <span class="ml-2 inline-flex items-center justify-center bg-muted text-muted-foreground text-[11px] font-semibold rounded-full h-5 px-2">
                        {{ $speakers->filter(fn($s) => ($s->type ?? 'speaker') !== 'guest')->count() }}
                    </span>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @forelse($speakers->filter(fn($s) => ($s->type ?? 'speaker') !== 'guest') as $speaker)
                        @include('admin.speakers._card', ['speaker' => $speaker])
                    @empty
                        <div class="col-span-full py-12 text-center bg-card rounded-lg border border-border shadow-sm">
                            <i data-lucide="mic-off" class="h-8 w-8 text-muted-foreground/30 mx-auto mb-3"></i>
                            <p class="text-sm text-muted-foreground mb-4">Chưa có diễn giả nào.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Guests Column --}}
            <div>
                <div class="flex items-center gap-2 mb-4 border-b border-border pb-2">
                    <span class="w-1.5 h-5 bg-amber-500 rounded-full"></span>
                    <h2 class="text-[16px] font-semibold tracking-tight text-foreground">Khách mời</h2>
                    <span class="ml-2 inline-flex items-center justify-center bg-muted text-muted-foreground text-[11px] font-semibold rounded-full h-5 px-2">
                        {{ $speakers->filter(fn($s) => ($s->type ?? 'speaker') === 'guest')->count() }}
                    </span>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @forelse($speakers->filter(fn($s) => ($s->type ?? 'speaker') === 'guest') as $speaker)
                        @include('admin.speakers._card', ['speaker' => $speaker])
                    @empty
                        <div class="col-span-full py-12 text-center bg-card rounded-lg border border-border shadow-sm">
                            <i data-lucide="user-x" class="h-8 w-8 text-muted-foreground/30 mx-auto mb-3"></i>
                            <p class="text-sm text-muted-foreground mb-4">Chưa có khách mời nào.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

        {{-- Pagination --}}
        @if($speakers->hasPages())
            <div class="flex justify-center mt-4">
                {{ $speakers->links() }}
            </div>
        @endif
    </div>
@endsection