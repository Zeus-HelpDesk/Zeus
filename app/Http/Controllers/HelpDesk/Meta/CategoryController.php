<?php

namespace App\Http\Controllers\HelpDesk\Meta;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Cache;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Cache::tags('category')->remember('category.all', now()->addHour(1), function () {
            return Category::all();
        });
        return view('admin.help-desk.category.index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('admin.help-desk.category.create');
    }

    public function insert(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'icon' => 'nullable|string'
        ]);
        Category::create($request->only(['name', 'description', 'icon']));
        Cache::tags('category')->clear();
        return redirect('/admin/help-desk/category');
    }

    public function edit(Category $category)
    {
        return view('admin.help-desk.category.edit', ['category' => $category]);
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'icon' => 'nullable|string'
        ]);
        tap($category)->update($request->only(['name', 'description', 'icon']));
        Cache::tags('category')->clear();
        return redirect('/admin/help-desk/category');
    }
}
