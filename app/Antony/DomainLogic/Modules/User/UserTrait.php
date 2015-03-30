<?php namespace App\Antony\DomainLogic\Modules\User;

use App\Models\Cart;
use App\Models\Review;
use Illuminate\Contracts\Auth\Guard;

trait UserTrait
{
    /**
     * The reviews model
     *
     * @var Review
     */
    protected $reviews;

    /**
     * The shopping cart model
     *
     * @var Cart
     */
    protected $cart;

    /**
     * The shopping cart model
     *
     * @var Guard
     */
    protected $guard;

    /**
     * @return string
     */
    public function getUserName()
    {
        return beautify($this->first_name . " " . $this->last_name);
    }

    /**
     * Check if the logged in user has reviewed a product
     *
     * @param $productID
     *
     * @return bool
     */
    public function hasMadeProductReview($productID)
    {
        return false;
    }

    /**
     * Get the logged in user's review of a product
     *
     * @param $productID
     *
     * @return mixed
     */
    public function retrieveUserReview($productID)
    {
        return $this->reviews->whereUserId($this->id)->Where('product_id', $productID)
            ->get()->unique();
    }

    public function retrieveCart()
    {
        // get the shopping cart
        $this->cart = $this->cart->whereUserId($this->id)->get(['id']);

        return $this->cart;
    }

    public function hadShoppingCart()
    {
        return !empty($this->retrieveCart());
    }
}