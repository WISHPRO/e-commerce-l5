<?php namespace app\Models;

use Illuminate\Database\Eloquent\Model;
use Money\Currency;
use Money\Money;

class Order extends Model
{
    //use SoftDeletes;

    public $incrementing = false;

    protected $casts = [
        'status',
        'done'
    ];

    public function getTotalCostAttribute($value)
    {
        return new Money($value, new Currency(config('site.currencies.default', 'KES')));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\product')->withTimestamps()->withPivot('quantity');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function guests()
    {
        return $this->belongsToMany('App\Models\Guest')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function invoice()
    {
        return $this->hasOne('App\Models\Invoice');
    }
}