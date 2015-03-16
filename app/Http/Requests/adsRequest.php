<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class adsRequest extends Request {

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
			'description' => 'required|between:1,1000',
            'image' => 'image|between:1, 3000',
            'ad_representation_id' => 'required|numeric',
            'product_id' => 'required'
		];
	}

}
