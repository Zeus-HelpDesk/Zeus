<?php

namespace App\Http\Controllers\HelpDesk\Meta;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.help-desk.category.index', ['categories' => Category::all()]);
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
        return redirect('/admin/help-desk/category');
    }
}