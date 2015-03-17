<?php namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{

    public $incrementing = false;

    protected $fillable = [
        'id',
        'description',
        'ad_representation_id',
        'image',
        'product_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function representation()
    {

        return $this->belongsTo('app\Models\adsRepresentation');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {

        return $this->belongsTo('app\Models\Product');
    }
}