<?php namespace app\Models;

use LaravelBook\Ardent\Ardent;

class Settings extends Ardent
{
    public static $rules = [
        'name' => 'required|between:3,50|unique:settings',

    ];

    protected $fillable = [
        'name', 'value', 'extended_value'
    ];

}