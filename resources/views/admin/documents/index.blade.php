@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-4">
    <div>
        <h1 class="text-xl font-bold text-foreground font-heading leading-tight">Tài liệu</h1>
        <p class="text-xs text-muted-foreground mt-1">Biểu mẫu, thỏa thuận, chương trình và các tài liệu bổ trợ</p>
    </div>
    <button onclick="document.getElementById('uploadDocModal').classList.remove('hidden')" class="inline-flex items-center justify-center rounded-md text-xs font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring bg-primary text-primary-foreground shadow hover:bg-primary/90 h-8 px-3 gap-1.5 w-fit hover:scale-[1.02] active:scale-[0.98] transition-all">
        <i data-lucide="upload" class="h-3.5 w-3.5"></i>
        Tải lên
    </button>
</div>

<!-- Search & Filters -->
<div class="bg-card rounded-2xl border-none shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 transition-all duration-300 p-3 flex flex-wrap items-center gap-2 mb-4">
    <form method="GET" action="{{ route('admin.documents.index') }}" class="relative flex-1 min-w-[220px] flex items-center gap-2">
        <div class="relative flex-1">
            <i data-lucide="search" class="absolute left-2.5 top-1/2 -translate-y-1/2 h-3.5 w-3.5 text-muted-foreground"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm tài liệu..." class="flex h-8 w-full rounded-md border border-input bg-transparent pl-8 pr-3 text-xs shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"/>
        </div>
        <button type="submit" class="inline-flex items-center justify-center rounded-md text-xs font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring bg-primary text-primary-foreground shadow hover:bg-primary/90 h-8 px-3 hover:scale-[1.02] active:scale-[0.98] transition-all">Tìm kiếm</button>
        @if(request('search'))
            <a href="{{ route('admin.documents.index') }}" class="inline-flex items-center justify-center rounded-md text-xs font-medium transition-colors border border-input bg-background hover:bg-accent hover:text-accent-foreground h-8 px-3 hover:scale-[1.02] active:scale-[0.98] transition-all">Xóa lọc</a>
        @endif
    </form>
</div>

