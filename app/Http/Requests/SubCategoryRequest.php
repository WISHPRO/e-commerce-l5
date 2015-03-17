<?php namespace App\Http\Requests;

class SubCategoryRequest extends Request
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
            'name' => 'required|unique:sub_categories',
            'alias' => 'alpha',
            'banner' => 'image|between:5,2000',
            'category_id' => 'required'
        ];
    }

}
