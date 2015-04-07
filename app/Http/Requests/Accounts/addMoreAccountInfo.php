<?php namespace App\Http\Requests\Accounts;

use App\Http\Requests\Request;

class addMoreAccountInfo extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return $this->user() !== null;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
        if($this->isMethod('patch')){
            return [
                'avatar' => 'sometimes|required|image|between:4,3000',
                'dob' => 'sometimes|required|date',
                'gender' => 'sometimes|required|in:Male,Female',
            ];
        }
	}

}
