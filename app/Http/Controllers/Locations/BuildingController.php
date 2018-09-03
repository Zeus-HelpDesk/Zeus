<?php

namespace App\Http\Controllers\Locations;

use App\Building;
use App\District;
use App\Http\Controllers\Controller;

class BuildingController extends Controller
{
    public function index(District $district, Building $building)
    {
        return view('admin.locations.building', ['building' => $building]);
    }

    public function create(District $district)
    {
        return view('admin.locations.create.building', ['district' => $district]);
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
