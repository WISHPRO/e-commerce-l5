<?php namespace App\Http\Requests;

class CountyRequest extends Request
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
        $rules = [
            'name'  => 'required|alpha|between:2,20|unique:counties',
            'alias' => 'alpha|between:1,5'
        ];

        if (\Request::is('update')) {
            $rules['name'] = [
                'required|alpha|between:2,20|unique:counties,id'.$this->get(
                    'id'
                )
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.unique' => 'A county with that name already exists'
        ];
    }

}
