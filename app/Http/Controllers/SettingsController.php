<?php

namespace App\Http\Controllers;

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
        return redirect()->back();
    }

    public function updateLocation(Request $request)
    {
        return redirect()->back();
    }
}
