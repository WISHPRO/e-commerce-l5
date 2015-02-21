<?php namespace app\Models;


use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    public static $rules = [
        'name'  => 'required|alpha|between:2,20|unique:counties',
        'alias' => 'alpha|between:1,5'
    ];
    public static $customMessages = [
        'name.unique' => 'A county with that name already exists'
    ];
    protected $fillable = [ 'name', 'alias' ];
}