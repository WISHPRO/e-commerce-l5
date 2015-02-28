<?php namespace app\Anto\Traits;

use app\Models\Product;
use app\Models\Review;
use app\Models\User;
use Auth;

trait UserTrait
{

    protected $selfDestruct = false;

    /**
     * @return bool
     */
    public function isEmployee()
    {
        return $this->find(\Auth::id())->get('employee_id') == null;
    }

    /**
     * Determines if the logged in user can trash their own account
     *
     * @return boolean
     */
    public function canSelfDestruct()
    {
        return $this->selfDestruct;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return beautify($this->first_name." ".$this->last_name);
    }

    /**
     * Display user status on the homepage.
     * If a user isn't logged in, the default string will be displayed
     *
     * @param string $default
     *
     * @return string
     */
    public static function displayStatus($default = "My Account")
    {
        return Auth::check() ? beautify(Auth::user()->getUserName()) : $default;
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
        $data = Review::with('user')->whereUserId(Auth::id())->orWhere(
            'product_id',
            $productID
        );

        return !empty($data);
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
        return Review::whereUserId(Auth::id())->Where('product_id', $productID)
            ->get()->unique();
    }

}