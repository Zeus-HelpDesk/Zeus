<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\District;
use Hash;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(Request $request)
    {
        return view('settings', ['user' => $request->user()]);
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'room' => 'required|string',
            'phone_number' => 'nullable|string',
            'phone_extension' => 'nullable|string'
        ]);
        // If the user changes their email we unverify their account until they verify the new email address.
        $email_verified = $request->user()->email !== $request->input('email') ? null : $request->user()->email_verified_at;
        tap($request->user())->update(array_merge($request->input(), ['email_verified_at' => $email_verified]));
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|confirm|min:8'
        ]);
        if (Hash::check($request->input('old_password'), $request->user()->password)) {
            tap($request->user())->update(['password' => Hash::make($request->input('new_password'))]);
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors(['old_password' => 'Old password incorrect']);
        }
    }

    public function updateLocation(Request $request)
    {
        $split = explode('-', $request->input('invite_code'));
        $district = District::whereCode($split[0])->firstOrFail(['id']);
        $building = Building::whereDistrictId($district->id)->whereCode($split[1])->firstOrFail(['id']);
        tap($request->user())->update(['district_id' => $district->id, 'building_id' => $building->id]);
        return redirect()->back();
    }
}
