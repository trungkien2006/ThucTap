@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
    <div>
        <h1 class="text-[24px] font-bold text-primary font-heading leading-tight">Quản lý Tài liệu</h1>
        <p class="text-[13px] text-slate-400 mt-1">Tải lên và quản lý tài liệu đính kèm cho sự kiện.</p>
    </div>
    <button onclick="document.getElementById('uploadDocModal').classList.remove('hidden')" class="btn-primary flex items-center gap-2 w-fit">
        <span class="material-symbols-outlined text-[18px]">upload_file</span>
        Tải lên tài liệu
    </button>
</div>

<!-- Search -->
<div class="uni-card p-4 mb-6">
    <form method="GET" class="flex items-center gap-3">
        <div class="relative flex-1">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-400 text-[18px]">search</span>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm tài liệu..." class="uni-input pl-10"/>
        </div>
        <button type="submit" class="btn-primary py-2.5">Tìm kiếm</button>
    </form>
</div>

<!-- Documents Table -->
@if($documents->count() > 0)
<div class="uni-card overflow-hidden mb-8">
    <table class="w-full text-left uni-table">
        <thead>
            <tr>
                <th>Tài liệu</th>
                <th>Sự kiện</th>
                <th>Loại tệp</th>
                <th>Kích thước</th>
                <th>Ngày tải</th>
                <th class="text-right">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($documents as $doc)
            <tr>
                <td>
                    <div class="flex items-center gap-3">
                        @php
                            $iconMap = [
                                'pdf' => ['picture_as_pdf', 'text-red-500 bg-red-50'],
                                'doc' => ['description', 'text-blue-500 bg-blue-50'],
                                'docx' => ['description', 'text-blue-500 bg-blue-50'],
                                'xls' => ['table_chart', 'text-green-500 bg-green-50'],
                                'xlsx' => ['table_chart', 'text-green-500 bg-green-50'],
                                'ppt' => ['slideshow', 'text-orange-500 bg-orange-50'],
                                'pptx' => ['slideshow', 'text-orange-500 bg-orange-50'],
                                'zip' => ['folder_zip', 'text-amber-500 bg-amber-50'],
                            ];
                            $ext = $doc->file_type ?? pathinfo($doc->url, PATHINFO_EXTENSION);
                            $icon = $iconMap[$ext] ?? ['draft', 'text-slate-400 bg-slate-50'];
                        @endphp
                        <a href="{{ Storage::url($doc->url) }}" target="_blank" class="w-10 h-10 rounded-xl {{ $icon[1] }} flex items-center justify-center shrink-0 hover:opacity-80 transition-opacity">
                            <span class="material-symbols-outlined text-[20px]">{{ $icon[0] }}</span>
                        </a>
                        <div>
                            <a href="{{ Storage::url($doc->url) }}" target="_blank" class="text-[13px] font-medium text-primary hover:text-brand-orange hover:underline block">{{ $doc->title ?? basename($doc->url) }}</a>
                            <p class="text-[11px] text-slate-400 uppercase">.{{ $ext }}</p>
                        </div>
                    </div>
                </td>
                <td class="text-[13px] text-slate-500">{{ $doc->event?->title ?? '—' }}</td>
                <td><span class="badge-info uppercase text-[10px]">{{ $ext }}</span></td>
                <td class="text-[12px] text-slate-400">
                    @if($doc->file_size)
                        {{ number_format($doc->file_size / 1024, 1) }} KB
                    @else
                        —
                    @endif
                </td>
                <td class="text-[12px] text-slate-400">{{ $doc->created_at?->format('d/m/Y') ?? '—' }}</td>
                <td class="text-right">
                    <div class="flex items-center justify-end gap-1">
                        <a href="{{ Storage::url($doc->url) }}" download class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:bg-slate-50 hover:text-primary transition-all" title="Tải xuống">
                            <span class="material-symbols-outlined text-[18px]">download</span>
                        </a>
                        <form action="{{ route('admin.documents.destroy', $doc) }}" method="POST" class="inline" onsubmit="return confirm('Xóa tài liệu này?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:bg-red-50 hover:text-red-500 transition-all" title="Xóa">
                                <span class="material-symbols-outlined text-[18px]">delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@if($documents->hasPages())
<div class="flex justify-center">
    {{ $documents->links() }}
</div>
@endif
@else
<div class="uni-card p-16 text-center">
    <span class="material-symbols-outlined text-[48px] text-slate-200 mb-3">folder_open</span>
    <p class="text-[14px] text-slate-400 mb-4">Chưa có tài liệu nào.</p>
    <button onclick="document.getElementById('uploadDocModal').classList.remove('hidden')" class="btn-orange inline-flex items-center gap-2">
        <span class="material-symbols-outlined text-[18px]">upload_file</span>
        Tải lên tài liệu đầu tiên
    </button>
</div>
@endif

<!-- Upload Modal -->
<div id="uploadDocModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg mx-4 p-6">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-[16px] font-bold text-primary font-heading">Tải lên tài liệu</h3>
            <button onclick="document.getElementById('uploadDocModal').classList.add('hidden')" class="w-8 h-8 rounded-lg flex items-center justify-center hover:bg-slate-100 text-slate-400">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        <form action="{{ route('admin.documents.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div class="border-2 border-dashed border-slate-200 rounded-xl p-8 text-center bg-slate-50/30 hover:bg-slate-50 hover:border-brand-orange transition-all cursor-pointer relative">
                <input type="file" name="files[]" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.zip" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"/>
                <span class="material-symbols-outlined text-[36px] text-brand-orange mb-2">upload_file</span>
                <p class="text-[13px] font-semibold text-primary">Nhấn để chọn tệp</p>
                <p class="text-[11px] text-slate-400 mt-1">Hỗ trợ: PDF, DOC, DOCX, XLS, PPT, ZIP (tối đa 10MB/tệp)</p>
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('uploadDocModal').classList.add('hidden')" class="btn-ghost">Hủy</button>
                <button type="submit" class="btn-primary flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">upload</span>
                    Tải lên
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
