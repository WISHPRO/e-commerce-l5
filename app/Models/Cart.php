<?php namespace App\Models;

use App\Antony\DomainLogic\Modules\Checkout\ShoppingCartTrait;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use ShoppingCartTrait;

    public $incrementing = false;

    protected $fillable = ['product_id', 'cart_id', 'quantity'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot('quantity')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}