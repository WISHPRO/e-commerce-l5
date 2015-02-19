<?php namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['product_id', 'id', 'cart_id', 'quantity'];

    public $incrementing = false;

    // a cart can have many products
    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot('quantity')->withTimestamps();
    }

    // a cart belongs to a user
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}