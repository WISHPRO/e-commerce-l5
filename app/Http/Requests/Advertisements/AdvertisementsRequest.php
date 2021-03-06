<?php namespace App\Http\Requests\Advertisements;

use App\Http\Requests\Request;

class AdvertisementsRequest extends Request
{

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
        return [
            'description' => 'required|between:1,1000',
            'image' => 'required|image|between:1,3000',
            'product_id' => 'required|numeric',
        ];
    }

}
