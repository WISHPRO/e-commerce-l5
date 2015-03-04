<?php namespace app\Anto\Traits;

use app\Models\Cart;
use app\Models\Product;
use app\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

trait ShoppingCartTrait
{
    /**
     * Allows us to create a new shopping cart
     *
     * @return Cart
     */
    public function createNewCart()
    {
        $this->id = $this->generateCartID();
        // if user is logged in, we associate the cart with him/her
        if (\Auth::check()) {
            \Auth::user()->shopping_cart()->save($this);

            return $this;
        }

        $this->save();

        return $this;
    }

    /**
     * Allows us to generate a cart ID
     *
     * @param bool $number
     *
     * @return string
     */
    public function generateCartID($number = true)
    {
        $value = $number ? generateRandomInt() : str_random(10);

        return $value;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Cookie
     */
    public function makeCartCookie()
    {
        if (\Cookie::has('shopping_cart')) {
            \Cookie::forget('shopping_cart');
        }

        return cookie(
            'shopping_cart',
            $this->id,
            Carbon::now()->addMinutes(300),
            '/'
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Cookie
     */
    public function appendToCartCookie()
    {
        if (\Cookie::has('shopping_cart')) {
            // append to existing
            return cookie(
                'shopping_cart',
                $this,
                Carbon::tomorrow()->minute,
                '/'
            );
        }
    }

    /**
     * self explanatory
     * The param returnData specifies if the public function should return the intermediate values from querying the database
     * This way, checking if null can be done later, and allows us to pluck some values from that data
     *
     * @param $id
     *
     * @return bool
     */
    public function checkForExistingProduct($id)
    {
        $data = $this->queryDB($id, $this->id);

        return $data;
    }

    /**
     * @param $id
     * @param $cart
     * @param $qt
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addNewProduct(Cart $cart, $id, $qt)
    {
        $this->products()->attach([$id], ['quantity' => $qt], [$cart->id]);
    }

    /**
     * Query the database for an existing product in the current shopping cart
     *
     * @param $id
     * @param $cart_id
     *
     * @return array
     */
    public function queryDB($id, $cart_id)
    {
        return \DB::select(
            "SELECT `product_id`, `quantity` FROM `cart_product` WHERE product_id = ? AND cart_id = ?",
            [$id, $cart_id]
        );
    }

    /**
     * Allow us to check if a cart has any items
     *
     * @param Cart $cart
     *
     * @return bool
     */
    public function hasItems()
    {
        return $this->getTotalBasketCount() > 0;
    }

    /**
     * Allow us to easily count the total number of products in the user's shopping cart
     * However, this works on a per-product basis, and doesnt take into account individual product quantities.
     * so it can only display sth like ==> product A = 1 items, even though the user added two of this products in the
     * cart
     *
     * @param Cart $cart
     *
     * @return mixed
     */
    public function getTotalBasketCount()
    {
        return $this->products->count();
    }

    /**
     * Get exiting quantity of a product in the shopping cart
     *
     * @param $data
     *
     * @return int|null
     */
    public function getExistingQtInDB($data)
    {
        if (empty($data)) {
            return null;
        }

        // get the quantity
        return (int)array_pluck($data, 'quantity');
    }

    /**
     * update the existing quantity of a product in the shopping cart
     *
     * @param $existingQt
     * @param $newQuantity
     * @param $productID
     */
    public function updateExistingQuantity(
        $existingQt,
        $newQuantity,
        $productID,
        $forceUpdate = false
    ) {
        $qt = $forceUpdate ? $newQuantity : $existingQt + $newQuantity;

        $this->products()->updateExistingPivot($productID, ['quantity' => $qt]);
    }

    /**
     * Allows us to calculate the price of a product in the shopping cart
     * We of course take into account the quantity of a single product and its discount
     *
     * @param Product $product
     *
     * @return float|mixed
     */
    public function getProductPrice(Product $product)
    {
        return $product->hasDiscount()
            ?
            $product->calculateDiscount(true) * $this->getSingleProductQuantity(
                $product
            )
            : $product->price * $this->getSingleProductQuantity($product);
    }

    /**
     * Allows for removal of a product from the cart
     * Works on a per-product basis
     *
     * @param Cart $model
     * @param      $productID
     *
     * @return int
     */
    public function removeProductFromCart($productID)
    {
        return $this->products()->detach($productID);
    }

    /**
     * Calculate the subtotal of products in the cart
     *
     * @param Model $cart
     *
     * @return mixed
     */
    public function getSubTotal()
    {
        return $this->products->sum(
            function ($product) {
                // just call the public function above us!!
                return $this->getProductPrice($product);
            }
        );
    }

    /**
     * Allow us to get the total number of items in the current basket, on a per individual product basis
     * so, if a user added a product with quantity = 2, then the value returned will be 2 ...etc
     *
     * @param Cart $cart
     *
     * @return int
     */
    public function getAllProductsQuantity()
    {
        // just count all the items in the current cart, per -->
        return $this->products->sum(
            function ($product) {
                // access the pivot value, which is quantity. then use it for getting the sum
                return $product->pivot->quantity;
            }
        );
    }

    /**
     * Allow us to get the quantity of a single product in a user's shopping cart
     * The query assumes presence of a pivot in the collection, so if the query fails, we just return 1
     *
     * @param Product $product
     *
     * @return int
     */
    public function getSingleProductQuantity(Product $product)
    {
        // access the pivot that came with the collection. Cart::with('products.carts')->where('id', .....
        // table cart_product has a quantity field, which we then access via the pivot
        $qt = $product->pivot->quantity;

        // If the query fails for some reason, just return 1
        return $qt == null ? 1 : $qt;
    }
}