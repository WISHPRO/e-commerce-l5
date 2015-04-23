<?php namespace App\Models;

use App\Antony\DomainLogic\Contracts\ShoppingCart\Reconciler;
use app\Antony\DomainLogic\Modules\Product\ProductReviewsTrait;
use App\Antony\DomainLogic\Modules\Product\ProductTrait;
use app\Antony\DomainLogic\Modules\ShoppingCart\DefaultReconciler;
use App\Antony\DomainLogic\Modules\ShoppingCart\Discounts\PercentageDiscount;
use app\Antony\DomainLogic\Modules\ShoppingCart\Traits\DiscountsTrait;
use App\Antony\DomainLogic\Modules\ShoppingCart\Traits\ReconcilerTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Money\Currency;
use Money\Money;

class Product extends DefaultReconciler
{
    use ProductTrait, DiscountsTrait, ProductReviewsTrait, SoftDeletes;

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
     * @return mixed
     */
    public function getDescriptionShortAttribute($value)
    {
        return is_serialized($value) ? unserialize($value) : $value;
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function getDescriptionLongAttribute($value)
    {
        return is_serialized($value) ? unserialize($value) : $value;
    }

    /**
     * @param $value
     *
     * @return Money
     */
    public function getPriceAttribute($value)
    {
        $value = new Money($value, new Currency(config('site.currencies.default', 'KES')));

        return $value;
    }

    /**
     * @param $value
     *
     * @return int
     */
    public function getTaxableStatus($value)
    {
        return $value === true & ($this->price->greaterThan(config('site.products.taxableThreshold', 2000)));
    }

    /**
     * @param $value
     *
     * @return Money
     */
    public function getShippingAttribute($value)
    {
        return new Money($value, new Currency(config('site.currencies.default', 'KES')));
    }

    /**
     * @param $value
     *
     * @return PercentageDiscount
     */
    public function getDiscountAttribute($value)
    {
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany('App\Models\Order')->withPivot('quantity')->withTimestamps();
    }

}
