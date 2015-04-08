<?php namespace App\Antony\DomainLogic\Modules\User;

use App\Models\Cart;
use App\Models\Review;
use Illuminate\Contracts\Auth\Guard;

trait UserTrait
{
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
     * @return mixed
     */
    public function canAccessBackend()
    {
        return $this->hasRole([config('site.backend.allowedRoles', 'Administrator')]);
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
        $data = Review::whereUserId($this->id)->whereProductId($productID)->get(['id']);

        return !$data->isEmpty();
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
        return Review::whereUserId($this->id)->Where('product_id', $productID)
            ->get()->unique();
    }

    /**
     * @return Cart|array|static[]
     */
    public function retrieveCart()
    {
        // get the shopping cart
        $this->cart = $this->cart->whereUserId($this->id)->get(['id']);

        return $this->cart;
    }

    /**
     * @return bool
     */
    public function hadShoppingCart()
    {
        return !empty($this->retrieveCart());
    }

    /**
     * Checks if a user has added extra data to their account
     *
     * @return int
     */
    public function hasAddedAccountData()
    {

        return $this->avatar !== null | $this->dob !== null | $this->gender !== null;
    }
}