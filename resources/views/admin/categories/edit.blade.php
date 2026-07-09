@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center justify-between border-b border-border pb-4">
        <div>
            <h1 class="text-xl font-bold text-foreground leading-tight">Chỉnh sửa Danh mục</h1>
            <p class="text-xs text-muted-foreground mt-1">Cập nhật thông tin danh mục sự kiện</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center justify-center rounded-md border border-input bg-background px-3 py-1.5 text-xs font-semibold hover:bg-accent hover:text-accent-foreground transition-all">Quay lại</a>
    </div>

    <div class="rounded-xl border-none bg-card text-card-foreground shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 transition-all duration-300 p-6">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="space-y-2">
                <label for="name" class="text-xs font-semibold text-foreground">Tên danh mục</label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring" />
                @error('name')
                    <span class="text-destructive text-[11px] font-medium">{{ $message }}</span>
                @enderror
            </div>

            <!-- Action buttons -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-border">
                <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center justify-center rounded-md text-xs font-medium border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 px-4 transition-all">Hủy</a>
                <button type="submit" class="inline-flex items-center justify-center rounded-md text-xs font-medium bg-primary text-primary-foreground shadow hover:bg-primary/90 h-9 px-4 transition-all hover:scale-[1.02] active:scale-[0.98]">Lưu thay đổi</button>
            </div>
        </form>
    </div>
</div>
@endsection
