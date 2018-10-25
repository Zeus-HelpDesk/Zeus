<?php

namespace App\Http\Controllers\HelpDesk\Meta;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('', ['categories' => Category::all()]);
    }

    public function create()
    {
        return view();
    }

    public function insert(Request $request)
    {

    }

    public function edit()
    {
        return view();
    }

    public function update(Request $request, Category $category)
    {

    }
}