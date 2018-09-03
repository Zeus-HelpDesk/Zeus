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

    public function create()
    {
        return view('admin.locations.create.district');
    }

    public function insert(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'nullable|string',
            'phone_extension' => 'nullable|string',
            'code' => 'nullable|min:4|max:4|string'
        ]);
        $district = District::create([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'phone_number' => $request->input('phone_number'),
            'phone_extension' => $request->input('phone_extension'),
            'code' => $request->input('code')
        ]);
        return redirect('/admin/locations/' . $district->id);
    }

    public function edit(District $district)
    {
        return view('admin.locations.edit.district', $district);
    }

    public function update(Request $request, District $district)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'nullable|string',
            'phone_extension' => 'nullable|string',
        ]);
        tap($district)->update($request->only(['name', 'address', 'phone_number', 'phone_extension']));
        return redirect('/admin/locations/' . $district->id);
    }
}