<!-- Documents List -->
@if($documents->count() > 0)
<div class="bg-card rounded-2xl border-none shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 transition-all duration-300 overflow-hidden mb-6">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-white/40 backdrop-blur-md text-[11px] uppercase tracking-wide text-muted-foreground border-b border-border">
                <tr>
                    <th class="text-left px-4 py-2 font-medium">Tên tài liệu</th>
                    <th class="text-left px-3 py-2 font-medium">Sự kiện</th>
                    <th class="text-left px-3 py-2 font-medium">Kích thước</th>
                    <th class="text-left px-3 py-2 font-medium">Ngày tải</th>
                    <th class="w-20"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @foreach($documents as $doc)
                @php
                    $ext = strtolower($doc->file_type ?? pathinfo($doc->url, PATHINFO_EXTENSION));
                    $colors = [
                        'pdf' => 'text-red-600 bg-red-50 dark:bg-red-950/20 dark:text-red-400',
                        'doc' => 'text-blue-600 bg-blue-50 dark:bg-blue-950/20 dark:text-blue-400',
                        'docx' => 'text-blue-600 bg-blue-50 dark:bg-blue-950/20 dark:text-blue-400',
                        'xls' => 'text-emerald-600 bg-emerald-50 dark:bg-emerald-950/20 dark:text-emerald-400',
                        'xlsx' => 'text-emerald-600 bg-emerald-50 dark:bg-emerald-950/20 dark:text-emerald-400',
                        'zip' => 'text-amber-600 bg-amber-50 dark:bg-amber-950/20 dark:text-amber-400',
                        'rar' => 'text-amber-600 bg-amber-50 dark:bg-amber-950/20 dark:text-amber-400',
                        'ppt' => 'text-orange-600 bg-orange-50 dark:bg-orange-950/20 dark:text-orange-400',
                        'pptx' => 'text-orange-600 bg-orange-50 dark:bg-orange-950/20 dark:text-orange-400',
                    ];
                    $colorClass = $colors[$ext] ?? 'text-slate-600 bg-slate-50 dark:bg-slate-950/20 dark:text-slate-400';
                    
                    $fileSize = '—';
                    if ($doc->file_size) {
                        if ($doc->file_size >= 1048576) {
                            $fileSize = number_format($doc->file_size / 1048576, 1) . ' MB';
                        } else {
                            $fileSize = number_format($doc->file_size / 1024, 1) . ' KB';
                        }
                    }
                @endphp
                <tr class="hover:bg-muted/20 transition-colors duration-150">
                    <td class="px-4 py-2.5">
                        <div class="flex items-center gap-2">
                            <div class="h-8 w-8 rounded grid place-items-center {{ $colorClass }} shrink-0">
                                <i data-lucide="file-text" class="h-3.5 w-3.5"></i>
                            </div>
                            <div class="min-w-0">
                                <a href="{{ \App\Helpers\FileHelper::url($doc->url) }}" target="_blank" class="text-xs font-semibold text-foreground hover:underline block truncate max-w-[240px] sm:max-w-[360px] md:max-w-md">{{ $doc->title ?? basename($doc->url) }}</a>
                                <span class="inline-flex items-center rounded-md border border-border px-1.5 py-0.5 text-[9px] font-mono font-medium text-muted-foreground mt-0.5 uppercase">{{ $ext }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-3 py-2.5 text-xs text-muted-foreground">{{ $doc->event?->title ?? 'Tất cả Sự kiện' }}</td>
                    <td class="px-3 py-2.5 text-xs tabular-nums text-muted-foreground">{{ $fileSize }}</td>
                    <td class="px-3 py-2.5 text-xs tabular-nums text-muted-foreground">{{ $doc->created_at?->format('Y-m-d') ?? '—' }}</td>
                    <td class="px-2 py-2.5 relative">
                        <div class="flex items-center justify-end document-dropdown">
                            <button type="button" class="dropdown-trigger inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors hover:bg-accent hover:text-accent-foreground h-7 w-7 text-muted-foreground" onclick="toggleDropdown(this, event)">
                                <i data-lucide="more-horizontal" class="h-4 w-4"></i>
                            </button>
                            <div class="dropdown-menu hidden absolute right-2 mt-1 w-32 origin-top-right rounded-md border border-border bg-popover text-popover-foreground shadow-md focus:outline-none z-50 p-1">
                                <a href="{{ route('admin.documents.edit', $doc) }}" class="flex items-center gap-1.5 w-full text-left px-2 py-1.5 rounded text-xs hover:bg-accent hover:text-accent-foreground transition-colors font-medium">
                                    <i data-lucide="pencil" class="h-3.5 w-3.5 text-muted-foreground"></i>
                                    Sửa
                                </a>
                                <a href="{{ \App\Helpers\FileHelper::url($doc->url) }}" download class="flex items-center gap-1.5 w-full text-left px-2 py-1.5 rounded text-xs hover:bg-accent hover:text-accent-foreground transition-colors font-medium">
                                    <i data-lucide="download" class="h-3.5 w-3.5 text-muted-foreground"></i>
                                    Tải xuống
                                </a>
                                <form action="{{ route('admin.documents.destroy', $doc) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài liệu này?');" class="block w-full">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex items-center gap-1.5 w-full text-left px-2 py-1.5 rounded text-xs text-red-600 hover:bg-red-50 dark:hover:bg-red-950/20 transition-colors font-medium w-full">
                                        <i data-lucide="trash-2" class="h-3.5 w-3.5 text-red-500"></i>
                                        Xóa
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@if($documents->hasPages())
<div class="flex justify-center mt-4">
    {{ $documents->links() }}
</div>
@endif

@else
<div class="bg-card rounded-2xl border-none shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 transition-all duration-300 p-16 text-center">
    <div class="h-12 w-12 rounded-full bg-accent flex items-center justify-center mx-auto mb-4">
        <i data-lucide="folder-open" class="h-6 w-6 text-muted-foreground/60"></i>
    </div>
    <p class="text-sm font-semibold text-foreground mb-1">Chưa có tài liệu nào</p>
    <p class="text-xs text-muted-foreground mb-4">Các tài liệu đính kèm cho sự kiện sẽ được hiển thị ở đây.</p>
    <button onclick="document.getElementById('uploadDocModal').classList.remove('hidden')" class="inline-flex items-center justify-center rounded-md text-xs font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring bg-primary text-primary-foreground shadow hover:bg-primary/90 h-8 px-4 gap-1.5 hover:scale-[1.02] active:scale-[0.98] transition-all">
        <i data-lucide="upload" class="h-3.5 w-3.5"></i>
        Tải lên tài liệu đầu tiên
    </button>
</div>
@endif

<!-- Upload Modal -->
<div id="uploadDocModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-background border border-border rounded-xl shadow-lg w-full max-w-lg mx-4 p-6 relative">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-sm font-bold text-foreground leading-none">Tải lên tài liệu</h3>
            <button onclick="document.getElementById('uploadDocModal').classList.add('hidden')" class="w-8 h-8 rounded-lg flex items-center justify-center hover:bg-accent text-muted-foreground hover:text-foreground transition-colors">
                <i data-lucide="x" class="h-4 w-4"></i>
            </button>
        </div>

        <form action="{{ route('admin.documents.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            
            <!-- File upload dropzone area -->
            <div class="border-2 border-dashed border-border rounded-xl p-8 text-center bg-muted/20 hover:bg-muted/40 hover:border-muted transition-all cursor-pointer relative group">
                <input type="file" name="files[]" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.zip" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="updateFileLabel(this)"/>
                <div class="flex flex-col items-center justify-center">
                    <div class="h-10 w-10 rounded-full bg-accent flex items-center justify-center mb-3 group-hover:scale-105 transition-transform">
                        <i data-lucide="upload" class="h-5 w-5 text-muted-foreground"></i>
                    </div>
                    <p id="uploadLabelText" class="text-xs font-semibold text-foreground">Nhấn để chọn hoặc kéo thả tệp tại đây</p>
                    <p class="text-[10px] text-muted-foreground mt-1">Hỗ trợ: PDF, DOC, DOCX, XLS, PPT, ZIP (tối đa 10MB/tệp)</p>
                </div>
            </div>

            <!-- Select Event -->
            @php
                $events = \App\Models\Event::orderByDesc('created_at')->get();
            @endphp
            <div class="space-y-2">
                <label for="event_id" class="text-xs font-medium text-foreground">Gắn với sự kiện (Tùy chọn)</label>
                <select name="event_id" id="event_id" class="flex h-9 w-full items-center justify-between whitespace-nowrap rounded-md border border-input bg-transparent px-3 py-2 text-xs shadow-sm ring-offset-background cursor-pointer focus:outline-none focus:ring-1 focus:ring-ring">
                    <option value="">Chọn sự kiện...</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <button type="button" onclick="document.getElementById('uploadDocModal').classList.add('hidden')" class="inline-flex items-center justify-center rounded-md text-xs font-medium transition-colors border border-input bg-background hover:bg-accent hover:text-accent-foreground h-8 px-4 hover:scale-[1.02] active:scale-[0.98] transition-all">Hủy</button>
                <button type="submit" class="inline-flex items-center justify-center rounded-md text-xs font-medium transition-colors bg-primary text-primary-foreground shadow hover:bg-primary/90 h-8 px-4 gap-1.5 hover:scale-[1.02] active:scale-[0.98] transition-all">
                    <i data-lucide="upload" class="h-3.5 w-3.5"></i>
                    Tải lên
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Close modal when clicking on backdrop
    document.getElementById('uploadDocModal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });

    // Update file label text on selection
    function updateFileLabel(input) {
        const textEl = document.getElementById('uploadLabelText');
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

    // Toggle dropdown
    function toggleDropdown(button, e) {
        e.stopPropagation();
        // Close all other dropdowns
        document.querySelectorAll('.document-dropdown .dropdown-menu').forEach(menu => {
            if (menu !== button.nextElementSibling) {
                menu.classList.add('hidden');
            }
        });
        // Toggle this dropdown
        button.nextElementSibling.classList.toggle('hidden');
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.document-dropdown')) {
            document.querySelectorAll('.document-dropdown .dropdown-menu').forEach(menu => {
                menu.classList.add('hidden');
            });
        }
    });
</script>
@endpush
@endsection
