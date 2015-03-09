<?php namespace app\Models;

use app\Anto\domainLogic\Traits\CheckoutTrait;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use CheckoutTrait;

    protected $fillable = [];

}