@extends('layouts.app', ['hideTopMenu' => true])

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
            <div class="step-indicator" style="flex: 1; text-align: center; position: relative;">
                <div class="step-circle active w-8 h-8 rounded-full flex items-center justify-center bg-primary text-white font-bold mx-auto mb-2 relative z-10 text-[14px]">1</div>
                <span class="text-[11px] font-semibold text-primary">Thông tin</span>
            </div>
            <!-- Step 2: Choose Template -->
            <div class="step-indicator" style="flex: 1; text-align: center; position: relative;">
                <div class="step-circle inactive w-8 h-8 rounded-full flex items-center justify-center bg-slate-100 text-slate-400 font-bold mx-auto mb-2 relative z-10 text-[14px]">2</div>
                <span class="text-[11px] font-medium text-slate-400">Chọn mẫu</span>
            </div>
            <!-- Step 3: Design -->
            <div class="step-indicator" style="flex: 1; text-align: center; position: relative;">
                <div class="step-circle inactive w-8 h-8 rounded-full flex items-center justify-center bg-slate-100 text-slate-400 font-bold mx-auto mb-2 relative z-10 text-[14px]">3</div>
                <span class="text-[11px] font-medium text-slate-400">Thiết kế</span>
            </div>
            <!-- Step 4: Preview -->
            <div class="step-indicator" style="flex: 1; text-align: center; position: relative;">
                <div class="step-circle inactive w-8 h-8 rounded-full flex items-center justify-center bg-slate-100 text-slate-400 font-bold mx-auto mb-2 relative z-10 text-[14px]">4</div>
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
                    <input class="uni-input" id="event_date" name="event_date" value="{{ old('event_date') }}" required type="datetime-local" placeholder="Chọn ngày và giờ bắt đầu..."/>
                    @error('event_date') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="uni-label" for="end_date">Ngày & Giờ kết thúc (tùy chọn)</label>
                    <input class="uni-input" id="end_date" name="end_date" value="{{ old('end_date') }}" type="datetime-local" placeholder="Chọn ngày và giờ kết thúc (Tùy chọn)..."/>
                    @error('end_date') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="mt-5">
                <label class="uni-label" for="location">Địa điểm / Phòng <span class="text-red-400">*</span></label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-400 text-[18px]">location_on</span>
                    <input class="uni-input pl-10" id="location" name="location" value="{{ old('location') }}" required type="text" placeholder="VD: Phòng Studio, Tầng 3"/>
                </div>
                @error('location') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div class="mt-5">
                <label class="uni-label" for="registration_link">Link đăng ký tham gia (Google Form...)</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-400 text-[18px]">link</span>
                    <input class="uni-input pl-10" id="registration_link" name="registration_link" value="{{ old('registration_link') }}" type="url" placeholder="VD: https://docs.google.com/forms/..."/>
                </div>
                @error('registration_link') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
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
                <div class="md:col-span-2">
                    <label class="uni-label" for="department_ids">Chuyên ngành (Có thể chọn nhiều)</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 mt-2">
                        @foreach($departments as $dept)
                            <label class="relative block cursor-pointer group">
                                <input type="checkbox" name="department_ids[]" value="{{ $dept->id }}" {{ (is_array(old('department_ids')) && in_array($dept->id, old('department_ids'))) ? 'checked' : '' }} class="peer sr-only">
                                <div class="flex items-center justify-center px-3 py-2.5 border border-slate-200 rounded-xl bg-white text-[13px] font-semibold text-slate-600 transition-all duration-200 peer-checked:border-brand-orange peer-checked:bg-orange-50 peer-checked:text-brand-orange group-hover:border-brand-orange/50 shadow-sm text-center h-full">
                                    {{ $dept->name }}
                                </div>
                                <div class="absolute -top-1.5 -right-1.5 w-5 h-5 bg-brand-orange text-white rounded-full flex items-center justify-center opacity-0 peer-checked:opacity-100 transition-all duration-200 transform scale-50 peer-checked:scale-100 shadow-md">
                                    <span class="material-symbols-outlined text-[12px] font-bold">check</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    @error('department_ids') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
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
                <div class="flex items-center justify-between gap-3 mb-2 flex-wrap">
                    <label class="uni-label mb-0">Chọn diễn giả (Có thể chọn nhiều)</label>
                    <div class="flex items-center gap-2 w-full sm:w-auto">
                        <button type="button" class="open-add-speaker-modal-btn btn-ghost py-1.5 px-3 text-xs flex items-center gap-1 border border-slate-200">
                            <span class="material-symbols-outlined text-[16px]">add</span>
                            Thêm mới
                        </button>
                        <div class="relative flex-1 sm:w-64">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-400 text-[18px]">search</span>
                            <input type="text" id="speaker_search" placeholder="Tìm kiếm diễn giả..." class="uni-input py-1.5 text-xs" style="padding-left: 2.5rem !important;">
                        </div>
                    </div>
                </div>
                <div id="speaker_list_container" class="grid grid-cols-1 md:grid-cols-2 gap-3 max-h-[240px] overflow-y-auto p-2 border border-slate-200 rounded-xl bg-slate-50/50">
                    @forelse($speakers as $speaker)
                        @php
                            $photoUrl = $speaker->photo_url 
                                ? ((strpos($speaker->photo_url, 'http') === 0 || strpos($speaker->photo_url, '/') === 0) ? $speaker->photo_url : \App\Helpers\FileHelper::url($speaker->photo_url)) 
                                : 'https://ui-avatars.com/api/?name='.urlencode($speaker->name).'&background=random';
                        @endphp
                        <label class="flex items-center justify-between p-3 bg-white border border-slate-200 rounded-lg cursor-pointer hover:border-brand-orange transition-all relative">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" name="speaker_ids[]" value="{{ $speaker->id }}" {{ is_array(old('speaker_ids')) && in_array($speaker->id, old('speaker_ids')) ? 'checked' : '' }} class="rounded border-slate-300 text-brand-orange focus:ring-brand-orange w-4 h-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $photoUrl }}" class="w-8 h-8 rounded-full object-cover">
                                    <div>
                                        <p class="text-[13px] font-semibold text-primary speaker-name-text">{{ $speaker->name }}</p>
                                        <p class="text-[11px] text-slate-400 speaker-title-text">{{ $speaker->title ?? 'Diễn giả' }}</p>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="speaker-details-btn p-1 text-slate-400 hover:text-brand-orange hover:bg-slate-50 rounded-lg transition-colors z-20"
                                data-name="{{ $speaker->name }}"
                                data-title="{{ $speaker->title ?? '' }}"
                                data-photo="{{ $photoUrl }}"
                                data-bio="{{ $speaker->bio ?? '' }}"
                                data-type="{{ $speaker->type ?? 'speaker' }}">
                                <span class="material-symbols-outlined text-[20px]">info</span>
                            </button>
                        </label>
                    @empty
                        <div class="col-span-full py-6 text-center">
                            <p class="text-[13px] text-slate-400">Chưa có diễn giả nào trong hệ thống.</p>
                            <button type="button" class="open-add-speaker-modal-btn inline-flex items-center gap-1.5 text-brand-orange text-[12px] font-semibold hover:underline mt-2">
                                <span class="material-symbols-outlined text-[16px]">add_circle</span>
                                Thêm diễn giả mới
                            </button>
                        </div>
                    @endforelse
                    
                    <!-- Search Empty State -->
                    <div id="speaker_search_empty" class="hidden col-span-full py-6 text-center">
                        <p class="text-[13px] text-slate-400">Không tìm thấy diễn giả nào khớp với từ khóa.</p>
                        <button type="button" class="open-add-speaker-modal-btn inline-flex items-center gap-1.5 text-brand-orange text-[12px] font-semibold hover:underline mt-2">
                            <span class="material-symbols-outlined text-[16px]">add_circle</span>
                            Thêm diễn giả mới
                        </button>
                    </div>
                </div>
                @error('speaker_ids') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
            </div>
        </section>



        <!-- Section 6: Banner -->
        <section class="uni-card p-6 space-y-5">
            <div class="flex items-center gap-2.5 border-b border-slate-100 pb-3">
                <span class="material-symbols-outlined text-primary text-[20px]">image</span>
                <h3 class="text-[16px] font-bold text-primary font-heading">Ảnh bìa sự kiện</h3>
            </div>
            
            <div id="preview_container" class="hidden rounded-xl overflow-hidden border border-slate-200 h-[320px] mb-4">
                <img id="banner_preview" src="" alt="Preview" class="w-full h-full object-cover">
            </div>

            <div class="border-2 border-dashed border-slate-200 rounded-xl p-10 flex flex-col items-center justify-center gap-3 bg-slate-50/30 hover:bg-slate-50 hover:border-brand-orange transition-all cursor-pointer relative">
                <input type="file" id="banner_image" name="banner_image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"/>
                <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center text-brand-orange">
                    <span class="material-symbols-outlined text-[28px]">cloud_upload</span>
                </div>
                <p class="text-[13px] font-semibold text-primary" id="banner_filename">Nhấn để tải ảnh bìa lên</p>
                <p class="text-[11px] text-slate-400">Khuyến nghị: 1200 x 480 pixels (PNG, JPG)</p>
                @error('banner_image') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
            </div>
        </section>

        <!-- Section 7: Status & Options -->
        <section class="uni-card p-6 space-y-4">
            <div class="flex items-center gap-2.5 border-b border-slate-100 pb-3">
                <span class="material-symbols-outlined text-primary text-[20px]">tune</span>
                <h3 class="text-[16px] font-bold text-primary font-heading">Trạng thái</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-1 gap-5">
                <div>
                    <label class="uni-label" for="status">Trạng thái ban đầu</label>
                    <select class="uni-input bg-slate-50 text-slate-500 cursor-not-allowed" id="status" disabled>
                        <option value="draft" selected>Bản nháp</option>
                    </select>
                    <p class="text-[11px] text-slate-500 mt-1">Sự kiện mới sẽ lưu ở dạng <strong>Bản nháp</strong>. Bạn có thể <strong>Xuất bản</strong> sau khi chọn mẫu và thiết kế ở bước sau.</p>
                </div>
            </div>
        </section>

        <!-- Form Actions -->
        <div class="flex items-center justify-between pt-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.events.index') }}" class="btn-ghost border border-slate-200">
                    Hủy bỏ
                </a>
                <button type="submit" name="redirect_to" value="index" class="btn-ghost border border-slate-200 flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[16px]">save</span>
                    Lưu sự kiện
                </button>
            </div>
            <button type="submit" name="redirect_to" value="design" class="btn-primary flex items-center gap-2">
                Chuyển sang Bước 2
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </button>
        </div>
    </form>
