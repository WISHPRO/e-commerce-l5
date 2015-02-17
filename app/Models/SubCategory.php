<?php namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    public static $rules = [
        'name' => 'required|between:3,50|unique:sub_categories',
        'banner' => 'image|between:5,2000'
    ];

    protected $fillable = ['name', 'banner'];

    /**
     * @return array
     */
    public function getDimensions()
    {
        $dim = [];
        $dim['height'] = config('site.subcategories.dimensions.height');
        $dim['width'] = config('site.subcategories.dimensions.height');
        return $dim;
    }

    /**
     * @return mixed
     */
    public function getImgStorageDir()
    {
        return config('site.subcategories.images');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withTimestamps();
    }

    // a sub-category belongs to a category

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}