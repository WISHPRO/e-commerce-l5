<?php namespace App\Http\Requests;

class adsRequest extends Request
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
            'description' => 'required|between:1,1000',
            'image' => 'required|image|between:1,3000',
            'product_id' => 'required|numeric',
        ];
    }

}