</div>

<!-- Speaker Details Modal -->
<div id="speakerModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-2xl max-w-md w-full shadow-2xl p-6 relative transform transition-all scale-95 duration-200 border border-slate-100">
        <!-- Close Button -->
        <button type="button" id="closeSpeakerModalBtn" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 p-1 hover:bg-slate-100 rounded-lg transition-all flex items-center justify-center">
            <span class="material-symbols-outlined text-[20px]">close</span>
        </button>
        
        <!-- Modal Content -->
        <div class="flex flex-col items-center text-center mt-2">
            <img id="modalSpeakerPhoto" src="" alt="" class="w-24 h-24 rounded-full object-cover shadow-md border-2 border-slate-100">
            <h3 id="modalSpeakerName" class="text-[18px] font-bold text-primary font-heading mt-4"></h3>
            <p id="modalSpeakerTitle" class="text-[13px] text-brand-orange font-semibold mt-1"></p>
            <span id="modalSpeakerType" class="mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800"></span>
            
            <div class="w-full border-t border-slate-100 my-4"></div>
            
            <div class="w-full text-left">
                <h4 class="text-[11px] uppercase tracking-wider text-slate-400 font-bold mb-1.5">Giới thiệu</h4>
                <p id="modalSpeakerBio" class="text-[13px] text-slate-600 leading-relaxed max-h-36 overflow-y-auto whitespace-pre-wrap bg-slate-50 p-3 rounded-lg border border-slate-100"></p>
            </div>
        </div>
    </div>
