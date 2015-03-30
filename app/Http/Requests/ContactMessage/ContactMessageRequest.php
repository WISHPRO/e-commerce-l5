<?php namespace App\Http\Requests\ContactMessage;

use App\Http\Requests\Request;

class ContactMessageRequest extends Request
{

    protected $dontFlash = ['g-recaptcha-response'];

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
            'message' => 'required|between:1,500',
            'user_name' => 'between:1,50',
            'subject' => 'between:1,50',
            'email' => 'required|email',
            'g-recaptcha-response' => 'required|recaptcha',
        ];
    }

    public function messages()
    {
        return [
            'g-recaptcha-response.required' => 'Please solve the recaptcha',
            'message.required' => 'Please enter a message',
            'email.required' => 'Your email address is required',
        ];
    }

}
