@extends('layouts.app')
@php
    $pageTitle = 'Event Archive';
    $breadcrumbs = [['label' => 'Event Archive']];
@endphp

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex items-end justify-between flex-wrap gap-4">
        <div>
            <h1 class="text-[26px] font-bold text-slate-800 tracking-tight">Lưu trữ sự kiện</h1>
            <p class="text-[13px] text-slate-500 mt-1">Kho lưu trữ hình ảnh, video và thông tin của các sự kiện đã diễn ra</p>
        </div>
    </div>

    {{-- Search & Filters --}}
    <!-- Top Control Bar -->
    <div class="flex flex-wrap items-center gap-6 pb-4 border-b border-border text-sm text-foreground mb-6">
        <form action="{{ route('admin.archive.index') }}" method="GET" class="flex flex-wrap items-center gap-6 w-full lg:w-auto flex-1">
            <!-- Search Control -->
            <label class="flex items-center gap-2 cursor-text transition-colors group relative w-full lg:w-64 h-10 bg-white border border-border/60 hover:border-border rounded-lg px-3 shadow-sm focus-within:border-primary/50 focus-within:ring-2 focus-within:ring-primary/10">
                <i data-lucide="search" class="w-4 h-4 shrink-0 text-muted-foreground group-focus-within:text-primary transition-colors"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm sự kiện…" class="w-full font-medium bg-transparent border-0 focus:border-0 focus:outline-none shadow-none ring-0 focus:ring-0 p-0 text-sm placeholder:text-muted-foreground/70" style="border: none !important; box-shadow: none !important; outline: none !important;">
            </label>

            <!-- Year Control -->
            <label class="flex items-center gap-2 cursor-pointer hover:text-primary transition-colors group">
                <i data-lucide="calendar" class="w-4 h-4 shrink-0 pointer-events-none"></i>
                <select name="academic_year" onchange="this.form.submit()" class="font-medium bg-transparent border-none appearance-none focus:outline-none focus:ring-0 cursor-pointer hover:text-primary text-sm">
                    <option value="">Tất cả Năm học</option>
                    @foreach($academicYears as $year)
                        <option value="{{ $year }}" {{ request('academic_year') == $year ? 'selected' : '' }}>Năm học {{ $year }}</option>
                    @endforeach
                </select>
            </label>

            <!-- Semester Control -->
            <label class="flex items-center gap-2 cursor-pointer hover:text-primary transition-colors group">
                <i data-lucide="book-open" class="w-4 h-4 shrink-0 pointer-events-none"></i>
                <select name="semester" onchange="this.form.submit()" class="font-medium bg-transparent border-none appearance-none focus:outline-none focus:ring-0 cursor-pointer hover:text-primary text-sm">
                    <option value="">Tất cả Học kỳ</option>
                    <option value="1" {{ request('semester') == '1' ? 'selected' : '' }}>Học kỳ Thu</option>
                    <option value="2" {{ request('semester') == '2' ? 'selected' : '' }}>Học kỳ Xuân</option>
                    <option value="3" {{ request('semester') == '3' ? 'selected' : '' }}>Học kỳ Hè</option>
                </select>
            </label>

            <!-- Category Control -->
            <label class="flex items-center gap-2 cursor-pointer hover:text-primary transition-colors group">
                <i data-lucide="tag" class="w-4 h-4 shrink-0 pointer-events-none"></i>
                <select name="category_id" onchange="this.form.submit()" class="font-medium bg-transparent border-none appearance-none focus:outline-none focus:ring-0 cursor-pointer hover:text-primary text-sm max-w-[150px] truncate">
                    <option value="">Tất cả Danh mục</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </label>
        </form>
        @if(request('search') || request('academic_year') || request('semester') || request('category_id'))
        <div class="ml-auto flex items-center gap-6">
            <a href="{{ route('admin.archive.index') }}" class="text-sm font-medium text-muted-foreground hover:text-foreground transition-colors flex items-center gap-1.5" title="Xóa tất cả bộ lọc">
                <i data-lucide="x" class="h-4 w-4"></i> Xóa lọc
            </a>
        </div>
        @endif
    </div>

    {{-- Archived events --}}
    @php
    $grouped = $events->groupBy(function($e) {
        return $e->event_date->format('Y');
    });
    @endphp

    @if($events->isEmpty())
    <div class="py-20 text-center bg-white rounded-2xl border border-slate-200/60 shadow-sm flex flex-col items-center justify-center">
        <div class="h-16 w-16 rounded-full bg-slate-50 flex items-center justify-center mb-4">
            <i data-lucide="archive-x" class="h-8 w-8 text-slate-400"></i>
        </div>
        <h3 class="text-[15px] font-semibold text-slate-700 mb-1">Không tìm thấy sự kiện</h3>
        <p class="text-[13px] text-slate-500">Chưa có sự kiện nào trong kho lưu trữ hoặc không khớp với bộ lọc.</p>
        @if(request('search') || request('academic_year') || request('semester') || request('category_id'))
            <a href="{{ route('admin.archive.index') }}" class="mt-4 inline-flex items-center gap-1.5 text-primary text-[13px] font-semibold hover:underline">
                <i data-lucide="refresh-cw" class="h-4 w-4"></i> Đặt lại bộ lọc
            </a>
        @endif
    </div>
    @else
    <div class="space-y-8">
        @foreach($grouped as $year => $yearEvents)
        <section class="space-y-4 animate-in fade-in slide-in-from-bottom-4 duration-500">
            <div class="flex items-center gap-3">
                <div class="h-8 w-1.5 rounded-full bg-primary"></div>
                <h2 class="text-xl font-bold text-slate-800">{{ $year }}</h2>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-slate-100 text-slate-600">{{ $yearEvents->count() }} sự kiện</span>
                <div class="flex-1 h-px bg-slate-200/60"></div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                @foreach($yearEvents as $e)
                <div class="group bg-white rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-xl hover:shadow-primary/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col">
                    <div class="aspect-[16/9] bg-slate-100 relative overflow-hidden">
                        @if($e->bannerImage)
                            <img src="{{ \App\Helpers\FileHelper::url($e->bannerImage->url) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 group-hover:scale-105 transition-transform duration-500">
                                <i data-lucide="image" class="h-10 w-10 text-slate-300"></i>
                            </div>
                        @endif
                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                            <a href="{{ route('events.show', $e->slug) }}" target="_blank" class="inline-flex items-center gap-1.5 text-white text-[12px] font-semibold hover:text-primary-200">
                                Xem chi tiết <i data-lucide="external-link" class="h-3 w-3"></i>
                            </a>
                        </div>
                        <!-- Status Badge -->
                        <div class="absolute top-3 right-3">
                            <span class="inline-flex items-center px-2 py-1 rounded-md text-[10px] font-bold bg-white/90 text-slate-700 shadow-sm backdrop-blur-sm">
                                Đã lưu trữ
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-4 flex flex-col flex-1">
                        <a href="{{ route('events.show', $e->slug) }}" target="_blank" class="font-bold text-[15px] leading-snug line-clamp-2 text-slate-800 group-hover:text-primary transition-colors mb-3" title="{{ $e->title }}">{{ $e->title }}</a>
                        
                        <div class="mt-auto pt-2">
                            <div class="flex items-center gap-2 text-[12px] text-slate-500 mb-4 font-medium flex-wrap">
                                <div class="flex items-center gap-1.5 bg-slate-50 border border-slate-100 px-2 py-1 rounded-md">
                                    <i data-lucide="calendar" class="h-3.5 w-3.5 text-primary"></i>
                                    {{ $e->event_date->format('d/m/Y') }}
                                </div>
                                <div class="flex items-center gap-1.5 bg-slate-50 border border-slate-100 px-2 py-1 rounded-md">
                                    <i data-lucide="eye" class="h-3.5 w-3.5 text-blue-500"></i>
                                    {{ number_format($e->views_count ?? 0) }}
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between pt-3 border-t border-slate-100">
                                <div class="text-[11px] text-slate-400 font-medium truncate max-w-[120px]" title="{{ $e->category->name ?? 'Sự kiện' }}">
                                    {{ $e->category->name ?? 'Sự kiện' }}
                                </div>
                                <div class="flex items-center gap-1.5 shrink-0">
                                    <button type="button" onclick="openUpdateLinkModal('{{ $e->id }}', '{{ addslashes($e->title) }}', '{{ $e->recap_drive_link }}', '{{ route('admin.events.save_recap_link', $e) }}')" class="h-8 px-3 rounded-lg flex items-center justify-center bg-amber-500/10 hover:bg-amber-500/20 text-amber-600 transition-all text-[12px] font-semibold" title="Đổi link Google Drive">
                                        <i data-lucide="link" class="h-4 w-4 mr-1.5"></i> Đổi Link
                                    </button>
                                    <a href="{{ route('admin.media.index', ['event_id' => $e->id]) }}" class="h-8 px-3 rounded-lg flex items-center justify-center bg-primary/10 hover:bg-primary/20 text-primary transition-all text-[12px] font-semibold" title="Xem thư viện media">
                                        <i data-lucide="images" class="h-4 w-4 mr-1.5"></i> Media
                                    </a>
                                    <form action="{{ route('admin.events.destroy', $e->id) }}" method="POST" class="inline-block" onsubmit="return confirmDelete(event, this, 'Bạn có chắc chắn muốn xóa sự kiện này? Hành động này không thể hoàn tác.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="h-8 px-3 rounded-lg flex items-center justify-center bg-red-500/10 hover:bg-red-500/20 text-red-600 transition-all text-[12px] font-semibold" title="Xóa sự kiện">
                                            <i data-lucide="trash-2" class="h-4 w-4 mr-1.5"></i> Xóa
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endforeach
    </div>
    @endif
