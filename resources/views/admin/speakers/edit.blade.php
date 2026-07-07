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
                    <label class="border-2 border-dashed border-slate-200 rounded-xl flex flex-col items-center justify-center gap-2 bg-slate-50/30 hover:bg-slate-50 hover:border-brand-orange transition-all cursor-pointer relative h-[180px] overflow-hidden w-full block">
                        <input type="file" name="photo" id="photoInput" accept="image/*" class="hidden"/>
                        
                        <div id="photoPlaceholder" class="flex flex-col items-center justify-center gap-2 relative z-10 pointer-events-none {{ $speaker->photo_url ? 'hidden' : '' }}">
                            <span class="material-symbols-outlined text-[24px] text-brand-orange">add_a_photo</span>
                            <p class="text-[11px] font-semibold text-primary">Tải ảnh mới lên</p>
                            <p class="text-[10px] text-slate-400">Tỷ lệ 1:1 khuyến nghị</p>
                        </div>

                        <img id="photoPreview" class="absolute inset-0 w-full h-full object-cover z-0 pointer-events-none {{ $speaker->photo_url ? '' : 'hidden' }}" src="{{ $speaker->photo_url ?? '#' }}" alt="Preview" />
                    </label>
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
                        <label class="uni-label" for="title">Chức danh / Đơn vị</label>
                        <input class="uni-input" id="title" name="title" value="{{ old('title', $speaker->title) }}" type="text" placeholder="VD: Giám đốc Nghiên cứu AI tại MIT Media Lab"/>
                        @error('title') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>

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

@push('scripts')
<script>
    document.getElementById('photoInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('photoPreview').src = event.target.result;
                document.getElementById('photoPreview').classList.remove('hidden');
                document.getElementById('photoPlaceholder').classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
