<?php namespace app\Models;


use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    public static $rules = [
        'name' => 'required|between:3,50|unique:settings',

    ];

    protected $fillable = [
        'name',
        'value',
        'extended_value'
    ];

}