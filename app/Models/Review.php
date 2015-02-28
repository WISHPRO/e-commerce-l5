<?php namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable
        = [
            'stars',
            'comment',
            'user_id',
            'product_id'
        ];

    // review belongs to a user
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // a review belongs to a product
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}