<?php namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{

    public $incrementing = false;

    protected $fillable = [
        'id',
        'description',
        'image',
        'product_id',
        'category_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->belongsTo('app\Models\Product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('app\Models\Category');
    }
}