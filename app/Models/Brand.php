<?php namespace app\Models;


use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    /**
     * @return array
     */
    public function getDimensions()
    {
        $dim = [];
        $dim['height'] = config('site.brands.dimensions.height');
        $dim['width'] = config('site.brands.dimensions.height');
        return $dim;
    }

    /**
     * @return mixed
     */
    public function getImgStorageDir()
    {
        return config('site.brands.images');
    }

    // relationships
    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }

    protected $fillable = ['name', 'logo'];
}