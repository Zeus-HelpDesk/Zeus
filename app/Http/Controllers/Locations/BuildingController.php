<?php

namespace App\Http\Controllers\Locations;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\District;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    public function index(District $district, Building $building)
    {
        return view('admin.locations.building', ['district' => $district, 'building' => $building]);
    }

    public function create(District $district)
    {
        return view('admin.locations.create.building', ['district' => $district]);
    }

    public function insert(Request $request, District $district)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'nullable|string',
            'phone_extension' => 'nullable|string',
            'code' => 'nullable|string|max:4|min:4|unique:buildings,code'
        ]);
        Building::create([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'phone_number' => $request->input('phone_number'),
            'phone_extension' => $request->input('phone_extension'),
            'code' => $request->input('code'),
            'district_id' => $district->id
        ]);
        return redirect("/admin/locations/$district->id");
    }

    public function edit(District $district, Building $building)
    {
        return view('admin.locations.edit.building', ['district' => $district, 'building' => $building]);
    }

    public function update(Request $request, District $district, Building $building)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'nullable|string',
            'phone_extension' => 'nullable|string'
        ]);
        tap($building)->update($request->only(['name', 'address', 'phone_number', 'phone_extension']));
        return redirect("/admin/locations/$district->id");
    }
}