</div>

<!-- Add Speaker Modal -->
<div id="addSpeakerModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-2xl max-w-md w-full shadow-2xl p-6 relative transform transition-all scale-95 duration-200 border border-slate-100">
        <!-- Close Button -->
        <button type="button" id="closeAddSpeakerModalBtn" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 p-1 hover:bg-slate-100 rounded-lg transition-all flex items-center justify-center">
            <span class="material-symbols-outlined text-[20px]">close</span>
        </button>
        
        <h3 class="text-[18px] font-bold text-primary font-heading mb-4">Thêm diễn giả mới</h3>
        
        <form id="ajaxAddSpeakerForm" class="space-y-4">
            <div>
                <label class="uni-label" for="new_speaker_name">Họ & Tên <span class="text-red-400">*</span></label>
                <input type="text" id="new_speaker_name" name="name" required class="uni-input py-2 text-xs" placeholder="VD: Nguyễn Văn A">
            </div>
            <div>
                <label class="uni-label" for="new_speaker_title">Chức danh / Chuyên môn</label>
                <input type="text" id="new_speaker_title" name="title" class="uni-input py-2 text-xs" placeholder="VD: Chuyên gia Trí tuệ nhân tạo">
            </div>
            <div>

                <label class="uni-label" for="new_speaker_photo">Ảnh đại diện</label>
                <input type="file" id="new_speaker_photo" name="photo" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-50 file:text-brand-orange hover:file:bg-slate-100">
            </div>
            <div>
                <label class="uni-label" for="new_speaker_bio">Tiểu sử / Giới thiệu ngắn</label>
                <textarea id="new_speaker_bio" name="bio" rows="3" class="uni-input py-2 text-xs" placeholder="Giới thiệu kinh nghiệm, lĩnh vực hoạt động..."></textarea>
            </div>
            
            <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                <button type="button" id="cancelAddSpeakerBtn" class="btn-ghost py-2 text-xs">Hủy</button>
                <button type="submit" class="btn-primary py-2 text-xs flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px] hidden animate-spin" id="add_speaker_spinner">sync</span>
                    Lưu diễn giả
                </button>
            </div>
        </form>
    </div>
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

    // Speaker Modal logic
    const speakerModal = document.getElementById('speakerModal');
    const closeBtn = document.getElementById('closeSpeakerModalBtn');
    
    document.querySelectorAll('.speaker-details-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const name = this.getAttribute('data-name');
            const title = this.getAttribute('data-title');
            const photo = this.getAttribute('data-photo');
            const bio = this.getAttribute('data-bio');
            const type = this.getAttribute('data-type');
            
            document.getElementById('modalSpeakerPhoto').src = photo;
            document.getElementById('modalSpeakerPhoto').alt = name;
            document.getElementById('modalSpeakerName').textContent = name;
            document.getElementById('modalSpeakerTitle').textContent = title || 'Diễn giả';
            document.getElementById('modalSpeakerBio').textContent = bio || 'Chưa có thông tin giới thiệu.';
            
            const typeBadge = document.getElementById('modalSpeakerType');
            if (typeBadge) {
                typeBadge.textContent = 'Diễn giả';
                typeBadge.className = 'mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-blue-50 text-blue-700 border border-blue-100';
            }
            
            speakerModal.classList.remove('hidden');
        });
    });
    
    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            speakerModal.classList.add('hidden');
        });
    }
    
    window.addEventListener('click', function(e) {
        if (e.target === speakerModal) {
            speakerModal.classList.add('hidden');
        }
    });

    // Image Preview logic
    const bannerImageInput = document.getElementById('banner_image');
    const previewContainer = document.getElementById('preview_container');
    const bannerPreview = document.getElementById('banner_preview');
    const bannerFilename = document.getElementById('banner_filename');

    if (bannerImageInput) {
        bannerImageInput.addEventListener('change', function(e) {
            const file = this.files[0];
            if (file) {
                if (bannerFilename) {
                    bannerFilename.textContent = file.name;
                }
                const reader = new FileReader();
                reader.onload = function(event) {
                    bannerPreview.src = event.target.result;
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Speaker Search Filter logic
    const speakerSearch = document.getElementById('speaker_search');
    const speakerListContainer = document.getElementById('speaker_list_container');
    const speakerItems = speakerListContainer ? speakerListContainer.querySelectorAll('label') : [];
    const speakerEmptyState = document.getElementById('speaker_search_empty');

    if (speakerSearch) {
        speakerSearch.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            let hasVisibleItem = false;
            const items = speakerListContainer ? speakerListContainer.querySelectorAll('label') : [];

            items.forEach(item => {
                const nameNode = item.querySelector('.speaker-name-text');
                const titleNode = item.querySelector('.speaker-title-text');
                const name = nameNode ? nameNode.textContent.toLowerCase() : '';
                const title = titleNode ? titleNode.textContent.toLowerCase() : '';
                
                if (name.includes(query) || title.includes(query)) {
                    item.classList.remove('hidden');
                    hasVisibleItem = true;
                } else {
                    item.classList.add('hidden');
                }
            });

            if (hasVisibleItem) {
                if (speakerEmptyState) speakerEmptyState.classList.add('hidden');
            } else {
                if (speakerEmptyState) speakerEmptyState.classList.remove('hidden');
            }
        });
    }

    // Add Speaker Modal controls
    const addSpeakerModal = document.getElementById('addSpeakerModal');
    const openAddSpeakerBtns = document.querySelectorAll('.open-add-speaker-modal-btn');
    const closeAddSpeakerModalBtn = document.getElementById('closeAddSpeakerModalBtn');
    const cancelAddSpeakerBtn = document.getElementById('cancelAddSpeakerBtn');
    const ajaxAddSpeakerForm = document.getElementById('ajaxAddSpeakerForm');
    const addSpeakerSpinner = document.getElementById('add_speaker_spinner');

    if (openAddSpeakerBtns) {
        openAddSpeakerBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                addSpeakerModal.classList.remove('hidden');
            });
        });
    }

    const closeAddModal = () => {
        addSpeakerModal.classList.add('hidden');
        ajaxAddSpeakerForm.reset();
    };

    if (closeAddSpeakerModalBtn) closeAddSpeakerModalBtn.addEventListener('click', closeAddModal);
    if (cancelAddSpeakerBtn) cancelAddSpeakerBtn.addEventListener('click', closeAddModal);

    window.addEventListener('click', function(e) {
        if (e.target === addSpeakerModal) {
            closeAddModal();
        }
    });

    if (ajaxAddSpeakerForm) {
        ajaxAddSpeakerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (addSpeakerSpinner) addSpeakerSpinner.classList.remove('hidden');
            const submitBtn = ajaxAddSpeakerForm.querySelector('button[type="submit"]');
            if (submitBtn) submitBtn.disabled = true;

            const formData = new FormData(this);

            fetch('{{ route("admin.speakers.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                if (data.success && data.speaker) {
                    const sp = data.speaker;
                    
                    const photoUrl = sp.photo_url 
                        ? ((sp.photo_url.indexOf('http') === 0 || sp.photo_url.indexOf('/') === 0) ? sp.photo_url : `/storage/${sp.photo_url}`)
                        : `https://ui-avatars.com/api/?name=${encodeURIComponent(sp.name)}&background=random`;

                    const newHtml = `
                        <label class="flex items-center justify-between p-3 bg-white border border-slate-200 rounded-lg cursor-pointer hover:border-brand-orange transition-all relative">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" name="speaker_ids[]" value="${sp.id}" checked class="rounded border-slate-300 text-brand-orange focus:ring-brand-orange w-4 h-4">
                                <div class="flex items-center gap-3">
                                    <img src="${photoUrl}" class="w-8 h-8 rounded-full object-cover">
                                    <div>
                                        <p class="text-[13px] font-semibold text-primary speaker-name-text">${sp.name}</p>
                                        <p class="text-[11px] text-slate-400 speaker-title-text">${sp.title || 'Diễn giả'}</p>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="speaker-details-btn p-1 text-slate-400 hover:text-brand-orange hover:bg-slate-50 rounded-lg transition-colors z-20"
                                data-name="${sp.name}"
                                data-title="${sp.title || ''}"
                                data-photo="${photoUrl}"
                                data-bio="${sp.bio || ''}"
                                data-type="${sp.type || 'speaker'}">
                                <span class="material-symbols-outlined text-[20px]">info</span>
                            </button>
                        </label>
                    `;

                    const emptyState = document.getElementById('speaker_search_empty');
                    if (emptyState) {
                        emptyState.insertAdjacentHTML('beforebegin', newHtml);
                    } else {
                        speakerListContainer.insertAdjacentHTML('beforeend', newHtml);
                    }

                    // Re-bind details click listener
                    const newLabel = (emptyState ? emptyState.previousElementSibling : speakerListContainer.lastElementChild);
                    const newBtn = newLabel.querySelector('.speaker-details-btn');
                    if (newBtn) {
                        newBtn.addEventListener('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            
                            const name = this.getAttribute('data-name');
                            const title = this.getAttribute('data-title');
                            const photo = this.getAttribute('data-photo');
                            const bio = this.getAttribute('data-bio');
                            const type = this.getAttribute('data-type');
                            
                            document.getElementById('modalSpeakerPhoto').src = photo;
                            document.getElementById('modalSpeakerPhoto').alt = name;
                            document.getElementById('modalSpeakerName').textContent = name;
                            document.getElementById('modalSpeakerTitle').textContent = title || 'Diễn giả';
                            document.getElementById('modalSpeakerBio').textContent = bio || 'Chưa có thông tin giới thiệu.';
                            
                            const typeBadge = document.getElementById('modalSpeakerType');
                            if (typeBadge) {
                                typeBadge.textContent = 'Diễn giả';
                                typeBadge.className = 'mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-blue-50 text-blue-700 border border-blue-100';
                            }
                            
                            document.getElementById('speakerModal').classList.remove('hidden');
                        });
                    }

                    if (speakerSearch) {
                        speakerSearch.value = '';
                        speakerSearch.dispatchEvent(new Event('input'));
                    }

                    closeAddModal();
                } else {
                    alert('Không thể lưu diễn giả. Vui lòng thử lại.');
                }
            })
            .catch(err => {
                console.error(err);
                if (err.errors) {
                    const firstErr = Object.values(err.errors)[0][0];
                    alert('Lỗi: ' + firstErr);
                } else {
                    alert('Có lỗi xảy ra khi thêm diễn giả.');
                }
            })
            .finally(() => {
                if (addSpeakerSpinner) addSpeakerSpinner.classList.add('hidden');
                if (submitBtn) submitBtn.disabled = false;
            });
        });
    }

    function initDatePicker() {
        if (typeof flatpickr !== 'undefined') {
            flatpickr("#event_date, #end_date", {
                enableTime: true,
                dateFormat: "Y-m-d\\TH:i",
                altInput: true,
                altFormat: "d/m/Y H:i",
                time_24hr: true,
                locale: "vn"
            });
        } else {
            setTimeout(initDatePicker, 50);
        }
    }
    initDatePicker();
