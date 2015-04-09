<?php namespace App\Antony\DomainLogic\Modules\User;

use App\Models\Cart;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;

trait UserTrait
{
    /**
     * The minimum user's age allowed
     *
     * @var int
     */
    public $minAge = 18;

    /**
     * The maximum user's age allowed
     *
     * @var int
     */
    public $maxAge = 60;

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

    /**
     * Check the user's age with an option of returning it
     * By default, we only return the fact that they passed/not
     *
     * @param $dateOfBirth
     * @param bool $returnAge
     *
     * @return bool|int
     */
    public function checkAge($dateOfBirth, $returnAge = false)
    {
        // get the absolute time difference between now and the user's dob
        $difference = abs(strtotime(time()) - strtotime($dateOfBirth));

        // get the years in between, using carbon's class age attribute
        $years = Carbon::createFromTimestamp($difference)->age;

        // check if user is over/under age
        $passed = $years > $this->minAge & $years < $this->maxAge ? true : false;

        // return the age, or ..
        return $returnAge ? $years : $passed;

    }

    /**
     * User's age helper
     *
     * @return int
     */
    public function getUsrAge()
    {
        // get the absolute time difference between now and the user's dob
        $difference = abs(strtotime(time()) - strtotime($this->dob));

        // get the years in between, using carbon's class age attribute
        return Carbon::createFromTimestamp($difference)->age;
    }
}