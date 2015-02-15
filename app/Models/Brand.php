<?php namespace app\Models;


use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public static $rules = [
        'name' => 'required|alpha_dash|between:2,15|unique:brands',
        'logo' => 'required|mimes:png|between:1,1000',
    ];

    /**
     * @return array
     */
    public function getDimensions()
    {
        $dim = [];
        $dim['height'] = env('IMG_BRAND_HEIGHT');
        $dim['width'] = env('IMG_BRAND_WIDTH');
        return $dim;
    }

    // relationships
    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }

    protected $fillable = ['name', 'logo'];
}