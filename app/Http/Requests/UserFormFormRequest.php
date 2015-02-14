<?php namespace App\Http\Requests;

class UserFormRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'first_name' => 'required|between:3,30',
			'last_name' => 'required|between:3,30',
			'email' => 'required|email|unique:users',
			'employee_id' => 'digits:4|unique:users',
			'password' => 'required|between:6,30|alpha_num|confirmed',
			'password_confirmation' => 'required',
			'phone' => 'required|digits:9',
			'county' => 'required|numeric',
			'home_address' => 'required|between:3,50',
			'town' => 'required|between:3,15',
		];
	}

}
