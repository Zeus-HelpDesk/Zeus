<?php

namespace App\Http\Controllers\Auth;

use App\Building;
use App\District;
use App\Http\Controllers\Controller;
use App\User;
use Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'invite_code' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'room' => 'required|string',
            'phone_number' => 'nullable|string',
            'extension' => 'nullable|integer'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        $split = explode('-', $data['invite_code']);
        $district = District::whereCode($split[0])->firstOrFail(['id']);
        $building = Building::whereDistrictId($district->id)->whereCode($split[1])->firstOrFail(['id']);
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'district_id' => $district->id,
            'building_id' => $building->id,
            'room' => $data['room'],
            'phone_number' => $data['phone_number'],
            'extension' => $data['phone_extension']
        ]);
    }
}
