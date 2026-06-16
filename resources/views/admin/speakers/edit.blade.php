@extends('layouts.app')

@section('content')
<div class="max-w-[700px] mx-auto">
    <!-- Header -->
    <div class="flex items-center gap-3 mb-8">
        <a href="{{ route('admin.speakers.index') }}" class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 hover:bg-slate-50 hover:text-primary transition-all">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
        </a>
        <div>
            <h1 class="text-[22px] font-bold text-primary font-heading">Chỉnh sửa diễn giả</h1>
            <p class="text-[13px] text-slate-400 mt-0.5">Cập nhật thông tin của {{ $speaker->name }}.</p>
        </div>
    </div>

    <form action="{{ route('admin.speakers.update', $speaker) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="uni-card p-6 space-y-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Photo -->
                <div>
                    <label class="uni-label">Ảnh đại diện</label>
                    @if($speaker->photo_url)
                    <div class="mb-3 w-32 h-32 rounded-xl overflow-hidden border border-slate-200">
                        <img src="{{ $speaker->photo_url }}" class="w-full h-full object-cover" alt="{{ $speaker->name }}">
                    </div>
                    @endif
                    <div class="border-2 border-dashed border-slate-200 rounded-xl p-4 flex flex-col items-center justify-center gap-2 bg-slate-50/30 hover:bg-slate-50 hover:border-brand-orange transition-all cursor-pointer relative">
                        <input type="file" name="photo" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"/>
                        <span class="material-symbols-outlined text-[24px] text-brand-orange">add_a_photo</span>
                        <p class="text-[11px] text-slate-400">Chọn ảnh mới (tùy chọn)</p>
                    </div>
                    @error('photo') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Info -->
                <div class="space-y-4">
                    <div>
                        <label class="uni-label" for="name">Họ và tên <span class="text-red-400">*</span></label>
                        <input class="uni-input" id="name" name="name" value="{{ old('name', $speaker->name) }}" required type="text"/>
                        @error('name') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="uni-label" for="bio">Giới thiệu / Tiểu sử</label>
                        <textarea class="uni-input" id="bio" name="bio" rows="4">{{ old('bio', $speaker->bio) }}</textarea>
                        @error('bio') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('admin.speakers.index') }}" class="btn-ghost">Hủy bỏ</a>
            <button type="submit" class="btn-primary flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">check</span>
                Cập nhật
            </button>
        </div>
    </form>
</div>
@endsection
