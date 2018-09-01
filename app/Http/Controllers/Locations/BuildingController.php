<?php

namespace App\Http\Controllers\Locations;

use App\Http\Controllers\Controller;

class BuildingController extends Controller
{
    public function index()
    {
        return view('admin.locations.building');
    }

    public function create()
    {
        return view('admin.locations.create.building');
    }

    public function insert()
    {

    }

    public function edit()
    {
        return view('admin.locations.edit.building');
    }

    public function update()
    {

    }
}
