<?php namespace app\Models;

use LaravelBook\Ardent\Ardent;

class Advertisements extends Ardent
{
    public static $rules = [
        'name' => 'required|unique:advertisements',
        'banner' => 'image|between:1,2000'
    ];

    protected $fillable = ['name', 'banner'];
}