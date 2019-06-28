<?php

namespace App\Http\Controllers\HelpDesk\Meta;

use App\Http\Controllers\Controller;
use App\Models\Priority;
use Cache;
use Illuminate\Http\Request;

class PriorityController extends Controller
{
    public function index()
    {
        $prorities = Cache::tags('priority')->remember('priority.all', now()->addHour(1), function () {
            return Priority::all();
        });
        return view('admin.help-desk.priority.index', ['priorities' => $prorities]);
    }

    public function create()
    {
        return view('admin.help-desk.priority.create');
    }

    public function insert(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'nullable|string'
        ]);
        Priority::create($request->only(['name', 'description']));
        Cache::tags('priority')->clear();
        return redirect('/admin/help-desk/priority');
    }

    public function edit(Priority $priority)
    {
        return view('admin.help-desk.priority.edit', ['priority' => $priority]);
    }

    public function update(Request $request, Priority $priority)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'nullable|string'
        ]);
        tap($priority)->update($request->only(['name', 'description']));
        Cache::tags('priority')->clear();
        return redirect('/admin/help-desk/priority');
    }
}
