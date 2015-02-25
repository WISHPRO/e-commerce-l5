<?php namespace App\Http\Requests;

class CategoryRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'   => 'required|between:3,50|unique:categories',
            'alias'  => 'alpha_dash|between:3,50',
            'banner' => 'image|between:5,2000',
        ];
    }

}
