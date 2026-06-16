@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
    <div>
        <h1 class="text-[24px] font-bold text-primary font-heading leading-tight">Quản lý Media</h1>
        <p class="text-[13px] text-slate-400 mt-1">Tải lên, xem và quản lý hình ảnh, video của sự kiện.</p>
    </div>
    <button onclick="document.getElementById('uploadModal').classList.remove('hidden')" class="btn-primary flex items-center gap-2 w-fit">
        <span class="material-symbols-outlined text-[18px]">cloud_upload</span>
        Tải lên Media
    </button>
</div>

<!-- Filter Bar -->
<div class="uni-card p-4 mb-6">
    <div class="flex flex-wrap items-center gap-3">
        <form method="GET" class="flex items-center gap-3 flex-1">
            <div class="relative flex-1 max-w-md">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-400 text-[18px]">search</span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm media..." class="uni-input pl-10"/>
            </div>
            <select name="type" onchange="this.form.submit()" class="uni-input w-auto">
                <option value="">Tất cả loại</option>
                <option value="image" {{ request('type') == 'image' ? 'selected' : '' }}>Hình ảnh</option>
                <option value="video" {{ request('type') == 'video' ? 'selected' : '' }}>Video</option>
            </select>
        </form>
        <div class="flex gap-1 border border-slate-200 rounded-xl overflow-hidden">
            <button onclick="setView('grid')" id="viewGrid" class="px-3 py-2 text-slate-400 hover:bg-slate-50 transition-all bg-slate-50 text-primary">
                <span class="material-symbols-outlined text-[18px]">grid_view</span>
            </button>
            <button onclick="setView('list')" id="viewList" class="px-3 py-2 text-slate-400 hover:bg-slate-50 transition-all">
                <span class="material-symbols-outlined text-[18px]">view_list</span>
            </button>
        </div>
    </div>
</div>

<!-- Media Gallery Grid -->
@if($media->count() > 0)
<div id="mediaGridView" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-8">
    @foreach($media as $item)
    <div class="media-grid-item">
        <div class="aspect-square bg-slate-100 relative group overflow-hidden">
            @if($item->type == 'image')
                <a href="{{ Storage::url($item->url) }}" target="_blank" class="block w-full h-full">
                    <img src="{{ Storage::url($item->url) }}" alt="{{ $item->caption }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"/>
                </a>
            @elseif($item->type == 'video')
                <a href="{{ Storage::url($item->url) }}" target="_blank" class="w-full h-full flex items-center justify-center bg-slate-800 hover:bg-slate-700 transition-colors">
                    <span class="material-symbols-outlined text-[32px] text-white/80 group-hover:scale-110 transition-transform">play_circle</span>
                </a>
            @else
                <a href="{{ Storage::url($item->url) }}" target="_blank" class="w-full h-full flex flex-col items-center justify-center bg-slate-50 gap-1 hover:bg-slate-100 transition-colors">
                    <span class="material-symbols-outlined text-[28px] text-slate-300 group-hover:scale-110 transition-transform">description</span>
                    <span class="text-[10px] text-slate-400 uppercase font-bold">{{ pathinfo($item->url, PATHINFO_EXTENSION) }}</span>
                </a>
            @endif
        </div>
        <div class="p-2.5">
            <p class="text-[11px] font-medium text-primary truncate">{{ $item->caption ?? basename($item->url) }}</p>
            <div class="flex items-center justify-between mt-1.5">
                <span class="text-[10px] text-slate-400">
                    @if($item->type == 'image')
                        <span class="material-symbols-outlined text-[12px] align-middle">image</span> Ảnh
                    @elseif($item->type == 'video')
                        <span class="material-symbols-outlined text-[12px] align-middle">videocam</span> Video
                    @endif
                </span>
                <form action="{{ route('admin.media.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Xóa media này?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-slate-300 hover:text-red-500 transition-colors">
                        <span class="material-symbols-outlined text-[14px]">delete</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- List View (hidden by default) -->
