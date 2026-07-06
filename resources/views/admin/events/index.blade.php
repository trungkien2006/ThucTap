@extends('layouts.app')
@php
    $pageTitle = 'Events';
    $breadcrumbs = [['label' => 'Events']];
@endphp

@section('content')
<div class="space-y-4">
    {{-- Page Header --}}
    <div class="flex items-end justify-between flex-wrap gap-3">
        <div>
            <h1 class="text-[22px] font-semibold tracking-tight">Sự kiện</h1>
            <p class="text-xs text-muted-foreground mt-0.5">Quản lý tất cả sự kiện theo chuyên ngành và học kỳ</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.events.create') }}" class="inline-flex items-center gap-1.5 h-11 px-5 text-sm font-semibold bg-primary text-primary-foreground hover:bg-primary/90 rounded-xl transition-all shadow-sm">
                <i data-lucide="plus" class="h-5 w-5"></i> Sự kiện mới
            </a>
        </div>
    </div>

    {{-- Filters Card --}}
    @php
        // Build combined year+semester options from events
        $semestersMap = ['1' => 'fall', '2' => 'spring', '3' => 'summer'];
        $selectedYearSemesters = array_filter(is_array(request('year_semester')) ? request('year_semester') : [request('year_semester')]);
        $selectedCategories = array_filter(is_array(request('category_id')) ? request('category_id') : [request('category_id')]);
        $selectedDepartments = array_filter(is_array(request('department_id')) ? request('department_id') : [request('department_id')]);

        // Build combined year_semester options from distinct event combos
        $yearSemesterOptions = \App\Models\Event::select('academic_year', 'semester')
            ->whereNotNull('academic_year')
            ->whereNotNull('semester')
            ->distinct()
            ->orderBy('academic_year', 'desc')
            ->orderBy('semester')
            ->get()
            ->map(function ($e) use ($semestersMap) {
                $semLabel = $semestersMap[$e->semester] ?? 'HK' . $e->semester;
                return [
                    'value' => $e->semester . '_' . $e->academic_year,
                    'label' => $semLabel . ' ' . $e->academic_year,
                ];
            });
    @endphp
    <div class="bg-card rounded-lg border border-border p-4 shadow-none flex flex-col gap-4">
        <form method="GET" action="{{ route('admin.events.index') }}" id="filterForm" class="space-y-3 w-full">
            @foreach($selectedYearSemesters as $ys)
                <input type="hidden" name="year_semester[]" value="{{ $ys }}" class="filter-input-year_semester">
            @endforeach
            @foreach($selectedCategories as $c)
                <input type="hidden" name="category_id[]" value="{{ $c }}" class="filter-input-category_id">
            @endforeach
            @foreach($selectedDepartments as $d)
                <input type="hidden" name="department_id[]" value="{{ $d }}" class="filter-input-department_id">
            @endforeach

            <div class="flex flex-wrap items-center gap-2 w-full">
                <div class="relative flex-1 min-w-[220px]">
                    <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-muted-foreground"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm theo tên, ID, địa điểm…" class="h-9 w-full rounded-lg border border-input pl-10 text-sm bg-background focus:outline-none focus:border-ring transition-all">
                </div>

                <button type="submit" class="inline-flex items-center justify-center rounded-lg text-xs font-medium bg-primary text-primary-foreground h-9 px-3 hover:bg-primary/90 transition-all gap-1">
                    <i data-lucide="search" class="h-3.5 w-3.5"></i> Tìm
                </button>

                @if(request('search') || count($selectedYearSemesters) > 0 || count($selectedCategories) > 0 || count($selectedDepartments) > 0)
                    <a href="{{ route('admin.events.index') }}" class="inline-flex items-center justify-center rounded-lg text-xs font-medium border border-input bg-background h-9 px-3 hover:bg-accent transition-all gap-1">
                        <i data-lucide="x" class="h-3.5 w-3.5"></i> Xóa lọc
                    </a>
                @endif
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <select onchange="addFilterTag('year_semester', this)" class="h-9 min-w-[220px] border border-input rounded-lg text-xs bg-background px-2.5 focus:outline-none focus:border-ring transition-all text-muted-foreground cursor-pointer">
                    <option value="">+ Năm học & Học kỳ</option>
                    @foreach($yearSemesterOptions as $opt)
                        @if(!in_array($opt['value'], $selectedYearSemesters))
                            <option value="{{ $opt['value'] }}">{{ $opt['label'] }}</option>
                        @endif
                    @endforeach
                </select>

                <select onchange="addFilterTag('category_id', this)" class="h-9 min-w-[180px] border border-input rounded-lg text-xs bg-background px-2.5 focus:outline-none focus:border-ring transition-all text-muted-foreground cursor-pointer">
                    <option value="">+ Danh mục</option>
                    @foreach($categories as $cat)
                        @if(!in_array($cat->id, $selectedCategories))
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endif
                    @endforeach
                </select>

                <select onchange="addFilterTag('department_id', this)" class="h-9 min-w-[180px] border border-input rounded-lg text-xs bg-background px-2.5 focus:outline-none focus:border-ring transition-all text-muted-foreground cursor-pointer">
                    <option value="">+ Chuyên ngành</option>
                    @foreach($departments as $dept)
                        @if(!in_array($dept->id, $selectedDepartments))
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            {{-- Render Active Tags --}}
            @if(count($selectedYearSemesters) > 0 || count($selectedCategories) > 0 || count($selectedDepartments) > 0)
                <div class="flex flex-wrap items-center gap-1.5 pt-2 border-t border-border/50">
                    <span class="text-[11px] font-semibold text-muted-foreground mr-1">Bộ lọc đang chọn:</span>

                    @foreach($selectedYearSemesters as $ys)
                        @php
                            $parts = explode('_', $ys, 2);
                            $semVal = $parts[0] ?? '';
                            $yearVal = $parts[1] ?? '';
                            $semLabel = $semestersMap[$semVal] ?? 'HK'.$semVal;
                            $ysLabel = $semLabel . ' ' . $yearVal;
                        @endphp
                        <span class="inline-flex items-center gap-1 bg-primary/10 text-primary border border-primary/20 rounded-lg px-2.5 py-1 text-xs font-medium">
                            {{ $ysLabel }}
                            <button type="button" onclick="removeFilterTag('year_semester', '{{ $ys }}')" class="hover:text-destructive transition-colors ml-0.5">
                                <i data-lucide="x" class="h-3 w-3"></i>
                            </button>
                        </span>
                    @endforeach

                    @foreach($selectedCategories as $c)
                        @php $catModel = $categories->firstWhere('id', $c); @endphp
                        <span class="inline-flex items-center gap-1 bg-emerald-50 text-emerald-600 border border-emerald-200 rounded-lg px-2.5 py-1 text-xs font-medium">
                            Danh mục: {{ $catModel->name ?? $c }}
                            <button type="button" onclick="removeFilterTag('category_id', '{{ $c }}')" class="hover:text-destructive transition-colors ml-0.5">
                                <i data-lucide="x" class="h-3 w-3"></i>
                            </button>
                        </span>
                    @endforeach

                    @foreach($selectedDepartments as $d)
                        @php $deptModel = $departments->firstWhere('id', $d); @endphp
                        <span class="inline-flex items-center gap-1 bg-amber-50 text-amber-600 border border-amber-200 rounded-lg px-2.5 py-1 text-xs font-medium">
                            Chuyên ngành: {{ $deptModel->name ?? $d }}
                            <button type="button" onclick="removeFilterTag('department_id', '{{ $d }}')" class="hover:text-destructive transition-colors ml-0.5">
                                <i data-lucide="x" class="h-3 w-3"></i>
                            </button>
                        </span>
                    @endforeach
                </div>
            @endif
        </form>
    </div>

    {{-- Events Table --}}
    <div class="bg-card rounded-lg border border-border overflow-hidden shadow-none">
        <div class="flex items-center justify-between px-3 py-2 border-b border-border bg-muted/30">
            <span class="text-xs text-muted-foreground font-medium">Tổng số: {{ $events->total() }} sự kiện</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-xs">
                <thead class="bg-muted/40 text-[11px] uppercase tracking-wide text-muted-foreground sticky top-0">
                    <tr>
                        <th class="text-left px-4 py-2 font-medium w-12">STT</th>
                        <th class="text-left px-4 py-2 font-medium">Sự kiện</th>
                        <th class="text-left px-3 py-2 font-medium">Danh mục</th>
                        <th class="text-left px-3 py-2 font-medium">Chuyên ngành</th>
                        <th class="text-left px-3 py-2 font-medium">Học kỳ - Năm học</th>
                        <th class="text-left px-3 py-2 font-medium">Địa điểm</th>
                        <th class="text-left px-3 py-2 font-medium">Ngày diễn ra</th>
                        <th class="text-left px-3 py-2 font-medium">Trạng thái</th>
                        <th class="w-10 px-3 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $event)
                    @php
                        $semesterName = $event->semester == 1 ? 'fall' : ($event->semester == 2 ? 'spring' : 'summer');
                        $yearStr = $event->academic_year ?? '2024-2025';
                    @endphp
                    <tr class="border-t border-border hover:bg-muted/20">
                        <td class="px-4 py-2.5 font-medium text-muted-foreground w-12">
                            {{ ($events->currentPage() - 1) * $events->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-4 py-2.5">
                            <a href="{{ route('admin.events.show', $event) }}" class="font-medium truncate block hover:text-primary transition-colors">{{ $event->title }}</a>
                        </td>
                        <td class="px-3 py-2.5">
                            <span class="inline-flex items-center h-5 px-1.5 rounded text-[10px] font-medium border border-border bg-background">{{ $event->category?->name ?? '—' }}</span>
                        </td>
                        <td class="px-3 py-2.5 text-muted-foreground" title="{{ $event->departments->pluck('name')->implode(', ') }}">
                            {{ $event->departments->count() > 0 ? $event->departments->first()->name . ($event->departments->count() > 1 ? '...' : '') : '—' }}
                        </td>
                        <td class="px-3 py-2.5 whitespace-nowrap text-muted-foreground">
                            {{ $semesterName . ' ' . $yearStr }}
                        </td>
                        <td class="px-3 py-2.5 text-muted-foreground max-w-[180px] truncate" title="{{ $event->location ?? '—' }}">{{ $event->location ?? '—' }}</td>
                        <td class="px-3 py-2.5 tabular-nums whitespace-nowrap">{{ $event->event_date->format('Y-m-d') }}</td>
                        <td class="px-3 py-2.5">
                            @if($event->is_published)
                                <span class="inline-flex items-center h-5 px-1.5 rounded text-[10px] font-medium bg-emerald-100 text-emerald-700">Đã xuất bản</span>
                            @else
                                <span class="inline-flex items-center h-5 px-1.5 rounded text-[10px] font-medium bg-blue-100 text-blue-700">Sắp diễn ra</span>
                            @endif
                        </td>
                        <td class="px-3 py-2.5">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('admin.events.show', $event) }}" class="h-9 w-9 rounded-lg flex items-center justify-center text-muted-foreground hover:bg-accent hover:text-foreground transition-all" title="Xem">
                                    <i data-lucide="eye" class="h-4 w-4"></i>
                                </a>
                                <a href="{{ route('admin.events.edit', $event) }}" class="h-9 w-9 rounded-lg flex items-center justify-center text-muted-foreground hover:bg-accent hover:text-foreground transition-all" title="Sửa">
                                    <i data-lucide="pencil" class="h-4 w-4"></i>
                                </a>
                                <form action="{{ route('admin.events.archive', $event) }}" method="POST" class="inline" onsubmit="showConfirmModal(event, 'Lưu trữ sự kiện', 'Bạn có chắc chắn muốn lưu trữ sự kiện &quot;{{ $event->title }}&quot;? Sự kiện sẽ được chuyển vào kho lưu trữ.', 'warning');">
                                    @csrf
                                    <button type="submit" class="h-9 w-9 rounded-lg flex items-center justify-center text-muted-foreground hover:bg-accent hover:text-foreground transition-all" title="Lưu trữ">
                                        <i data-lucide="archive" class="h-4 w-4"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline" onsubmit="showConfirmModal(event, 'Xóa sự kiện', 'Bạn có chắc chắn muốn xóa sự kiện &quot;{{ $event->title }}&quot;? Hành động này không thể hoàn tác.', 'danger');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="h-9 w-9 rounded-lg flex items-center justify-center text-muted-foreground hover:bg-red-50 hover:text-red-500 transition-all" title="Xóa">
                                        <i data-lucide="trash-2" class="h-4 w-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-4 py-12 text-center">
                            <i data-lucide="calendar-x" class="h-10 w-10 text-muted-foreground/30 mx-auto mb-3"></i>
                            <p class="text-sm text-muted-foreground mb-4">Chưa có sự kiện nào.</p>
                            <a href="{{ route('admin.events.create') }}" class="inline-flex items-center gap-1.5 h-11 px-5 text-sm font-semibold bg-primary text-primary-foreground hover:bg-primary/90 rounded-xl transition-all">
                                <i data-lucide="plus" class="h-5 w-5"></i> Tạo sự kiện đầu tiên
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($events->hasPages())
        <div class="flex items-center justify-between px-4 py-3 border-t border-border text-xs text-muted-foreground">
            <span>Hiển thị {{ $events->firstItem() }}–{{ $events->lastItem() }} trên {{ $events->total() }}</span>
            <div class="flex items-center gap-1">
                {{ $events->links() }}
            </div>
        </div>
        @endif
    </div>

    {{-- Custom Confirmation Modal --}}
    <div id="confirmModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300 animate-in fade-in zoom-in-95">
        <div class="bg-card border border-border rounded-xl shadow-xl w-full max-w-md p-6 space-y-4 scale-95 transition-transform duration-300 transform" id="confirmModalContainer">
            <div class="flex items-start gap-4">
                <div class="h-10 w-10 rounded-full flex items-center justify-center shrink-0" id="confirmIconBg">
                    <i data-lucide="alert-triangle" class="h-5 w-5" id="confirmIcon"></i>
                </div>
                <div class="flex-1 space-y-1">
                    <h3 class="text-sm font-bold text-foreground animate-none" id="confirmTitle">Xác nhận</h3>
                    <p class="text-xs text-muted-foreground leading-relaxed" id="confirmMessage">Bạn có chắc chắn muốn thực hiện hành động này không?</p>
                </div>
            </div>
            <div class="flex justify-end gap-2.5 pt-4 border-t border-border">
                <button type="button" id="confirmCancelBtn" class="h-9 px-4 rounded-lg text-xs font-medium border border-input bg-background hover:bg-accent text-foreground transition-all">Hủy</button>
                <button type="button" id="confirmOkBtn" class="h-9 px-4 rounded-lg text-xs font-medium text-white transition-all shadow-sm">Xác nhận</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function addFilterTag(name, selectElement) {
        const val = selectElement.value;
        if (!val) return;

        const form = document.getElementById('filterForm');

        // Add new hidden input
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = `${name}[]`;
        input.value = val;
        input.className = `filter-input-${name}`;
        form.appendChild(input);

        // Submit form
        form.submit();
    }

    function removeFilterTag(name, value) {
        const inputs = document.querySelectorAll(`.filter-input-${name}`);
        inputs.forEach(input => {
            if (input.value == value) {
                input.remove();
            }
        });

        // Submit form
        document.getElementById('filterForm').submit();
    }

    let pendingForm = null;

    function showConfirmModal(event, title, message, type = 'warning') {
        event.preventDefault();
        pendingForm = event.target;
        
        const modal = document.getElementById('confirmModal');
        const container = document.getElementById('confirmModalContainer');
        const titleEl = document.getElementById('confirmTitle');
        const messageEl = document.getElementById('confirmMessage');
        const iconBg = document.getElementById('confirmIconBg');
        const icon = document.getElementById('confirmIcon');
        const okBtn = document.getElementById('confirmOkBtn');
        
        titleEl.textContent = title;
        messageEl.textContent = message;
        
        if (type === 'danger') {
            iconBg.className = 'h-10 w-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center shrink-0';
            icon.setAttribute('data-lucide', 'trash-2');
            okBtn.className = 'h-9 px-4 rounded-lg text-xs font-medium bg-red-600 hover:bg-red-700 text-white transition-all shadow-sm';
        } else {
            iconBg.className = 'h-10 w-10 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center shrink-0';
            icon.setAttribute('data-lucide', 'archive');
            okBtn.className = 'h-9 px-4 rounded-lg text-xs font-medium bg-amber-500 hover:bg-amber-600 text-white transition-all shadow-sm';
        }
        
        if (window.lucide) {
            window.lucide.createIcons();
        }
        
        modal.classList.remove('hidden');
        void modal.offsetWidth;
        modal.classList.remove('opacity-0');
        container.classList.remove('scale-95');
    }

    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('confirmModal');
        const container = document.getElementById('confirmModalContainer');
        const cancelBtn = document.getElementById('confirmCancelBtn');
        const okBtn = document.getElementById('confirmOkBtn');
        
        function hideModal() {
            modal.classList.add('opacity-0');
            container.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
                pendingForm = null;
            }, 300);
        }
        
        cancelBtn.addEventListener('click', hideModal);
        
        okBtn.addEventListener('click', function() {
            if (pendingForm) {
                pendingForm.submit();
            }
            hideModal();
        });
        
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                hideModal();
            }
        });
    });
</script>
@endpush
