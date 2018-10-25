<?php

namespace App\Http\Controllers\HelpDesk\Meta;

use App\Http\Controllers\Controller;
use App\Priority;
use Illuminate\Http\Request;

class PriorityController extends Controller
{
    public function index()
    {
        return view('', ['priorities' => Priority::all()]);
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

    public function update(Request $request, Priority $priority)
    {

    }
}