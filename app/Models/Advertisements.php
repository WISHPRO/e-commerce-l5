<?php namespace app\Models;


use Illuminate\Database\Eloquent\Model;

class Advertisements extends Model
{
    public static $rules = [
        'name'   => 'required|unique:advertisements',
        'banner' => 'image|between:1,2000'
    ];

    protected $fillable = [ 'name', 'banner' ];
}