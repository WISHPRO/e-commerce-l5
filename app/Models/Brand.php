<?php namespace app\Models;


use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    protected $fillable = ['name', 'logo'];



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