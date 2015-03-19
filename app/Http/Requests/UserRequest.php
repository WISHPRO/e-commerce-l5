<?php namespace App\Http\Requests;

class UserRequest extends Request
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
            'first_name' => 'required|alpha|between:2,15',
            'last_name' => 'required|alpha|between:2,15',
            'phone' => 'required|digits:9|unique:users',
            'county_id' => 'required|numeric',
            'home_address' => 'required|between:3,50',
            'town' => 'required|between:3,15',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'photo' => 'image|between:4,3000',
            'accept' => 'required'
        ];

        if ($this->isMethod('patch')) {

            $rules['email'] = 'required|email|max:255|unique:users,id,' . $this->user()->id;
            $rules['phone'] = 'required|digits:9|unique:users,id,' . $this->user()->id;
        }

        return $rules;
    }

    public function Messages()
    {
        return [
            'accept.required' => 'You need to accept our terms of service',
            'email.unique' => 'That email belongs to another user',
            'phone.unique' => 'That phone number belongs to another user'
        ];
    }

}
