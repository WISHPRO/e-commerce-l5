<?php namespace App\Services;

use app\Models\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'first_name' => 'required|alpha|between:2,15',
			'last_name' => 'required|alpha|between:2,15',
			'employee_id' => 'digits:4|unique:users',
			'phone' => 'required|digits:9',
			'county_id' => 'required|numeric',
			'home_address' => 'required|between:3,50',
			'town' => 'required|between:3,15',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		return User::create([
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'employee_id' => $data['employee_id'],
			'phone' => $data['phone'],
			'county_id' => $data['county_id'],
			'home_address' => $data['home_address'],
			'town' => $data['town'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
		]);
	}

}
