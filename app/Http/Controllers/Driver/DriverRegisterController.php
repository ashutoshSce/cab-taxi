<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DriverRegisterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        return $this->registered($request, $user);
    }

    /**
     * The user has been registered.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        return $user;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:2', 'max:125'],
            'mobile' => ['required', 'string', 'min:10', 'max:15', 'unique:drivers'],
            'cab_number' => ['required', 'string', 'min:5', 'max:10', 'unique:drivers'],
            'license' => ['required', 'string', 'min:4', 'max:10', 'unique:drivers'],
            'pan' => ['required', 'string', 'min:4', 'max:10', 'unique:drivers'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\Driver
     */
    protected function create(array $data)
    {
        return Driver::create([
            'name' => $data['name'],
            'mobile' => $data['mobile'],
            'cab_number' => $data['cab_number'],
            'license' => $data['license'],
            'pan' => $data['pan'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
