@extends('layouts.app')

@section('content')
<div class="max-w-[1000px] mx-auto">
    <!-- Progress Indicator -->
    <div class="uni-card p-5 mb-8">
        <div class="flex items-center justify-between relative">
            <div class="absolute top-5 left-[60px] right-[60px] h-[2px] bg-slate-100 z-0"></div>
            <div class="absolute top-5 left-[60px] h-[2px] bg-emerald-400 z-0" style="width: calc(100%)"></div>

            <!-- Step 1: Details -->
            <div class="step-indicator" style="flex: 1; text-align: center; position: relative;">
                <div class="step-circle completed w-8 h-8 rounded-full flex items-center justify-center bg-emerald-100 text-emerald-600 font-bold mx-auto mb-2 relative z-10">
                    <span class="material-symbols-outlined text-[18px]">check</span>
                </div>
                <span class="text-[11px] font-medium text-emerald-600">Thông tin</span>
            </div>
            <!-- Step 2: Choose Template -->
            <div class="step-indicator" style="flex: 1; text-align: center; position: relative;">
                <div class="step-circle completed w-8 h-8 rounded-full flex items-center justify-center bg-emerald-100 text-emerald-600 font-bold mx-auto mb-2 relative z-10">
                    <span class="material-symbols-outlined text-[18px]">check</span>
                </div>
                <span class="text-[11px] font-medium text-emerald-600">Chọn mẫu</span>
            </div>
            <!-- Step 3: Design -->
            <div class="step-indicator" style="flex: 1; text-align: center; position: relative;">
                <div class="step-circle completed w-8 h-8 rounded-full flex items-center justify-center bg-emerald-100 text-emerald-600 font-bold mx-auto mb-2 relative z-10">
                    <span class="material-symbols-outlined text-[18px]">check</span>
                </div>
                <span class="text-[11px] font-medium text-emerald-600">Thiết kế</span>
            </div>
            <!-- Step 4: Preview (Active) -->
            <div class="step-indicator" style="flex: 1; text-align: center; position: relative;">
                <div class="step-circle active w-8 h-8 rounded-full flex items-center justify-center bg-primary text-white font-bold mx-auto mb-2 relative z-10 text-[14px]">4</div>
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
        <iframe src="{{ route('admin.events.preview_iframe', $event) }}" class="w-full h-[85vh] border-0 rounded-b-xl bg-white" title="Preview"></iframe>
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
