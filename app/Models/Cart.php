<?php namespace App\Models;

use App\Antony\DomainLogic\Contracts\ShoppingCart\Reconciler;
use app\Antony\DomainLogic\Modules\ShoppingCart\DefaultReconciler;
use App\Antony\DomainLogic\Modules\ShoppingCart\Traits\ReconcilerTrait;
use App\Antony\DomainLogic\Modules\ShoppingCart\Traits\ShoppingCartTrait;
use Eloquent;

class Cart extends DefaultReconciler
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