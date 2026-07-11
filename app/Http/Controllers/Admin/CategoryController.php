<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\ActivityLogger;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::eventTypes()->paginate(10);
        $categories->getCollection()->transform(function ($category) {
            $category->events_count = \App\Models\Event::where('category_id', $category->id)->count();
            $category->total_views = \App\Models\Event::where('category_id', $category->id)->sum('views_count');
            return $category;
        });

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'type' => 'event_type',
            'slug' => Str::slug($request->name),
        ]);

        ActivityLogger::log("đã tạo danh mục mới: {$category->name}", route('admin.categories.index'));

        return redirect()->route('admin.categories.index')->with('success', 'Tạo danh mục mới thành công.');
    }

    public function edit(Category $category)
    {
        if ($category->type !== 'event_type') {
            abort(404);
        }
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        if ($category->type !== 'event_type') {
            abort(404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        ActivityLogger::log("đã cập nhật danh mục: {$category->name}", route('admin.categories.index'));

        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật danh mục thành công.');
    }

    public function destroy(Category $category)
    {
        if ($category->type !== 'event_type') {
            abort(404);
        }

        $eventCount = \App\Models\Event::where('category_id', $category->id)->count();
        if ($eventCount > 0) {
            return redirect()->route('admin.categories.index')->with('error', 'Không thể xóa danh mục đang có sự kiện.');
        }

        $categoryName = $category->name;
        $category->delete();

        ActivityLogger::log("đã xóa danh mục: {$categoryName}", route('admin.categories.index'));

        return redirect()->route('admin.categories.index')->with('success', 'Xóa danh mục thành công.');
    }
}
