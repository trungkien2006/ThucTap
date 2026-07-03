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

        {{-- Speakers Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
            @forelse($speakers as $speaker)
                <div class="bg-card rounded-lg border border-border p-4 shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
                    <div>
                        {{-- Header Card --}}
                        <div class="flex items-start gap-3 mb-3">
                            <div class="h-12 w-12 shrink-0 rounded-full bg-gradient-to-br from-primary to-primary/60 text-primary-foreground grid place-items-center text-sm font-semibold overflow-hidden">
                                @if($speaker->photo_url)
                                    <img src="{{ $speaker->photo_url }}" alt="{{ $speaker->name }}" class="w-full h-full object-cover">
                                @else
                                    {{ collect(explode(' ', $speaker->name))->map(fn($w) => substr($w, 0, 1))->slice(0, 2)->implode('') }}
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="text-sm font-semibold truncate">{{ $speaker->name }}</div>
                                @if($speaker->title)
                                    <div class="text-[11px] text-muted-foreground truncate" title="{{ $speaker->title }}">{{ $speaker->title }}</div>
                                @endif
                                <div class="mt-1">
                                    @if(($speaker->type ?? 'speaker') === 'guest')
                                        <span class="inline-flex items-center h-5 px-1.5 rounded text-[10px] font-medium bg-amber-50 border border-amber-200 text-amber-600">Khách mời</span>
                                    @else
                                        <span class="inline-flex items-center h-5 px-1.5 rounded text-[10px] font-medium bg-blue-50 border border-blue-200 text-blue-600">Diễn giả</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        {{-- Bio --}}
                        <p class="text-[11px] text-muted-foreground leading-relaxed line-clamp-2 mb-3">
                            {{ $speaker->bio ?? 'Chưa có tiểu sử.' }}
                        </p>
                    </div>

                    {{-- Footer: Event count & Actions --}}
                    <div class="flex items-center justify-between pt-3 border-t border-border mt-2">
                        <span class="inline-flex items-center h-5 px-1.5 rounded text-[10px] font-medium bg-secondary text-secondary-foreground">
                            {{ $speaker->events_count }} sự kiện
                        </span>
                        
                        <div class="flex items-center gap-1">
                            <a href="#" class="h-6 w-6 rounded flex items-center justify-center text-muted-foreground hover:bg-accent hover:text-foreground transition-all" title="LinkedIn">
                                <i data-lucide="linkedin" class="h-3 w-3"></i>
                            </a>
                            <a href="#" class="h-6 w-6 rounded flex items-center justify-center text-muted-foreground hover:bg-accent hover:text-foreground transition-all" title="Twitter">
                                <i data-lucide="twitter" class="h-3 w-3"></i>
                            </a>
                            <a href="#" class="h-6 w-6 rounded flex items-center justify-center text-muted-foreground hover:bg-accent hover:text-foreground transition-all" title="Website">
                                <i data-lucide="globe" class="h-3 w-3"></i>
                            </a>
                            <span class="text-muted-foreground/30 mx-1 text-xs">|</span>
                            <a href="{{ route('admin.speakers.edit', $speaker) }}" 
                               class="h-7 w-7 rounded-md flex items-center justify-center text-muted-foreground hover:bg-accent hover:text-foreground transition-all" title="Sửa">
                                <i data-lucide="pencil" class="h-3.5 w-3.5"></i>
                            </a>
                            <form action="{{ route('admin.speakers.destroy', $speaker) }}" method="POST" class="inline" 
                                  onsubmit="return confirm('Bạn có chắc chắn muốn ẩn diễn giả này không?');">
                                @csrf @method('DELETE')
                                <button type="submit" 
                                        class="h-7 w-7 rounded-md flex items-center justify-center text-muted-foreground hover:bg-red-50 hover:text-red-500 transition-all" title="Ẩn">
                                    <i data-lucide="trash-2" class="h-3.5 w-3.5"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center bg-card rounded-lg border border-border shadow-sm">
                    <i data-lucide="mic-off" class="h-10 w-10 text-muted-foreground/30 mx-auto mb-3"></i>
                    <p class="text-sm text-muted-foreground mb-4">Chưa có diễn giả nào.</p>
                    <a href="{{ route('admin.speakers.create') }}"
                        class="inline-flex items-center gap-1.5 h-11 px-5 text-sm font-semibold bg-primary text-primary-foreground hover:bg-primary/90 rounded-xl transition-all">
                        <i data-lucide="plus" class="h-5 w-5"></i> Thêm diễn giả đầu tiên
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($speakers->hasPages())
            <div class="flex justify-center mt-4">
                {{ $speakers->links() }}
            </div>
        @endif
    </div>
@endsection