</script>
@endpush

@push('styles')
<link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
<style>
    /* Adjust flatpickr styles for better visibility */
    .flatpickr-calendar {
        font-family: 'Inter', sans-serif;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
        border: 1px solid #e2e8f0;
        z-index: 9999 !important; /* Ensure it stays above other elements */
    }
    .flatpickr-time input {
        font-size: 14px !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/vn.js"></script>
<script src="https://cdn.jsdelivr.net/npm/browser-image-compression@2.0.2/dist/browser-image-compression.js"></script>
<script>
    (function() {
        async function compressImage(file, maxWidthOrHeight = 400) {
            if (!file || !file.type.startsWith('image/')) return file;
            const options = { maxSizeMB: 0.3, maxWidthOrHeight: maxWidthOrHeight, useWebWorker: true };
            try {
                return await imageCompression(file, options);
            } catch (error) {
                console.error(error);
                return file;
            }
        }
        function attachCompression(inputId, maxWidthOrHeight) {
            const input = document.getElementById(inputId);
            if (!input || input.dataset.compressionAttached) return;
            input.dataset.compressionAttached = 'true';
            input.addEventListener('change', async function(e) {
                const file = e.target.files[0];
                if (file) {
                    const compressedFile = await compressImage(file, maxWidthOrHeight);
                    if (compressedFile !== file) {
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(new File([compressedFile], file.name, { type: compressedFile.type }));
                        input.files = dataTransfer.files;
                    }
                }
            });
        }
        attachCompression('new_speaker_photo', 400);
        attachCompression('banner_image', 1200);
    })();
</script>
@endpush

