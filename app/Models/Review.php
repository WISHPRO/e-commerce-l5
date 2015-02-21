<?php namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public static $rules = [
        'stars'      => 'required|numeric|between:0.5,5.0',
        'comment'    => 'required|between:5,1000',
        'user_id'    => 'required',
        'product_id' => 'required'
    ];
    public static $customMessages = [

    ];
    protected $fillable = [
        'stars',
        'comment',
        'user_id',
        'product_id'
    ];

    // review belongs to a user

    public function user()
    {
        return $this->belongsTo( 'App\Models\User' );
    }

    // a review belongs to a product
    public function product()
    {
        return $this->belongsTo( 'App\Models\Product' );
    }
}