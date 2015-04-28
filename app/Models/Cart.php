<?php namespace App\Models;

use app\Antony\DomainLogic\Modules\ShoppingCart\Base\ShoppingCartReconciler;

class Cart extends ShoppingCartReconciler
{
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