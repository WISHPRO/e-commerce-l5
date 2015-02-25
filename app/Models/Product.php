<?php namespace app\Models;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{

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

    // define categories that will display their specifications in the single products page
    private $allowed_categories = [
        'Laptops',
        'desktop systems',
    ];

    // RELATIONSHIPS
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany( 'App\Models\Category' )->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function brands()
    {
        return $this->belongsToMany( 'App\Models\Brand' )->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subcategories()
    {
        return $this->belongsToMany( 'App\Models\SubCategory' )->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany( 'App\Models\Review' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function carts()
    {
        return $this->belongsToMany( 'App\Models\Cart' )->withPivot( 'quantity' )->withTimestamps();
    }

    /**
     * @return array
     */
    public function getDimensions()
    {
        $dim = [ ];
        $dim[ 'height' ] = config( 'site.products.dimensions.height' );
        $dim[ 'width' ] = config( 'site.products.dimensions.width' );

        return $dim;
    }

    /**
     * @return mixed
     */
    public function getImgStorageDir()
    {
        return config( 'site.products.images' );
    }

    /**
     * @return mixed
     */
    public function getMagnifyValue()
    {
        return config( 'site.products.reduce' );
    }

    /**
     * @return array
     */
    public function getAllowedCategories()
    {
        return $this->allowed_categories;
    }

    /**
     * @param array $allowed_categories
     */
    public function setAllowedCategories( $allowed_categories = [ ] )
    {
        $this->allowed_categories = $allowed_categories;
    }

}