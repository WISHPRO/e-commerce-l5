<?php namespace app\Models;


use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    protected $fillable = ['name', 'logo'];

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

    // relationships

    /**
     * @return mixed
     */
    public function getImgStorageDir()
    {
        return config('site.brands.images');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }
}