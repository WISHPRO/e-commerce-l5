<?php namespace app\Models;

use LaravelBook\Ardent\Ardent;

class Review extends Ardent
{
    protected $fillable = ['stars', 'comment', 'user_id', 'product_id'];

    public static $rules = [
        'stars' => 'required|numeric|between:0.5,5.0',
        'comment' => 'required|between:5,1000',
        'user_id' => 'required',
        'product_id' => 'required'
    ];

    public static $customMessages = [

    ];

    // many users can make many reviews
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    // many reviews can belong to many products
    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }
}