<?php namespace App\Http\Requests;

class RolesRequest extends Request
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
            'name' => 'required|alpha_dash|between:2,30|unique:roles',
            'display_name' => 'between:3,30',
            'description' => 'between:3,200'
        ];
    }

}