<div id="mediaListView" class="hidden mb-8">
    <div class="uni-card overflow-hidden">
        <table class="w-full text-left uni-table">
            <thead>
                <tr>
                    <th>Tệp</th>
                    <th>Loại</th>
                    <th>Sự kiện</th>
                    <th>Ngày tải</th>
                    <th class="text-right">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($media as $item)
                <tr>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg overflow-hidden bg-slate-100 shrink-0">
                                @if($item->type == 'image')
                                    <a href="{{ Storage::url($item->url) }}" target="_blank" class="block w-full h-full">
                                        <img src="{{ Storage::url($item->url) }}" class="w-full h-full object-cover hover:opacity-80 transition-opacity"/>
                                    </a>
                                @else
                                    <a href="{{ Storage::url($item->url) }}" target="_blank" class="w-full h-full flex items-center justify-center hover:bg-slate-200 transition-colors">
                                        <span class="material-symbols-outlined text-slate-300 text-[18px]">{{ $item->type == 'video' ? 'videocam' : 'description' }}</span>
                                    </a>
                                @endif
                            </div>
                            <a href="{{ Storage::url($item->url) }}" target="_blank" class="text-[13px] font-medium text-primary hover:text-brand-orange hover:underline truncate max-w-[200px]" title="{{ $item->caption ?? basename($item->url) }}">{{ $item->caption ?? basename($item->url) }}</a>
                        </div>
                    </td>
                    <td><span class="badge-info">{{ ucfirst($item->type) }}</span></td>
                    <td class="text-[13px] text-slate-500">{{ $item->event?->title ?? '—' }}</td>
                    <td class="text-[12px] text-slate-400">{{ $item->created_at?->format('d/m/Y') ?? '—' }}</td>
                    <td class="text-right">
                        <form action="{{ route('admin.media.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Xóa?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:bg-red-50 hover:text-red-500 transition-all">
                                <span class="material-symbols-outlined text-[18px]">delete</span>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@if($media->hasPages())
<div class="flex justify-center">
    {{ $media->links() }}
</div>
@endif
@else
<div class="uni-card p-16 text-center">
    <span class="material-symbols-outlined text-[48px] text-slate-200 mb-3">perm_media</span>
    <p class="text-[14px] text-slate-400 mb-4">Chưa có media nào. Bắt đầu tải lên!</p>
    <button onclick="document.getElementById('uploadModal').classList.remove('hidden')" class="btn-orange inline-flex items-center gap-2">
        <span class="material-symbols-outlined text-[18px]">cloud_upload</span>
        Tải lên Media
    </button>
</div>
@endif

<!-- Upload Modal -->
<div id="uploadModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg mx-4 p-6">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-[16px] font-bold text-primary font-heading">Tải lên Media mới</h3>
            <button onclick="document.getElementById('uploadModal').classList.add('hidden')" class="w-8 h-8 rounded-lg flex items-center justify-center hover:bg-slate-100 text-slate-400">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div class="border-2 border-dashed border-slate-200 rounded-xl p-8 text-center bg-slate-50/30 hover:bg-slate-50 hover:border-brand-orange transition-all cursor-pointer relative">
                <input type="file" name="files[]" multiple accept="image/*,video/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"/>
                <span class="material-symbols-outlined text-[36px] text-brand-orange mb-2">cloud_upload</span>
                <p class="text-[13px] font-semibold text-primary">Nhấn hoặc kéo thả tệp vào đây</p>
                <p class="text-[11px] text-slate-400 mt-1">Hỗ trợ: JPG, PNG, WebP, GIF, MP4 (tối đa 10MB/tệp)</p>
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('uploadModal').classList.add('hidden')" class="btn-ghost">Hủy</button>
                <button type="submit" class="btn-primary flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">upload</span>
                    Tải lên
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function setView(mode) {
    const gridView = document.getElementById('mediaGridView');
    const listView = document.getElementById('mediaListView');
    const gridBtn = document.getElementById('viewGrid');
    const listBtn = document.getElementById('viewList');

    if (mode === 'grid') {
        gridView?.classList.remove('hidden');
        listView?.classList.add('hidden');
        gridBtn?.classList.add('bg-slate-50', 'text-primary');
        gridBtn?.classList.remove('text-slate-400');
        listBtn?.classList.remove('bg-slate-50', 'text-primary');
        listBtn?.classList.add('text-slate-400');
    } else {
        gridView?.classList.add('hidden');
        listView?.classList.remove('hidden');
        listBtn?.classList.add('bg-slate-50', 'text-primary');
        listBtn?.classList.remove('text-slate-400');
        gridBtn?.classList.remove('bg-slate-50', 'text-primary');
        gridBtn?.classList.add('text-slate-400');
    }
}
</script>
@endpush
