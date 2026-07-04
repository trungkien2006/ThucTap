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
        $departments = Category::departments()
            ->withCount('departmentEvents as events_count')
            ->withSum('departmentEvents as total_views', 'views_count')
            ->get()
            ->map(function ($dept) {
                // Ensure total_views is at least 0 instead of null
                $dept->total_views = $dept->total_views ?? 0;
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

        ActivityLogger::log("đã tạo khoa/bộ phận mới: {$dept->name}", route('admin.departments.index'));

        return redirect()->route('admin.departments.index')->with('success', 'Thêm khoa/bộ phận mới thành công.');
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

        ActivityLogger::log("đã cập nhật khoa/bộ phận: {$department->name}", route('admin.departments.index'));

        return redirect()->route('admin.departments.index')->with('success', 'Cập nhật khoa/bộ phận thành công.');
    }

    public function destroy(Category $department)
    {
        return redirect()->route('admin.departments.index')->with('error', 'Không được phép xóa khoa/bộ phận.');
    }
}
