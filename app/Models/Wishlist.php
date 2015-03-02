<?php namespace app\Models;

use app\Anto\Traits\WishlistTrait;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use WishlistTrait;

    protected $fillable = ['name', 'description'];

}