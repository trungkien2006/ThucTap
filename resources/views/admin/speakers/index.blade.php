@extends('layouts.app')

@php
    $pageTitle = 'Quản lý diễn giả';
    $breadcrumbs = [['label' => 'Quản lý diễn giả']];
@endphp

@section('content')
    <div class="space-y-4">
        {{-- Header & Toolbar --}}
        <div class="flex items-end justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-[22px] font-semibold tracking-tight">Quản lý Diễn giả</h1>
                <p class="text-xs text-muted-foreground mt-0.5">Danh sách diễn giả của các sự kiện</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.speakers.create') }}"
                    class="inline-flex items-center gap-1.5 h-11 px-5 text-sm font-semibold bg-primary text-primary-foreground hover:bg-primary/90 rounded-xl transition-all shadow-sm">
                    <i data-lucide="plus" class="h-5 w-5"></i> Thêm diễn giả
                </a>
            </div>
        </div>

        <!-- Top Control Bar -->
        <div class="flex flex-wrap items-center gap-6 pb-4 border-b border-border text-sm text-foreground mb-6">
            <form action="{{ route('admin.speakers.index') }}" method="GET" class="flex flex-wrap items-center gap-3 w-full lg:w-auto flex-1">
                <!-- Search Control -->
                <label class="flex items-center gap-2 cursor-text transition-colors group relative w-full lg:w-96 h-10 bg-white border border-border/60 hover:border-border rounded-lg px-3 shadow-sm focus-within:border-primary/50 focus-within:ring-2 focus-within:ring-primary/10">
                    <i data-lucide="search" class="w-4 h-4 shrink-0 text-muted-foreground group-focus-within:text-primary transition-colors"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm diễn giả…" class="w-full font-medium bg-transparent border-0 focus:border-0 focus:outline-none shadow-none ring-0 focus:ring-0 p-0 text-sm placeholder:text-muted-foreground/70" style="border: none !important; box-shadow: none !important; outline: none !important;">
                </label>
                <button type="submit" class="h-10 px-4 bg-primary text-primary-foreground text-sm font-medium rounded-lg hover:bg-primary/90 transition-colors shadow-sm whitespace-nowrap">
                    Tìm kiếm
                </button>
            </form>
            @if(request('search'))
                <div class="ml-auto flex items-center gap-6">
                    <a href="{{ route('admin.speakers.index') }}" class="text-sm font-medium text-muted-foreground hover:text-foreground transition-colors flex items-center gap-1.5" title="Xóa tìm kiếm">
                        <i data-lucide="x" class="h-4 w-4"></i> Xóa
                    </a>
                </div>
            @endif
        </div>

        {{-- Speakers Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
            @forelse($speakers as $speaker)
                <div class="bg-card rounded-2xl border-none shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 transition-all duration-300 p-5 bg-card rounded-2xl border-none shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 transition-all duration-300-hover flex flex-col justify-between">
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
                                <div class="text-sm font-semibold truncate flex items-center gap-1">
                                    <span class="text-muted-foreground font-mono text-xs shrink-0">#{{ ($speakers->currentPage() - 1) * $speakers->perPage() + $loop->iteration }}</span>
                                    <span class="truncate">{{ $speaker->name }}</span>
                                </div>
                                @if($speaker->title)
                                    <div class="text-[11px] text-muted-foreground truncate" title="{{ $speaker->title }}">{{ $speaker->title }}</div>
                                @endif
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
                <div class="col-span-full py-16 text-center bg-card rounded-lg border-none shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 transition-all duration-300">
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