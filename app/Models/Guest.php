<?php namespace app\Models;

use app\Anto\Traits\CheckoutTrait;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use CheckoutTrait;

    protected $fillable
        = [
            'first_name',
            'last_name',
            'email',
            'phone',
            'county_id',
            'home_address',
            'town',
        ];

    public function getUserName()
    {
        return beautify($this->first_name . " " . $this->last_name);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function county()
    {
        return $this->belongsTo('App\Models\County');
    }
}