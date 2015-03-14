<?php namespace App\Http\Requests;

class BrandFormRequest extends Request
{

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
            'name' => 'required|alpha_dash|between:2,15|unique:brands',
            'logo' => 'required|mimes:png|between:1,1000',
        ];
    }

}
