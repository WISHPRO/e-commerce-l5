<?php namespace App\Http\Requests;


class ProductRequest extends Request
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
        $rules = [
            'name' => 'required|between:3,255|unique:products',
            'price' => 'required|numeric|between:1,1000000',
            'category_id' => 'numeric',
            'sub_category_id' => 'numeric',
            'brand_id' => 'numeric',
            'quantity' => 'required|numeric|between:1,1000',
            'image' => 'image|between:5,3000',
            'discount' => 'numeric|between:0,100',
            'warranty_period' => 'numeric|between:1,24',
            'description_short' => 'required',
            'description_long' => 'required',
        ];

        if ($this->isMethod('post')) {

            $rule['image'] = 'required|image|between:5,3000';
        }
        if ($this->isMethod('patch')) {

            $rule['image'] = 'image|between:5,3000';
            $rules['name'] = 'required|between:3,255|unique:products,id,' . $this->get('id');
        }

        return $rules;
    }

}
