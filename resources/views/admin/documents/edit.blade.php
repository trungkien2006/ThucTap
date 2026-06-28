@extends('layouts.app')

@section('content')
<div class="max-w-[700px] mx-auto">
    <!-- Header -->
    <div class="flex items-center gap-3 mb-8">
        <a href="{{ route('admin.documents.index') }}" class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 hover:bg-slate-50 hover:text-primary transition-all">
            <i data-lucide="arrow-left" class="h-5 w-5"></i>
        </a>
        <div>
            <h1 class="text-[22px] font-bold text-primary font-heading">Chỉnh sửa tài liệu</h1>
            <p class="text-[13px] text-slate-400 mt-0.5">Cập nhật thông tin của tài liệu: {{ $document->title }}</p>
        </div>
    </div>

    <form action="{{ route('admin.documents.update', $document) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-card rounded-xl border border-border p-6 space-y-5 shadow-sm">
            <!-- Title -->
            <div>
                <label class="block text-xs font-semibold text-foreground mb-1.5" for="title">Tên tài liệu <span class="text-red-400">*</span></label>
                <input class="flex h-11 w-full rounded-xl border border-input px-3 text-sm bg-muted/40 focus:outline-none focus:border-ring transition-all" id="title" name="title" value="{{ old('title', $document->title) }}" required type="text"/>
                @error('title') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Event -->
            <div>
                <label class="block text-xs font-semibold text-foreground mb-1.5" for="event_id">Sự kiện liên kết (Tùy chọn)</label>
                <select class="flex h-11 w-full rounded-xl border border-input px-3 text-sm bg-muted/40 focus:outline-none focus:border-ring transition-all cursor-pointer" id="event_id" name="event_id">
                    <option value="">Không có / Tất cả sự kiện</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}" {{ old('event_id', $document->event_id) == $event->id ? 'selected' : '' }}>
                            {{ $event->title }}
                        </option>
                    @endforeach
                </select>
                @error('event_id') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- File Stats Info (Read-only) -->
            <div class="bg-muted/40 rounded-xl p-4 text-xs space-y-1.5 text-muted-foreground border border-border">
                <div class="flex justify-between">
                    <span>Định dạng tệp:</span>
                    <span class="font-mono font-medium uppercase">{{ $document->file_type }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Kích thước:</span>
                    <span class="font-medium">
                        @if($document->file_size >= 1048576)
                            {{ number_format($document->file_size / 1048576, 1) }} MB
                        @else
                            {{ number_format($document->file_size / 1024, 1) }} KB
                        @endif
                    </span>
                </div>
                <div class="flex justify-between">
                    <span>Đường dẫn tệp:</span>
                    <span class="font-mono truncate max-w-[200px] sm:max-w-xs" title="{{ $document->url }}">{{ basename($document->url) }}</span>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('admin.documents.index') }}" class="inline-flex items-center justify-center rounded-xl text-xs font-semibold border border-input bg-background hover:bg-accent hover:text-accent-foreground h-11 px-6 transition-all">Hủy bỏ</a>
            <button type="submit" class="inline-flex items-center justify-center rounded-xl text-xs font-semibold bg-primary text-primary-foreground shadow hover:bg-primary/90 h-11 px-6 gap-2 transition-all">
                <i data-lucide="check" class="h-4.5 w-4.5"></i>
                Cập nhật
            </button>
        </div>
    </form>
</div>
@endsection
