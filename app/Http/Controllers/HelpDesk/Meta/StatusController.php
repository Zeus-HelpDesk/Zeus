<?php

namespace App\Http\Controllers\HelpDesk\Meta;

use App\Http\Controllers\Controller;
use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        return view('admin.help-desk.status.index', ['statuses' => Status::all()]);
    }

    public function create()
    {
        return view('admin.help-desk.status.create');
    }

    public function insert(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'closes_ticket' => 'nullable'
        ]);
        Status::create($request->only(['name', 'description', 'closes_ticket']));
        return redirect('/admin/help-desk/status');
    }

    public function edit(Status $status)
    {
        return view('admin.help-desk.status.edit', ['status' => $status]);
    }

    public function update(Request $request, Status $status)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'closes_ticket' => 'nullable'
        ]);
        tap($status)->update($request->only(['name', 'description', 'closes_ticket']));
        return redirect('/admin/help-desk/category');
    }
}
