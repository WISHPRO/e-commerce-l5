<?php namespace App\Models;

use Eloquent;

class Ad extends Eloquent
{

    public $incrementing = false;

    protected $fillable = [
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
        return $this->belongsTo('App\Models\Product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}