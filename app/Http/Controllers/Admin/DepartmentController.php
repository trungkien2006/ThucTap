<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\ActivityLogger;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Category::departments()->paginate(10);
        $departments->getCollection()->transform(function ($dept) {
            $dept->events_count = \App\Models\Event::whereHas('departments', function ($q) use ($dept) {
                $q->where('categories.id', $dept->id);
            })->count();
            $dept->total_views = \App\Models\Event::whereHas('departments', function ($q) use ($dept) {
                $q->where('categories.id', $dept->id);
            })->sum('views_count');
            return $dept;
        });

        return view('admin.departments.index', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $dept = Category::create([
            'name' => $request->name,
            'type' => 'department',
            'slug' => Str::slug($request->name),
        ]);

        ActivityLogger::log("đã tạo chuyên ngành mới: {$dept->name}", route('admin.departments.index'));

        return redirect()->route('admin.departments.index')->with('success', 'Thêm chuyên ngành mới thành công.');
    }

    public function edit(Category $department)
    {
        if ($department->type !== 'department') {
            abort(404);
        }
        return view('admin.departments.edit', compact('department'));
    }

    public function update(Request $request, Category $department)
    {
        if ($department->type !== 'department') {
            abort(404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $department->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        ActivityLogger::log("đã cập nhật chuyên ngành: {$department->name}", route('admin.departments.index'));

        return redirect()->route('admin.departments.index')->with('success', 'Cập nhật chuyên ngành thành công.');
    }

    public function destroy(Category $department)
    {
        return redirect()->route('admin.departments.index')->with('error', 'Không được phép xóa chuyên ngành.');
    }
}
