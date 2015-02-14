<?php namespace app\Models;

use LaravelBook\Ardent\Ardent;

class AnonymousMessages extends Ardent
{
    public static $rules = [
        'message' => 'required|between:1,500',
        'user_name' => 'between:1,50',
        'subject' => 'between:1,50',
        'email' => 'required|email',
        'g-recaptcha-response' => 'required|recaptcha',
    ];
    public static $customMessages = [
        'g-recaptcha-response.required' => 'Please solve the recaptcha'
    ];
    protected $fillable = ['message', 'subject', 'user_name', 'email'];
}