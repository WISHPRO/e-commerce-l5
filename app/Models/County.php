<?php namespace app\Models;

use LaravelBook\Ardent\Ardent;

class County extends Ardent
{
    protected $fillable = ['name', 'alias'];

    public static $rules = [
        'name' => 'required|alpha|between:2,20|unique:counties',
        'alias' => 'alpha|between:1,5'
    ];

    public static $customMessages = [
        'name.unique' => 'A county with that name already exists'
    ];
}