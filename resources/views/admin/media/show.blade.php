@extends('layouts.app')
@php
    $pageTitle = 'Media Library';
    $breadcrumbs = [['label' => 'Media Library']];
    $totalCount = \App\Models\EventMedia::whereIn('type', ['image', 'video'])->count();
    $totalImages = \App\Models\EventMedia::where('type', 'image')->count();
    $totalVideos = \App\Models\EventMedia::where('type', 'video')->count();
@endphp

@section('content')
    <div class="space-y-4">
        <div class="flex items-end justify-between flex-wrap gap-3">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.media.index') }}" class="w-10 h-10 rounded-xl border border-border flex items-center justify-center text-muted-foreground hover:bg-accent hover:text-foreground transition-all">
                    <i data-lucide="arrow-left" class="h-5 w-5"></i>
                </a>
                <div>
                    <h1 class="text-[22px] font-semibold tracking-tight">Album: {{ $event->title }}</h1>
                    <p class="text-xs text-muted-foreground mt-0.5">{{ $media->total() }} tệp</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <button id="bulkDeleteBtn" onclick="bulkDeleteMedia()"
                    class="hidden items-center justify-center rounded-md text-xs font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring bg-red-500 text-white shadow hover:bg-red-600 h-8 px-3 gap-1.5 w-fit hover:scale-[1.02] active:scale-[0.98] transition-all">
                    <i data-lucide="trash-2" class="h-3.5 w-3.5"></i>
                    Xóa (<span id="bulkDeleteCount">0</span>) mục
                </button>
                <button onclick="document.getElementById('uploadMediaModal').classList.remove('hidden')"
                    class="inline-flex items-center justify-center rounded-md text-xs font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring bg-primary text-primary-foreground shadow hover:bg-primary/90 h-8 px-3 gap-1.5 w-fit hover:scale-[1.02] active:scale-[0.98] transition-all">
                    <i data-lucide="upload" class="h-3.5 w-3.5"></i>
                    Tải ảnh/video lên
                </button>
            </div>

        <div class="grid grid-cols-[1fr_260px] md:grid-cols-[1fr_320px] lg:grid-cols-[1fr_400px] xl:grid-cols-[1fr_480px] gap-4">
            {{-- Media Grid --}}
            <div class="space-y-3">
                <form action="{{ route('admin.media.index') }}" method="GET" class="flex flex-wrap items-center gap-3 justify-between sm:justify-end mb-4 bg-background p-2 rounded-lg border border-border">
                    <input type="hidden" name="event_id" value="{{ request('event_id') }}">
                    
                    <div class="flex items-center gap-2 mr-auto sm:mr-0 pl-2">
                        <input type="checkbox" id="selectAllCheckbox" onchange="toggleSelectAll(this)" class="w-4 h-4 rounded border-input text-primary focus:ring-primary cursor-pointer">
                        <label for="selectAllCheckbox" class="text-xs font-medium text-foreground cursor-pointer">Chọn tất cả</label>
                    </div>

                    <div class="flex items-center gap-2">
                        <div class="relative flex items-center shrink-0">
                            <select name="per_page" onchange="this.form.submit()"
                                class="h-9 pl-3 pr-8 w-32 rounded-lg border border-input text-xs bg-card appearance-none focus:outline-none focus:border-ring cursor-pointer transition-all shadow-sm">
                                <option value="15" {{ request('per_page', '15') == '15' ? 'selected' : '' }}>15 mục/trang</option>
                                <option value="30" {{ request('per_page') == '30' ? 'selected' : '' }}>30 mục/trang</option>
                                <option value="60" {{ request('per_page') == '60' ? 'selected' : '' }}>60 mục/trang</option>
                            </select>
                            <i data-lucide="chevron-down" class="absolute right-2.5 top-1/2 -translate-y-1/2 h-3.5 w-3.5 text-muted-foreground pointer-events-none"></i>
                        </div>
                        
                        <div class="relative flex items-center shrink-0">
                            <select name="sort" onchange="this.form.submit()"
                                class="h-9 pl-3 pr-8 w-32 rounded-lg border border-input text-xs bg-card appearance-none focus:outline-none focus:border-ring cursor-pointer transition-all shadow-sm">
                                <option value="date_desc" {{ request('sort') === 'date_desc' ? 'selected' : '' }}>Mới nhất</option>
                            <option value="date_asc" {{ request('sort') === 'date_asc' ? 'selected' : '' }}>Cũ nhất</option>
                        </select>
                            </select>
                            <i data-lucide="chevron-down" class="absolute right-2.5 top-1/2 -translate-y-1/2 h-3.5 w-3.5 text-muted-foreground pointer-events-none"></i>
                        </div>
                    </div>
                </form>

                <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-2.5">
                    @forelse($media as $m)
                        <div class="bg-card rounded-lg border border-border overflow-hidden shadow-sm hover:shadow-md transition-all group cursor-pointer media-item-card"
                            data-url="{{ \App\Helpers\FileHelper::url($m->url) }}" data-type="{{ $m->type }}"
                            data-caption="{{ $m->caption ?? basename($m->url) }}"
                            data-created-at="{{ $m->created_at ? $m->created_at->diffForHumans() : '—' }}"
                            data-event="{{ $m->event->title ?? '—' }}" data-delete-url="{{ route('admin.media.destroy', $m) }}">
                            <div
                                class="aspect-square bg-gradient-to-br from-primary/20 via-primary/5 to-accent grid place-items-center relative overflow-hidden">
                                
                                <!-- Selection Checkbox -->
                                <div class="absolute top-2 left-2 z-20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center p-1 bg-black/30 backdrop-blur-sm rounded-md" onclick="event.stopPropagation()">
                                    <input type="checkbox" class="media-checkbox w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary cursor-pointer shadow-sm" value="{{ $m->id }}" onchange="updateBulkDeleteUI()">
                                </div>
                                
                                @if($m->type === 'image')
                                    <img src="{{ \App\Helpers\FileHelper::url($m->url) }}" class="w-full h-full object-cover" alt="">
                                @elseif($m->type === 'video')
                                    <i data-lucide="video" class="h-8 w-8 text-primary/60"></i>
                                @elseif($m->type === 'document')
                                    <i data-lucide="file-text" class="h-8 w-8 text-primary/60"></i>
                                @endif
                            </div>
                            <div class="p-2">
                                <div class="text-[11px] font-medium truncate">{{ $m->caption ?? basename($m->url) }}</div>
                                <div class="text-[10px] text-muted-foreground flex justify-between">
                                    <span>{{ strtoupper($m->type) }}</span>
                                    <span>{{ $m->created_at ? $m->created_at->diffForHumans() : '—' }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-16 text-center">
                            <i data-lucide="image-off" class="h-10 w-10 text-muted-foreground/30 mx-auto mb-3"></i>
                            <p class="text-sm text-muted-foreground">Kho media trống.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                @if($media->hasPages())
                    <div class="flex justify-center mt-4">
                        {{ $media->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>

            {{-- Preview Panel --}}
            <div class="bg-card rounded-lg border border-border p-3 shadow-sm h-fit">
                @if($media->first())
                    @php $first = $media->first(); @endphp
                    <div id="preview-media-container" onclick="openLightbox()"
                        class="aspect-square rounded-md bg-gradient-to-br from-primary/20 via-primary/5 to-accent grid place-items-center overflow-hidden mb-3 relative group cursor-pointer">
                        @if($first->type === 'image')
                            <img src="{{ \App\Helpers\FileHelper::url($first->url) }}" class="w-full h-full object-cover rounded-md" alt="">
                        @elseif($first->type === 'video')
                            @if(str_contains($first->url, 'drive.google.com'))
                                <iframe src="{{ $first->url }}" class="w-full h-full rounded-md border-0" allow="autoplay" allowfullscreen></iframe>
                            @else
                                <video src="{{ \App\Helpers\FileHelper::url($first->url) }}" controls
                                    class="w-full h-full object-cover rounded-md"></video>
                            @endif
                        @else
                            <i data-lucide="file-text" class="h-10 w-10 text-primary/50"></i>
                        @endif
                        
                        <!-- Hover Zoom Indicator -->
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center rounded-md pointer-events-none">
                            <i data-lucide="zoom-in" class="text-white w-8 h-8"></i>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div id="preview-caption" class="text-sm font-semibold truncate">
                            {{ $first->caption ?? basename($first->url) }}
                        </div>
                        <div id="preview-type-badge" class="text-[11px] text-muted-foreground">{{ strtoupper($first->type) }}
                        </div>
                    </div>
                    <div class="space-y-1.5 text-[11px] border-t border-border pt-2">
                        <div class="flex justify-between gap-2">
                            <span class="text-muted-foreground">Đã tải lên</span>
                            <span id="preview-created-at"
                                class="font-medium truncate">{{ $first->created_at ? $first->created_at->diffForHumans() : '—' }}</span>
                        </div>
                        <div class="flex justify-between gap-2">
                            <span class="text-muted-foreground">Định dạng</span>
                            <span id="preview-format" class="font-medium">{{ strtoupper($first->type) }}</span>
                        </div>
                        <div class="flex justify-between gap-2">
                            <span class="text-muted-foreground">Sự kiện</span>
                            <span id="preview-event" class="font-medium truncate">{{ $first->event->title ?? '—' }}</span>
                        </div>
                    </div>
                    <div class="flex gap-2 pt-3 border-t border-border mt-2">
                        <form id="preview-delete-form" action="{{ route('admin.media.destroy', $first) }}" method="POST"
                            onsubmit="return confirm('Xóa file này?');" class="w-full">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="w-full h-11 text-sm bg-red-500 hover:bg-red-600 text-white rounded-xl flex items-center justify-center transition-all font-semibold">
                                Xóa
                            </button>
                        </form>
                    </div>
                @else
                    <div class="aspect-square rounded-md bg-muted grid place-items-center mb-3">
                        <i data-lucide="image" class="h-10 w-10 text-muted-foreground/40"></i>
                    </div>
                    <p class="text-xs text-muted-foreground text-center">Chọn một tệp để xem trước</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Upload Modal -->
    <div id="uploadMediaModal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
        <div class="bg-background border border-border rounded-xl shadow-lg w-full max-w-lg mx-4 p-6 relative">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-sm font-bold text-foreground leading-none">Tải lên Media</h3>
                <button onclick="document.getElementById('uploadMediaModal').classList.add('hidden')"
                    class="w-8 h-8 rounded-lg flex items-center justify-center hover:bg-accent text-muted-foreground hover:text-foreground transition-colors">
                    <i data-lucide="x" class="h-4 w-4"></i>
                </button>
            </div>

            <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <!-- File upload dropzone area -->
                <div
                    class="border-2 border-dashed border-border rounded-xl p-8 text-center bg-muted/20 hover:bg-muted/40 hover:border-muted transition-all cursor-pointer relative group">
                    <input type="file" name="files[]" multiple accept="image/*,video/*"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                        onchange="updateUploadFileLabel(this)" />
                    <div class="flex flex-col items-center justify-center">
                        <div
                            class="h-10 w-10 rounded-full bg-accent flex items-center justify-center mb-3 group-hover:scale-105 transition-transform">
                            <i data-lucide="upload" class="h-5 w-5 text-muted-foreground"></i>
                        </div>
                        <p id="uploadMediaLabelText" class="text-xs font-semibold text-foreground">Nhấn để chọn hoặc kéo thả
                            tệp tại đây</p>
                        <p class="text-[10px] text-muted-foreground mt-1">Hỗ trợ: Hình ảnh hoặc Video (tối đa 50MB/tệp)</p>
                    </div>
                </div>

                <!-- Select Event (Hidden, automatically selected) -->
                <input type="hidden" name="event_id" value="{{ $event->id }}">

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="document.getElementById('uploadMediaModal').classList.add('hidden')"
                        class="inline-flex items-center justify-center rounded-md text-xs font-medium transition-colors border border-input bg-background hover:bg-accent hover:text-accent-foreground h-8 px-4 hover:scale-[1.02] active:scale-[0.98] transition-all">Hủy</button>
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-md text-xs font-medium transition-colors bg-primary text-primary-foreground shadow hover:bg-primary/90 h-8 px-4 gap-1.5 hover:scale-[1.02] active:scale-[0.98] transition-all">
                        <i data-lucide="upload" class="h-3.5 w-3.5"></i>
                        Tải lên
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Lightbox Modal -->
    <div id="lightboxModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center bg-black/90 backdrop-blur-sm transition-opacity cursor-zoom-out p-4 md:p-8" onclick="this.classList.add('hidden')">
        <button class="absolute top-4 right-4 md:top-6 md:right-6 text-white/50 hover:text-white transition-colors z-10 cursor-pointer" type="button">
            <i data-lucide="x" class="w-8 h-8"></i>
        </button>
        <img id="lightboxImage" src="" class="max-w-full max-h-full object-contain rounded-sm shadow-2xl">
    </div>

    <script>
        function openLightbox() {
            const container = document.getElementById('preview-media-container');
            const img = container.querySelector('img');
            if (img && img.src) {
                document.getElementById('lightboxImage').src = img.src;
                document.getElementById('lightboxModal').classList.remove('hidden');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const cards = document.querySelectorAll('.media-item-card');
            const previewContainer = document.getElementById('preview-media-container');
            const previewCaption = document.getElementById('preview-caption');
            const previewTypeBadge = document.getElementById('preview-type-badge');
            const previewCreatedAt = document.getElementById('preview-created-at');
            const previewFormat = document.getElementById('preview-format');
            const previewEvent = document.getElementById('preview-event');
            const previewDeleteForm = document.getElementById('preview-delete-form');

            cards.forEach(card => {
                card.addEventListener('click', function (e) {
                    // Ignore click if user clicked inside the delete button form of the card
                    if (e.target.closest('form')) {
                        return;
                    }

                    const url = this.getAttribute('data-url');
                    const type = this.getAttribute('data-type');
                    const caption = this.getAttribute('data-caption');
                    const createdAt = this.getAttribute('data-created-at');
                    const event = this.getAttribute('data-event');
                    const deleteUrl = this.getAttribute('data-delete-url');

                    // Update preview container media rendering
                    if (type === 'image') {
                        previewContainer.innerHTML = `<img src="${url}" class="w-full h-full object-cover rounded-md" alt="">`;
                    } else if (type === 'video') {
                        if (url.includes('drive.google.com')) {
                            previewContainer.innerHTML = `<iframe src="${url}" class="w-full h-full rounded-md border-0" allow="autoplay" allowfullscreen></iframe>`;
                        } else {
                            previewContainer.innerHTML = `<video src="${url}" controls class="w-full h-full object-cover rounded-md"></video>`;
                        }
                    } else {
                        previewContainer.innerHTML = `<i data-lucide="file-text" class="h-10 w-10 text-primary/50"></i>`;
                    }

                    // Add hover overlay to dynamically loaded media
                    previewContainer.innerHTML += `
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center rounded-md pointer-events-none">
                            <i data-lucide="zoom-in" class="text-white w-8 h-8"></i>
                        </div>
                    `;

                    // Update info fields
                    previewCaption.textContent = caption;
                    previewTypeBadge.textContent = type.toUpperCase();
                    previewCreatedAt.textContent = createdAt;
                    previewFormat.textContent = type.toUpperCase();
                    previewEvent.textContent = event;

                    // Update action action url of delete form
                    previewDeleteForm.action = deleteUrl;

                    // Reinitialize lucide icons if library loaded
                    if (window.lucide) {
                        window.lucide.createIcons();
                    }
                });
            });

            // Close modal when clicking on backdrop
            document.getElementById('uploadMediaModal').addEventListener('click', function (e) {
                if (e.target === this) {
                    this.classList.add('hidden');
                }
            });
        });

        // Update file label text on selection
        function updateUploadFileLabel(input) {
            const textEl = document.getElementById('uploadMediaLabelText');
            if (input.files && input.files.length > 0) {
                if (input.files.length === 1) {
                    textEl.innerText = `Đã chọn: ${input.files[0].name}`;
                } else {
                    textEl.innerText = `Đã chọn ${input.files.length} tệp`;
                }
            } else {
                textEl.innerText = "Nhấn để chọn hoặc kéo thả tệp tại đây";
            }
        }

        // Bulk Delete Functions
        function toggleSelectAll(checkbox) {
            const checkboxes = document.querySelectorAll('.media-checkbox');
            checkboxes.forEach(cb => {
                cb.checked = checkbox.checked;
            });
            updateBulkDeleteUI();
        }

        function updateBulkDeleteUI() {
            const checkboxes = document.querySelectorAll('.media-checkbox');
            let selectedCount = 0;
            let allChecked = true;
            let hasUnchecked = false;

            checkboxes.forEach(cb => {
                if (cb.checked) {
                    selectedCount++;
                    // Make checkbox container always visible when checked
                    cb.parentElement.classList.remove('opacity-0');
                    cb.parentElement.classList.add('opacity-100');
                    cb.closest('.media-item-card').classList.add('ring-2', 'ring-primary');
                } else {
                    hasUnchecked = true;
                    // Revert to hover state visibility
                    cb.parentElement.classList.add('opacity-0');
                    cb.parentElement.classList.remove('opacity-100');
                    cb.closest('.media-item-card').classList.remove('ring-2', 'ring-primary');
                }
            });

            if (selectedCount === 0 || hasUnchecked) {
                allChecked = false;
            }

            const selectAllCheckbox = document.getElementById('selectAllCheckbox');
            if (selectAllCheckbox && checkboxes.length > 0) {
                selectAllCheckbox.checked = allChecked;
            }

            const bulkBtn = document.getElementById('bulkDeleteBtn');
            const bulkCount = document.getElementById('bulkDeleteCount');

            if (selectedCount > 0) {
                bulkBtn.style.display = 'inline-flex';
                bulkCount.textContent = selectedCount;
            } else {
                bulkBtn.style.display = 'none';
            }
        }

        async function bulkDeleteMedia() {
            const checkboxes = document.querySelectorAll('.media-checkbox:checked');
            if (checkboxes.length === 0) return;

            if (!confirm(`Bạn có chắc chắn muốn xóa ${checkboxes.length} tệp đã chọn? Hành động này không thể hoàn tác.`)) {
                return;
            }

            const ids = Array.from(checkboxes).map(cb => cb.value);

            try {
                const response = await fetch("{{ route('admin.media.bulk_destroy') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ ids: ids })
                });

                const data = await response.json();
                if (data.success) {
                    window.location.reload();
                } else {
                    alert('Đã xảy ra lỗi khi xóa media.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Đã xảy ra lỗi khi thực hiện xóa.');
            }
        }

        let lastChecked = null;

        // Initialize UI state
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.media-checkbox');
            checkboxes.forEach(cb => {
                cb.addEventListener('click', function(e) {
                    if (!lastChecked) {
                        lastChecked = this;
                    } else if (e.shiftKey) {
                        let inRange = false;
                        checkboxes.forEach(checkbox => {
                            if (checkbox === this || checkbox === lastChecked) {
                                inRange = !inRange;
                            }
                            if (inRange) {
                                checkbox.checked = lastChecked.checked;
                            }
                        });
                        this.checked = lastChecked.checked;
                    }
                    lastChecked = this;
                    updateBulkDeleteUI();
                });
            });

            updateBulkDeleteUI();
        });
    </script>
@endsection