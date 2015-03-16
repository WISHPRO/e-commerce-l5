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
            'name'              => 'required|between:3,255|unique:products',
            'price'             => 'required|numeric|between:1,1000000',
            'category_id'       => 'numeric',
            'sub_category_id'   => 'numeric',
            'brand_id'          => 'numeric',
            'quantity'          => 'required|numeric|between:1,1000',
            'image'             => 'image|required|between:5,3000',
            // start with at least 2 digits, then a point, then another 2
            'discount'          => 'regex:/[\d]{1,2}.[\d]{1,2}/',
            'warranty_period'   => 'numeric|between:1,24',
            'description_short' => 'required|between:1,500',
            'description_long'  => 'required',
        ];

        if (\Request::segment(3) === 'update') {
            dd();
            $rules['name'] = [
                'required|between:3,255|unique:products,id'.$this->get('id')
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'A product with that name already exists.'
        ];
    }
}
