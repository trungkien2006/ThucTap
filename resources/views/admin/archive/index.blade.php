@extends('layouts.app')
@php
    $pageTitle = 'Event Archive';
    $breadcrumbs = [['label' => 'Event Archive']];
@endphp

@section('content')
<div class="space-y-4">
    <div class="flex items-end justify-between flex-wrap gap-3">
        <div>
            <h1 class="text-[22px] font-semibold tracking-tight">Lưu trữ sự kiện</h1>
            <p class="text-xs text-muted-foreground mt-0.5">Kho lưu trữ hình ảnh, video của các sự kiện trường</p>
        </div>
    </div>

    {{-- Search & Filters --}}
    @php
        $semestersMap = ['1' => 'Học kỳ Thu', '2' => 'Học kỳ Xuân', '3' => 'Học kỳ Hè'];
        $selectedSemesters = array_filter(is_array(request('semester')) ? request('semester') : [request('semester')]);
        $selectedCategories = array_filter(is_array(request('category_id')) ? request('category_id') : [request('category_id')]);
        $selectedDepartments = array_filter(is_array(request('department_id')) ? request('department_id') : [request('department_id')]);

        $semesterOptions = collect([
            ['value' => '1', 'label' => 'Học kỳ Thu'],
            ['value' => '2', 'label' => 'Học kỳ Xuân'],
            ['value' => '3', 'label' => 'Học kỳ Hè'],
        ]);
    @endphp
    <div class="bg-card rounded-lg border border-border p-4 shadow-none flex flex-col gap-4">
        <form method="GET" action="{{ route('admin.archive.index') }}" id="filterForm" class="space-y-3 w-full">
            @foreach($selectedSemesters as $sem)
                <input type="hidden" name="semester[]" value="{{ $sem }}" class="filter-input-semester">
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
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm sự kiện đã lưu trữ…" class="h-9 w-full rounded-lg border border-input pl-10 text-sm bg-background focus:outline-none focus:border-ring transition-all">
                </div>

                <button type="submit" class="inline-flex items-center justify-center rounded-lg text-xs font-medium bg-primary text-primary-foreground h-9 px-3 hover:bg-primary/90 transition-all gap-1">
                    <i data-lucide="search" class="h-3.5 w-3.5"></i> Tìm
                </button>

                @if(request('search') || count($selectedSemesters) > 0 || count($selectedCategories) > 0 || count($selectedDepartments) > 0)
                    <a href="{{ route('admin.archive.index') }}" class="inline-flex items-center justify-center rounded-lg text-xs font-medium border border-input bg-background h-9 px-3 hover:bg-accent transition-all gap-1">
                        <i data-lucide="x" class="h-3.5 w-3.5"></i> Xóa lọc
                    </a>
                @endif
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <select onchange="addFilterTag('semester', this)" class="h-9 min-w-[180px] border border-input rounded-lg text-xs bg-background px-2.5 focus:outline-none focus:border-ring transition-all text-muted-foreground cursor-pointer">
                    <option value="">+ Học kỳ</option>
                    @foreach($semesterOptions as $opt)
                        @if(!in_array($opt['value'], $selectedSemesters))
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
                    <option value="">+ Khoa</option>
                    @foreach($departments as $dept)
                        @if(!in_array($dept->id, $selectedDepartments))
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            {{-- Render Active Tags --}}
            @if(count($selectedSemesters) > 0 || count($selectedCategories) > 0 || count($selectedDepartments) > 0)
                <div class="flex flex-wrap items-center gap-1.5 pt-2 border-t border-border/50">
                    <span class="text-[11px] font-semibold text-muted-foreground mr-1">Bộ lọc đang chọn:</span>

                    @foreach($selectedSemesters as $sem)
                        @php
                            $ysLabel = $semestersMap[$sem] ?? 'HK'.$sem;
                        @endphp
                        <span class="inline-flex items-center gap-1 bg-primary/10 text-primary border border-primary/20 rounded-lg px-2.5 py-1 text-xs font-medium">
                            {{ $ysLabel }}
                            <button type="button" onclick="removeFilterTag('semester', '{{ $sem }}')" class="hover:text-destructive transition-colors ml-0.5">
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
                            Khoa: {{ $deptModel->name ?? $d }}
                            <button type="button" onclick="removeFilterTag('department_id', '{{ $d }}')" class="hover:text-destructive transition-colors ml-0.5">
                                <i data-lucide="x" class="h-3 w-3"></i>
                            </button>
                        </span>
                    @endforeach
                </div>
            @endif
        </form>
    </div>

    {{-- Archived events --}}
    @php
    $grouped = $events->groupBy(function($e) {
        return $e->event_date->format('Y');
    });
    @endphp

    @if($events->isEmpty())
    <div class="py-16 text-center bg-card rounded-lg border border-border shadow-sm">
        <i data-lucide="archive" class="h-10 w-10 text-muted-foreground/30 mx-auto mb-3"></i>
        <p class="text-sm text-muted-foreground">Không có sự kiện nào trong lưu trữ.</p>
    </div>
    @else
    <div class="space-y-6">
        @foreach($grouped as $year => $yearEvents)
        <section class="space-y-3">
            <div class="flex items-center gap-3">
                <div class="h-7 w-1 rounded-full bg-primary"></div>
                <h2 class="text-sm font-semibold">{{ $year }}</h2>
                <span class="inline-flex items-center h-5 px-1.5 rounded text-[10px] font-medium bg-secondary text-secondary-foreground">{{ $yearEvents->count() }} sự kiện</span>
                <div class="flex-1 h-px bg-border"></div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
                @foreach($yearEvents as $e)
                <div class="bg-card rounded-lg border border-border overflow-hidden shadow-sm hover:shadow-md transition-all">
                    <div class="aspect-[16/9] bg-gradient-to-br from-primary/25 via-primary/10 to-accent grid place-items-center relative overflow-hidden">
                        @if($e->bannerImage)
                            <img src="{{ \App\Helpers\FileHelper::url($e->bannerImage->url) }}" class="w-full h-full object-cover" alt="">
                        @else
                            <i data-lucide="image" class="h-8 w-8 text-primary/50"></i>
                        @endif
                        <span class="absolute top-2 left-2 inline-flex items-center h-5 px-1.5 rounded text-[10px] font-medium bg-background/90 text-foreground">
                            {{ $e->category?->name ?? 'General' }}
                        </span>
                    </div>
                    <div class="p-3 space-y-2">
                        <div class="font-medium text-sm leading-snug line-clamp-2">{{ $e->title }}</div>
                        <div class="flex items-center gap-1.5 text-[11px] text-muted-foreground">
                            <i data-lucide="calendar" class="h-3 w-3"></i>
                            {{ $e->event_date->format('d/m/Y') }}
                        </div>
                        <div class="flex items-center justify-between text-[11px] text-muted-foreground pt-2 border-t border-border">
                            <span class="inline-flex items-center gap-1"><i data-lucide="eye" class="h-3 w-3"></i>{{ number_format($e->views_count ?? 0) }}</span>
                            <div class="flex items-center gap-1">
                                <a href="{{ route('admin.events.edit', $e) }}" class="h-6 w-6 rounded flex items-center justify-center hover:bg-accent text-muted-foreground hover:text-foreground transition-all" title="Sửa">
                                    <i data-lucide="pencil" class="h-3 w-3"></i>
                                </a>
                                <form action="{{ route('admin.events.destroy', $e) }}" method="POST" class="inline" onsubmit="return confirm('Xóa sự kiện này?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="h-6 w-6 rounded flex items-center justify-center hover:bg-red-50 hover:text-red-500 text-muted-foreground transition-all" title="Xóa">
                                        <i data-lucide="trash-2" class="h-3 w-3"></i>
                                    </button>
                                </form>
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
</script>
@endpush
