<?php namespace app\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class Cart extends Model
{
    protected $fillable = ['product_id', 'id', 'cart_id', 'quantity'];

    public $incrementing = false;

    /**
     * Creates a new cart in the database, and saves it's id in a cookie
     * @return \Symfony\Component\HttpFoundation\Cookie
     */
    public function newCart()
    {
        $this->id = generateCartID();
        // the cookie
        $shopping_cart = Cookie::make('shopping_cart', $this->id, Carbon::MINUTES_PER_HOUR * 12, '/', 'ecomm.pc-world.com');
        $this->save();
        return $shopping_cart;
    }

    /**
     * @param $cart
     * @param $product_id
     * @return $this
     */
    public function doCartCreation(Cart $cart, $product_id, $quantity)
    {
        // grab a cart instance
        $shopping_cart = $cart->newCart();
        // now, we add the product to the cart_id/created cart
        $cart->products()->sync([$product_id], [$cart->id], ['quantity' => $quantity]);
        // attach the cookie to the response
        return Redirect::back()->withCookie($shopping_cart)->with('message', 'Product was successfully added to your shopping cart')->with('alertclass', 'alert-success');
    }

    // a cart can have many products
    public function products()
    {
        return $this->belongsToMany('Product')->withPivot('quantity')->withTimestamps();
    }

    // a cart can be used by many users, though one at a time
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}