<?php namespace app\Models;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    public static $rules = [
        'name' => 'required|between:3,50|unique:categories',
        'alias' => 'alpha_dash|between:3,50',
        'banner' => 'image|between:5,2000',
    ];

    protected $fillable = [
        'name',
        'alias',
        'banner'
    ];

    /**
     * @return array
     */
    public function getDimensions()
    {
        $dim = [];
        $dim['height'] = env('IMG_CATEGORY_HEIGHT');
        $dim['width'] = env('IMG_CATEGORY_WIDTH');
        return $dim;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subcategories()
    {
        return $this->hasMany('App\Models\SubCategory');
    }
}