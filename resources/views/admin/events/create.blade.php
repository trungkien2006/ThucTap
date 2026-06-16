@extends('layouts.app')

@section('content')
<div class="max-w-[1000px] mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-[28px] font-bold text-primary font-heading leading-tight">Tạo sự kiện mới</h1>
        <p class="text-[14px] text-slate-400 mt-1">Nhập thông tin cơ bản để bắt đầu quy trình tạo sự kiện.</p>
    </div>

    <!-- Progress Indicator -->
    <div class="uni-card p-5 mb-8">
        <div class="flex items-center justify-between relative">
            <!-- Progress Line -->
            <div class="absolute top-5 left-[60px] right-[60px] h-[2px] bg-slate-100 z-0"></div>
            <div class="absolute top-5 left-[60px] h-[2px] bg-primary z-0" style="width: calc(0%)"></div>

            <!-- Step 1: Details (Active) -->
            <div class="step-indicator">
                <div class="step-circle active">1</div>
                <span class="text-[11px] font-semibold text-primary">Thông tin</span>
            </div>
            <!-- Step 2: Design -->
            <div class="step-indicator">
                <div class="step-circle inactive">2</div>
                <span class="text-[11px] font-medium text-slate-400">Thiết kế</span>
            </div>
            <!-- Step 3: Preview -->
            <div class="step-indicator">
                <div class="step-circle inactive">3</div>
                <span class="text-[11px] font-medium text-slate-400">Xem trước</span>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Section 1: Basic Info -->
        <section class="uni-card p-6 space-y-5">
            <div class="flex items-center gap-2.5 border-b border-slate-100 pb-3">
                <span class="material-symbols-outlined text-primary text-[20px]">info</span>
                <h3 class="text-[16px] font-bold text-primary font-heading">Thông tin cơ bản</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="uni-label" for="title">Tiêu đề sự kiện <span class="text-red-400">*</span></label>
                    <input class="uni-input" id="title" name="title" value="{{ old('title') }}" required type="text" placeholder="VD: Workshop Sáng tạo nội dung số"/>
                    @error('title') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="uni-label" for="slug">Đường dẫn (URL Slug) <span class="text-red-400">*</span></label>
                    <div class="flex">
                        <span class="bg-slate-50 px-3 py-2.5 border border-r-0 border-slate-200 rounded-l-xl text-slate-400 text-[12px] flex items-center">unievent.edu/e/</span>
                        <input class="uni-input rounded-l-none" id="slug" name="slug" value="{{ old('slug') }}" required type="text" placeholder="workshop-sang-tao-2024"/>
                    </div>
                    @error('slug') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            <div>
                <label class="uni-label" for="description">Mô tả chi tiết <span class="text-red-400">*</span></label>
                <textarea class="uni-input" id="description" name="description" rows="4" required placeholder="Mô tả nội dung, hoạt động nổi bật, lý do tham gia...">{{ old('description') }}</textarea>
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
                    <label class="uni-label" for="event_date">Ngày & Giờ bắt đầu <span class="text-red-400">*</span></label>
                    <input class="uni-input" id="event_date" name="event_date" value="{{ old('event_date') }}" required type="datetime-local"/>
                    @error('event_date') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="uni-label" for="location">Địa điểm / Phòng <span class="text-red-400">*</span></label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-400 text-[18px]">location_on</span>
                        <input class="uni-input pl-10" id="location" name="location" value="{{ old('location') }}" required type="text" placeholder="VD: Phòng Studio, Tầng 3"/>
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
                    <label class="uni-label" for="category_id">Loại sự kiện <span class="text-red-400">*</span></label>
                    <select class="uni-input" id="category_id" name="category_id" required>
                        <option value="">— Chọn loại —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="uni-label" for="department_id">Khoa / Bộ phận</label>
                    <select class="uni-input" id="department_id" name="department_id">
                        <option value="">— Chọn khoa —</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                        @endforeach
                    </select>
                    @error('department_id') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="uni-label" for="max_attendees">Số lượng tối đa</label>
                    <input class="uni-input" id="max_attendees" name="max_attendees" value="{{ old('max_attendees') }}" type="number" min="1" placeholder="0 = Không giới hạn"/>
                    @error('max_attendees') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
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
                <label class="uni-label">Tìm kiếm diễn giả</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-400 text-[18px]">search</span>
                    <input class="uni-input pl-10" type="text" placeholder="Tìm theo tên diễn giả..." id="speakerSearch"/>
                </div>
            </div>
            <div class="border border-dashed border-slate-200 rounded-xl p-8 text-center bg-slate-50/50">
                <span class="material-symbols-outlined text-slate-300 text-[32px] mb-2">person_add</span>
                <p class="text-[13px] text-slate-400">Chưa có diễn giả nào. Tìm kiếm hoặc thêm mới bên dưới.</p>
            </div>
            <button type="button" class="flex items-center gap-1.5 text-brand-orange text-[13px] font-semibold hover:underline">
                <span class="material-symbols-outlined text-[18px]">add_circle</span>
                Thêm diễn giả mới
            </button>
        </section>

        <!-- Section 5: Banner -->
        <section class="uni-card p-6 space-y-5">
            <div class="flex items-center gap-2.5 border-b border-slate-100 pb-3">
                <span class="material-symbols-outlined text-primary text-[20px]">image</span>
                <h3 class="text-[16px] font-bold text-primary font-heading">Ảnh bìa sự kiện</h3>
            </div>
            <div class="border-2 border-dashed border-slate-200 rounded-xl p-10 flex flex-col items-center justify-center gap-3 bg-slate-50/30 hover:bg-slate-50 hover:border-brand-orange transition-all cursor-pointer relative">
                <input type="file" id="banner_image" name="banner_image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"/>
                <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center text-brand-orange">
                    <span class="material-symbols-outlined text-[28px]">cloud_upload</span>
                </div>
                <p class="text-[13px] font-semibold text-primary">Nhấn để tải ảnh bìa lên</p>
                <p class="text-[11px] text-slate-400">Khuyến nghị: 1200 x 480 pixels (PNG, JPG)</p>
                @error('banner_image') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
            </div>
        </section>

        <!-- Options -->
        <div class="uni-card p-6">
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox" name="registration_open" value="1" {{ old('registration_open', true) ? 'checked' : '' }} class="rounded border-slate-300 text-brand-orange focus:ring-brand-orange w-4 h-4">
                <span class="text-[13px] font-medium text-primary">Mở đăng ký ngay sau khi tạo</span>
            </label>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-between pt-4">
            <a href="{{ route('admin.events.index') }}" class="btn-ghost">
                Hủy bỏ
            </a>
            <button class="btn-primary flex items-center gap-2" type="submit">
                Tạo sự kiện & Tiếp tục
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </button>
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
