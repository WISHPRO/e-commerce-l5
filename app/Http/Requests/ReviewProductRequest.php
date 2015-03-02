<?php namespace App\Http\Requests;

class ReviewProductRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (\Auth::check()) {
            return true;
        }

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
            'stars'   => 'required|numeric|between:1,5',
            'comment' => 'required|between:1,500'
        ];
    }

}