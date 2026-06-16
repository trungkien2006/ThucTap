@extends('layouts.app')

@section('content')
<div class="max-w-[700px] mx-auto">
    <!-- Header -->
    <div class="flex items-center gap-3 mb-8">
        <a href="{{ route('admin.speakers.index') }}" class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 hover:bg-slate-50 hover:text-primary transition-all">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
        </a>
        <div>
            <h1 class="text-[22px] font-bold text-primary font-heading">Thêm diễn giả mới</h1>
            <p class="text-[13px] text-slate-400 mt-0.5">Nhập thông tin của diễn giả.</p>
        </div>
    </div>

    <form action="{{ route('admin.speakers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="uni-card p-6 space-y-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Photo Upload -->
                <div>
                    <label class="uni-label">Ảnh đại diện</label>
                    <div class="border-2 border-dashed border-slate-200 rounded-xl p-6 flex flex-col items-center justify-center gap-2 bg-slate-50/30 hover:bg-slate-50 hover:border-brand-orange transition-all cursor-pointer relative h-[180px]">
                        <input type="file" name="photo" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"/>
                        <span class="material-symbols-outlined text-[32px] text-brand-orange">add_a_photo</span>
                        <p class="text-[12px] font-semibold text-primary">Tải ảnh lên</p>
                        <p class="text-[10px] text-slate-400">Tỷ lệ 1:1 khuyến nghị</p>
                    </div>
                    @error('photo') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Name & Bio -->
                <div class="space-y-4">
                    <div>
                        <label class="uni-label" for="name">Họ và tên <span class="text-red-400">*</span></label>
                        <input class="uni-input" id="name" name="name" value="{{ old('name') }}" required type="text" placeholder="VD: TS. Nguyễn Văn A"/>
                        @error('name') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="uni-label" for="bio">Giới thiệu / Tiểu sử</label>
                        <textarea class="uni-input" id="bio" name="bio" rows="4" placeholder="Chuyên môn, kinh nghiệm, thành tựu...">{{ old('bio') }}</textarea>
                        @error('bio') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('admin.speakers.index') }}" class="btn-ghost">Hủy bỏ</a>
            <button type="submit" class="btn-primary flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">check</span>
                Thêm diễn giả
            </button>
        </div>
    </form>
</div>
@endsection