</div>

<!-- Update Link Modal -->
<div id="updateLinkModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/50 backdrop-blur-sm transition-opacity duration-300 opacity-0">
    <div class="bg-white rounded-2xl shadow-xl w-[90%] max-w-lg p-6 transform scale-95 transition-transform duration-300">
        <div class="flex gap-4">
            <!-- Icon -->
            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                <i data-lucide="link" class="w-6 h-6 text-blue-600"></i>
            </div>
            
            <!-- Content -->
            <div class="flex-1 mt-1">
                <h3 class="text-xl font-bold text-slate-900">Thêm link Album Google Drive</h3>
                <p class="text-[15px] text-slate-500 mt-2 leading-relaxed">Nhập link thư mục Google Drive chứa ảnh recap cho sự kiện "<span id="modalEventTitle" class="font-medium text-slate-700"></span>".</p>
                
                <form id="modalUpdateLinkForm" method="POST" action="" class="mt-5">
                    @csrf
                    <input type="url" name="recap_drive_link" id="modalDriveLinkInput" placeholder="https://drive.google.com/drive/folders/..." required class="w-full text-[15px] font-medium border border-slate-200 rounded-xl px-4 py-3 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm outline-none transition-all">
                    
                    <div class="mt-6 flex justify-end gap-3">
                        <button type="button" onclick="closeUpdateLinkModal()" class="px-5 py-2.5 border border-slate-200 text-slate-700 bg-white hover:bg-slate-50 rounded-xl text-[15px] font-medium transition-colors">
                            Hủy
                        </button>
                        <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-[15px] font-medium transition-colors shadow-sm">
                            Lưu Link
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openUpdateLinkModal(eventId, eventTitle, currentLink, formAction) {
        document.getElementById('modalEventTitle').innerText = eventTitle;
        document.getElementById('modalDriveLinkInput').value = currentLink || '';
        document.getElementById('modalUpdateLinkForm').action = formAction;
        
        const modal = document.getElementById('updateLinkModal');
        const modalInner = modal.querySelector('div');
        
        modal.classList.remove('hidden');
        // trigger reflow
        void modal.offsetWidth;
        
        modal.classList.remove('opacity-0');
        modalInner.classList.remove('scale-95');
    }

    function closeUpdateLinkModal() {
        const modal = document.getElementById('updateLinkModal');
        const modalInner = modal.querySelector('div');
        
        modal.classList.add('opacity-0');
        modalInner.classList.add('scale-95');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
</script>
@endsection
