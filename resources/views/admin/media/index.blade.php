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
            <div>
                <h1 class="text-[22px] font-semibold tracking-tight">Thư viện Media</h1>
                <p class="text-xs text-muted-foreground mt-0.5">{{ $totalCount }} tệp · {{ $totalImages }} hình ảnh,
                    {{ $totalVideos }} video
                </p>
            </div>
            <button onclick="document.getElementById('uploadMediaModal').classList.remove('hidden')"
                class="inline-flex items-center justify-center rounded-md text-xs font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring bg-primary text-primary-foreground shadow hover:bg-primary/90 h-8 px-3 gap-1.5 w-fit hover:scale-[1.02] active:scale-[0.98] transition-all">
                <i data-lucide="upload" class="h-3.5 w-3.5"></i>
                Tải lên
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-[220px_1fr_280px] gap-4">
            {{-- Folder Sidebar --}}
            <div class="bg-card rounded-lg border border-border p-3 shadow-sm h-fit">
                <div class="text-[11px] uppercase tracking-wide text-muted-foreground font-medium mb-2">Thư mục</div>
                <div class="space-y-0.5">
                    @php
                        $activeType = request('type');
                    @endphp
                    <a href="{{ route('admin.media.index', array_filter(['search' => request('search')])) }}"
                        class="flex items-center gap-2.5 w-full text-left px-3 py-2.5 rounded-lg text-sm hover:bg-accent hover:text-accent-foreground transition-all {{ is_null($activeType) ? 'bg-accent text-accent-foreground font-medium' : 'text-muted-foreground' }}">
                        <i data-lucide="folder" class="h-4.5 w-4.5"></i>
                        <span class="flex-1 truncate">Tất cả tệp</span>
                        <span class="text-[11px] tabular-nums">{{ $totalCount }}</span>
                    </a>
                    <a href="{{ route('admin.media.index', array_filter(['type' => 'image', 'search' => request('search')])) }}"
                        class="flex items-center gap-2.5 w-full text-left px-3 py-2.5 rounded-lg text-sm hover:bg-accent hover:text-accent-foreground transition-all {{ $activeType === 'image' ? 'bg-accent text-accent-foreground font-medium' : 'text-muted-foreground' }}">
                        <i data-lucide="image" class="h-4.5 w-4.5"></i>
                        <span class="flex-1 truncate">Hình ảnh</span>
                        <span class="text-[11px] tabular-nums">{{ $totalImages }}</span>
                    </a>
                    <a href="{{ route('admin.media.index', array_filter(['type' => 'video', 'search' => request('search')])) }}"
                        class="flex items-center gap-2.5 w-full text-left px-3 py-2.5 rounded-lg text-sm hover:bg-accent hover:text-accent-foreground transition-all {{ $activeType === 'video' ? 'bg-accent text-accent-foreground font-medium' : 'text-muted-foreground' }}">
                        <i data-lucide="video" class="h-4.5 w-4.5"></i>
                        <span class="flex-1 truncate">Video</span>
                        <span class="text-[11px] tabular-nums">{{ $totalVideos }}</span>
                    </a>
                </div>
            </div>

            {{-- Media Grid --}}
            <div class="space-y-3">
                <form action="{{ route('admin.media.index') }}" method="GET"
                    class="bg-card rounded-lg border border-border p-2 shadow-sm flex items-center gap-2">
                    @if(request('type'))
                        <input type="hidden" name="type" value="{{ request('type') }}">
                    @endif
                    <div class="relative flex-1">
                        <i data-lucide="search"
                            class="absolute left-3.5 top-1/2 -translate-y-1/2 h-5 w-5 text-muted-foreground"></i>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm tệp…"
                            class="h-11 w-full rounded-xl border border-input pl-10 text-sm bg-muted/40 focus:outline-none focus:border-ring transition-all">
                    </div>
                    <div class="relative flex items-center shrink-0">
                        <!-- Đã đổi pl-9 thành pl-3 -->
                        <select name="sort" onchange="this.form.submit()"
                            class="h-11 pl-9 pr-9 w-36 rounded-xl border border-input text-xs bg-muted/40 appearance-none focus:outline-none focus:border-ring cursor-pointer transition-all text-center">
                            <option value="date_desc" {{ request('sort') === 'date_desc' ? 'selected' : '' }}>Mới nhất
                            </option>
                            <option value="date_asc" {{ request('sort') === 'date_asc' ? 'selected' : '' }}>Cũ nhất</option>
                            <option value="size" {{ request('sort') === 'size' ? 'selected' : '' }}>Kích thước</option>
                            <option value="event" {{ request('sort') === 'event' ? 'selected' : '' }}>Sự kiện</option>
                        </select>

                        <!-- Đã xóa icon arrow-up-down ở đây -->

                        <i data-lucide="chevron-down"
                            class="absolute right-2.5 top-1/2 -translate-y-1/2 h-3.5 w-3.5 text-muted-foreground pointer-events-none"></i>
                    </div>
                </form>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-3">
                    @forelse($media as $m)
                        <div class="bg-card rounded-lg border border-border overflow-hidden shadow-sm hover:shadow-md transition-all group cursor-pointer media-item-card"
                            data-url="{{ \App\Helpers\FileHelper::url($m->url) }}" data-type="{{ $m->type }}"
                            data-caption="{{ $m->caption ?? basename($m->url) }}"
                            data-created-at="{{ $m->created_at ? $m->created_at->diffForHumans() : '—' }}"
                            data-event="{{ $m->event->title ?? '—' }}" data-delete-url="{{ route('admin.media.destroy', $m) }}">
                            <div
                                class="aspect-square bg-gradient-to-br from-primary/20 via-primary/5 to-accent grid place-items-center relative overflow-hidden">
                                @if($m->type === 'image')
                                    <img src="{{ \App\Helpers\FileHelper::url($m->url) }}" class="w-full h-full object-cover" alt="">
                                    <span
                                        class="absolute top-2 left-2 inline-flex items-center h-5 px-1.5 rounded text-[10px] font-medium bg-background/90 text-foreground">image</span>
                                @elseif($m->type === 'video')
                                    <i data-lucide="video" class="h-8 w-8 text-primary/60"></i>
                                    <span
                                        class="absolute top-2 left-2 inline-flex items-center h-5 px-1.5 rounded text-[10px] font-medium bg-background/90 text-foreground">video</span>
                                @elseif($m->type === 'document')
                                    <i data-lucide="file-text" class="h-8 w-8 text-primary/60"></i>
                                    <span
                                        class="absolute top-2 left-2 inline-flex items-center h-5 px-1.5 rounded text-[10px] font-medium bg-background/90 text-foreground">document</span>
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
            </div>

            {{-- Preview Panel --}}
            <div class="bg-card rounded-lg border border-border p-3 shadow-sm h-fit">
                @if($media->first())
                    @php $first = $media->first(); @endphp
                    <div id="preview-media-container"
                        class="aspect-square rounded-md bg-gradient-to-br from-primary/20 via-primary/5 to-accent grid place-items-center overflow-hidden mb-3">
                        @if($first->type === 'image')
                            <img src="{{ \App\Helpers\FileHelper::url($first->url) }}" class="w-full h-full object-cover rounded-md" alt="">
                        @elseif($first->type === 'video')
                            <video src="{{ \App\Helpers\FileHelper::url($first->url) }}" controls
                                class="w-full h-full object-cover rounded-md"></video>
                        @else
                            <i data-lucide="file-text" class="h-10 w-10 text-primary/50"></i>
                        @endif
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

                <!-- Select Event -->
                @php
                    $events = \App\Models\Event::orderByDesc('created_at')->get();
                @endphp
                <div class="space-y-2">
                    <label for="event_id" class="text-xs font-medium text-foreground">Gắn với sự kiện</label>
                    <select name="event_id" id="event_id" required
                        class="flex h-9 w-full items-center justify-between whitespace-nowrap rounded-md border border-input bg-transparent px-3 py-2 text-xs shadow-sm ring-offset-background cursor-pointer focus:outline-none focus:ring-1 focus:ring-ring">
                        <option value="">Chọn sự kiện...</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}">{{ $event->title }}</option>
                        @endforeach
                    </select>
                </div>

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

    <script>
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
                        previewContainer.innerHTML = `<video src="${url}" controls class="w-full h-full object-cover rounded-md"></video>`;
                    } else {
                        previewContainer.innerHTML = `<i data-lucide="file-text" class="h-10 w-10 text-primary/50"></i>`;
                    }

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
    </script>
@endsection