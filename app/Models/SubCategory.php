<?php namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{

    use SoftDeletes;

    protected $fillable = ['name', 'category_id'];

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
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * @param $value
     *
     * @return string
     */
    public function getNameAttribute($value)
    {
        return beautify($value);
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
}