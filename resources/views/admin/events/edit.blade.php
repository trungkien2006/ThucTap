@extends('layouts.app')

@section('content')
<div class="max-w-[1000px] mx-auto">
    <!-- Page Header -->
    <div class="flex items-center gap-3 mb-8">
        <a href="{{ route('admin.events.show', $event) }}" class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 hover:bg-slate-50 hover:text-primary transition-all">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
        </a>
        <div>
            <h1 class="text-[24px] font-bold text-primary font-heading leading-tight">Chỉnh sửa sự kiện</h1>
            <p class="text-[13px] text-slate-400 mt-0.5">{{ $event->title }}</p>
        </div>
    </div>

    <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Section 1: Basic Info -->
        <section class="uni-card p-6 space-y-5">
            <div class="flex items-center gap-2.5 border-b border-slate-100 pb-3">
                <span class="material-symbols-outlined text-primary text-[20px]">info</span>
                <h3 class="text-[16px] font-bold text-primary font-heading">Thông tin cơ bản</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="uni-label" for="title">Tiêu đề sự kiện <span class="text-red-400">*</span></label>
                    <input class="uni-input" id="title" name="title" value="{{ old('title', $event->title) }}" required type="text"/>
                    @error('title') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="uni-label" for="slug">Đường dẫn (URL Slug) <span class="text-red-400">*</span></label>
                    <input class="uni-input" id="slug" name="slug" value="{{ old('slug', $event->slug) }}" required type="text"/>
                    @error('slug') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            <div>
                <label class="uni-label" for="description">Mô tả chi tiết <span class="text-red-400">*</span></label>
                <textarea class="uni-input" id="description" name="description" rows="4" required>{{ old('description', $event->description) }}</textarea>
                @error('description') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
            </div>
        </section>

        <!-- Section 2: Time & Location -->
        <section class="uni-card p-6 space-y-5">
            <div class="flex items-center gap-2.5 border-b border-slate-100 pb-3">
                <span class="material-symbols-outlined text-primary text-[20px]">schedule</span>
                <h3 class="text-[16px] font-bold text-primary font-heading">Thời gian & Địa điểm</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="uni-label" for="event_date">Ngày & Giờ <span class="text-red-400">*</span></label>
                    <input class="uni-input" id="event_date" name="event_date" value="{{ old('event_date', $event->event_date->format('Y-m-d\TH:i')) }}" required type="datetime-local"/>
                    @error('event_date') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="uni-label" for="location">Địa điểm <span class="text-red-400">*</span></label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-400 text-[18px]">location_on</span>
                        <input class="uni-input pl-10" id="location" name="location" value="{{ old('location', $event->location) }}" required type="text"/>
                    </div>
                    @error('location') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </section>

        <!-- Section 3: Classification -->
        <section class="uni-card p-6 space-y-5">
            <div class="flex items-center gap-2.5 border-b border-slate-100 pb-3">
                <span class="material-symbols-outlined text-primary text-[20px]">category</span>
                <h3 class="text-[16px] font-bold text-primary font-heading">Phân loại & Giới hạn</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <label class="uni-label" for="category_id">Loại sự kiện</label>
                    <select class="uni-input" id="category_id" name="category_id">
                        <option value="">— Chọn —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $event->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="uni-label" for="department_id">Khoa / Bộ phận</label>
                    <select class="uni-input" id="department_id" name="department_id">
                        <option value="">— Chọn —</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" {{ old('department_id', $event->department_id) == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="uni-label" for="max_attendees">Số lượng tối đa</label>
                    <input class="uni-input" id="max_attendees" name="max_attendees" value="{{ old('max_attendees', $event->max_attendees) }}" type="number" min="1"/>
                </div>
            </div>
        </section>

        <!-- Section 4: Speakers -->
        <section class="uni-card p-6 space-y-5">
            <div class="flex items-center gap-2.5 border-b border-slate-100 pb-3">
                <span class="material-symbols-outlined text-primary text-[20px]">groups</span>
                <h3 class="text-[16px] font-bold text-primary font-heading">Diễn giả</h3>
            </div>
            <div>
                <label class="uni-label">Chọn diễn giả (Có thể chọn nhiều)</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 max-h-[240px] overflow-y-auto p-2 border border-slate-200 rounded-xl bg-slate-50/50">
                    @forelse($speakers as $speaker)
                        <label class="flex items-center gap-3 p-3 bg-white border border-slate-200 rounded-lg cursor-pointer hover:border-brand-orange transition-all">
                            <input type="checkbox" name="speaker_ids[]" value="{{ $speaker->id }}" {{ (is_array(old('speaker_ids')) && in_array($speaker->id, old('speaker_ids'))) || (!old('speaker_ids') && $event->speakers->contains($speaker->id)) ? 'checked' : '' }} class="rounded border-slate-300 text-brand-orange focus:ring-brand-orange w-4 h-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ $speaker->photo_url ? Storage::url($speaker->photo_url) : 'https://ui-avatars.com/api/?name='.urlencode($speaker->name).'&background=random' }}" class="w-8 h-8 rounded-full object-cover">
                                <div>
                                    <p class="text-[13px] font-semibold text-primary">{{ $speaker->name }}</p>
                                    <p class="text-[11px] text-slate-400">{{ $speaker->title ?? 'Diễn giả' }}</p>
                                </div>
                            </div>
                        </label>
                    @empty
                        <div class="col-span-full py-6 text-center">
                            <p class="text-[13px] text-slate-400">Chưa có diễn giả nào trong hệ thống.</p>
                            <a href="{{ route('admin.speakers.create') ?? '#' }}" class="inline-flex items-center gap-1.5 text-brand-orange text-[12px] font-semibold hover:underline mt-2">
                                <span class="material-symbols-outlined text-[16px]">add_circle</span>
                                Thêm diễn giả mới
                            </a>
                        </div>
                    @endforelse
                </div>
                @error('speaker_ids') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
            </div>
        </section>

        <!-- Section 5: Banner -->
        <section class="uni-card p-6 space-y-5">
            <div class="flex items-center gap-2.5 border-b border-slate-100 pb-3">
                <span class="material-symbols-outlined text-primary text-[20px]">image</span>
                <h3 class="text-[16px] font-bold text-primary font-heading">Ảnh bìa</h3>
            </div>
            @if($event->bannerImage)
            <div class="rounded-xl overflow-hidden border border-slate-200 h-48">
                <img src="{{ Storage::url($event->bannerImage->url) }}" alt="{{ $event->title }}" class="w-full h-full object-cover"/>
            </div>
            @endif
            <div class="border-2 border-dashed border-slate-200 rounded-xl p-6 flex flex-col items-center justify-center gap-2 bg-slate-50/30 hover:bg-slate-50 hover:border-brand-orange transition-all cursor-pointer relative">
                <input type="file" id="banner_image" name="banner_image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"/>
                <span class="material-symbols-outlined text-[24px] text-brand-orange">cloud_upload</span>
                <p class="text-[12px] font-medium text-primary">Chọn ảnh mới (tùy chọn)</p>
            </div>
        </section>

        <!-- Section 5: Status & Options -->
        <section class="uni-card p-6 space-y-4">
            <div class="flex items-center gap-2.5 border-b border-slate-100 pb-3">
                <span class="material-symbols-outlined text-primary text-[20px]">tune</span>
                <h3 class="text-[16px] font-bold text-primary font-heading">Trạng thái & Tùy chọn</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="uni-label" for="status">Trạng thái <span class="text-red-400">*</span></label>
                    <select class="uni-input" id="status" name="status" required>
                        <option value="draft" {{ $event->status == 'draft' ? 'selected' : '' }}>Bản nháp</option>
                        <option value="published" {{ $event->status == 'published' ? 'selected' : '' }}>Đã xuất bản</option>
                        <option value="archived">Lưu trữ</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <label class="flex items-center gap-3 cursor-pointer pb-2">
                        <input type="checkbox" name="registration_open" value="1" {{ old('registration_open', $event->registration_open) ? 'checked' : '' }} class="rounded border-slate-300 text-brand-orange focus:ring-brand-orange w-4 h-4">
                        <span class="text-[13px] font-medium text-primary">Mở đăng ký</span>
                    </label>
                </div>
            </div>
        </section>

        <!-- Actions -->
        <div class="flex items-center justify-between pt-4">
            <a href="{{ route('admin.events.show', $event) }}" class="btn-ghost">Hủy bỏ</a>
            <div class="flex gap-3">
                <a href="{{ route('admin.events.design', $event) }}" class="btn-ghost border border-slate-200 flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[16px]">palette</span>
                    Thiết kế
                </a>
                <button type="submit" class="btn-primary flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">check</span>
                    Cập nhật sự kiện
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('title').addEventListener('input', function() {
        const title = this.value;
        const slug = title.toLowerCase()
            .replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a')
            .replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e')
            .replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i')
            .replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o')
            .replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u')
            .replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y')
            .replace(/đ/gi, 'd')
            .replace(/\s+/g, '-')
            .replace(/[^a-z0-9-]/g, '')
            .replace(/-+/g, '-')
            .replace(/^-|-$/g, '');
        
        // Only auto-fill if the user hasn't manually edited the slug
        const slugInput = document.getElementById('slug');
        if (!slugInput.dataset.manuallyEdited) {
            slugInput.value = slug;
        }
    });

    document.getElementById('slug').addEventListener('input', function() {
        this.dataset.manuallyEdited = true;
    });
</script>
@endpush
