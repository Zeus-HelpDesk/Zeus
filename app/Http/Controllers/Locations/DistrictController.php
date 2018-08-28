<?php

namespace App\Http\Controllers\Locations;

use App\District;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index()
    {
        return view('admin.locations.index', ['districts' => District::all()]);
    }

    public function single(District $district)
    {
        return view('admin.locations.district', ['district' => $district]);
    }

    public function edit(District $district)
    {
        return view('admin.locations.edit.district', $district);
    }

    public function update(Request $request, District $district)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'phone_extension' => 'required'
        ]);
        tap($district)->update($request->only(['name', 'address', 'phone_number', 'phone_extension']));
        return redirect('/admin/locations/' . $district->id);
    }
}
