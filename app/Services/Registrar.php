<?php namespace App\Services;

use app\Models\User;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
use Validator;

class Registrar implements RegistrarContract
{

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'first_name' => 'required|alpha|between:2,15',
                'last_name' => 'required|alpha|between:2,15',
                'phone' => 'required|digits:9|unique:users',
                'county_id' => 'required|numeric',
                'home_address' => 'required|between:3,50',
                'town' => 'required|between:3,15',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|confirmed|min:6',
                'accept' => 'required'
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return User
     */
    public function create(array $data)
    {
        return User::create(
            [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone' => $data['phone'],
                'county_id' => $data['county_id'],
                'town' => $data['town'],
                'home_address' => $data['home_address'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]
        );
    }

}
