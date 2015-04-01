<?php namespace App\Models;

use App\Antony\DomainLogic\Contracts\ShoppingCart\Reconciler;
use App\Antony\DomainLogic\Modules\Checkout\ReconcilerTrait;
use app\Antony\DomainLogic\Modules\Product\ProductReviewsTrait;
use App\Antony\DomainLogic\Modules\Product\ProductTrait;
use App\Antony\DomainLogic\Modules\ShoppingCart\Discounts\PercentageDiscount;
use app\Antony\DomainLogic\Modules\ShoppingCart\DiscountsTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Money\Currency;
use Money\Money;

class Product extends Model implements Reconciler
{
    use ProductTrait, ReconcilerTrait, DiscountsTrait, ProductReviewsTrait;

    // public $incrementing = false;

    protected $fillable = [
        'name',
        'price',
        'discount',
        'quantity',
        'description_long',
        'description_short',
        'warranty_period',
        'image'
    ];

    protected $casts = [
        'available' => 'boolean',
        'free' => 'boolean',
        'taxable' => 'boolean',
    ];

    /**
     * @param $value
     *
     * @return Money
     */
    public function getPriceAttribute($value)
    {
        return new Money($value, new Currency($this->defaultCurrency));
    }

    /**
     * @param $value
     *
     * @return Money
     */
    public function getShippingAttribute($value)
    {
        return new Money($value, new Currency($this->defaultCurrency));
    }

    /**
     * @param $value
     *
     * @return PercentageDiscount
     */
    public function getDiscountAttribute($value){

        return new PercentageDiscount($value);
    }

    /**
     * @param $value
     *
     * @return string
     */
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    /**
     * @param $value
     *
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    /**
     * @param $value
     *
     * @return string
     */
    public function getDeletedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    // RELATIONSHIPS
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function brands()
    {
        return $this->belongsToMany('App\Models\Brand')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subcategories()
    {
        return $this->belongsToMany('App\Models\SubCategory')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function carts()
    {
        return $this->belongsToMany('App\Models\Cart')->withPivot('quantity')->withTimestamps();
    }

}
