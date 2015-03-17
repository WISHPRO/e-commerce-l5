<?php namespace app\Models;

use app\Anto\domainLogic\Traits\ProductTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use ProductTrait;

    // public $incrementing = false;

    protected $fillable = [
        'name',
        'price',
        'discount',
        'sku',
        'quantity',
        'description_long',
        'description_short',
        'colors_available',
        'warranty_period',
        'image',
        'processor',
        'memory',
        'storage',
        'video_memory',
        'image_large',
        'operating_system'
    ];

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
        return $this->belongsToMany('App\Models\Cart')->withPivot('quantity')
            ->withTimestamps();
    }

}