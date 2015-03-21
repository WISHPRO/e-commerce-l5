<?php namespace app\Anto\domainLogic\repositories\Cart;

use app\Anto\domainLogic\repositories\Cookies\ShoppingCartCookie;
use app\Anto\domainLogic\repositories\EloquentDataAccessRepository;
use app\Models\Cart;
use Illuminate\Auth\Guard;

class CartRepository extends EloquentDataAccessRepository
{

    /**
     * Defines if we should associate a cart to an authenticated user
     *
     * @var boolean
     */
    public $associate = false;

    /**
     * Authentication implementation
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Cookie repository
     *
     * @var ShoppingCartCookie
     */
    protected $cookie;

    /**
     * Cart ID
     *
     * @var string
     */
    protected $cartID;

    /**
     * @param Cart $cart
     * @param Guard $auth
     * @param ShoppingCartCookie $cartCookie
     */
    public function __construct(Cart $cart, Guard $auth, ShoppingCartCookie $cartCookie)
    {
        parent::__construct($cart);

        $this->auth = $auth;

        $this->cookie = $cartCookie;
    }

    /**
     * Attempts to add a shopping cart to the database if it does not exist
     *
     * @param $data
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection|null|static
     */
    public function createIfNotExist($data)
    {
        // ensure that there's a cart to begin with
        if (empty($this->cookie->fetch()->data)) {

            $cart = $this->add($data);
        } else {
            // try to find the cart in the db, if its cookie exists
            $cart = $this->find($this->cookie->get('id'), false);

            // just create a new one, if it does not exist
            if (is_null($cart)) {

                $cart = $this->add($data);
            }
        }

        return $cart;
    }

    /**
     * Adds a shopping cart to the database
     *
     * @param $data
     *
     * @return static
     */
    public function add($data)
    {
        if ($this->auth->check()) {
            // associate the cart with this user
            $model = $this->auth->user()->shopping_cart()->save($data);
            $this->setCartID($model->id);

            return $model;
        }
        $model = parent::add($data);
        $this->setCartID($model->id);

        return $model;
    }

    /**
     * Attempts to find a shopping cart, using the params provided
     * When association is set to true, once the cart is found it will be automatically linked to the authenticated user
     *
     * @param $id
     * @param array $relationships
     * @param bool $throwExceptionIfNotFound
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection|null|static
     */
    public function find($id, $relationships = [], $throwExceptionIfNotFound = true)
    {

        $data = parent::find($id, $relationships, $throwExceptionIfNotFound);

        if ($this->auth->check() and $this->associate and !is_null($data)) {

            // check if the cart already belong to this user
            if ($data->user_id === $this->auth->id()) {

                return $data;
            }

            // associate the cart to the authenticated user
            $data->user()->associate($this->auth->user());

            $data->update();
        }

        return $data;
    }

    /**
     * Gets the existing quantity of a product in the shopping cart
     *
     * @param $productID
     *
     * @return int|mixed
     */
    public function getExistingQuantity($productID)
    {
        $data = $this->queryDB($productID);

        if (empty($data)) {
            return 0;
        }

        // get the quantity
        $this->model->quantity = (int)array_pluck($data, 'quantity');

        return $this->model->quantity;
    }

    /**
     * Queries the database for an existing product in the shopping cart
     *
     * @param $id
     *
     * @return array
     *
     */
    public function queryDB($id)
    {
        if (!empty($this->cookie->fetch()->data)) {
            $this->setCartID($this->cookie->get('id'));
        }

        return \DB::select(
            "SELECT `product_id`, `quantity` FROM `cart_product` WHERE product_id = ? AND cart_id = ?",
            [$id, $this->getCartID()]
        );
    }

    /**
     * Gets the cart ID
     *
     * @return mixed
     */
    public function getCartID()
    {
        return $this->model->id;
    }

    /**
     * Sets the cart ID
     *
     * @param $id
     */
    public function setCartID($id)
    {
        $this->model->id = $id;
    }

    /**
     * Updates the quantity of a specific product in the shopping cart
     *
     * @param $existingQt
     * @param $newQuantity
     * @param $productID
     * @param bool $forceUpdate
     *
     * @return mixed
     */
    public function updateExistingQuantity($existingQt, $newQuantity, $productID, $forceUpdate = false)
    {
        $qt = $forceUpdate ? $newQuantity : $existingQt + $newQuantity;

        return $this->model->products()->updateExistingPivot($productID, ['quantity' => $qt]);
    }


    /**
     * Calls the attach method, which does the actual adding of products to the cart
     *
     * @param $productID
     * @param $quantity
     *
     * @return mixed
     */
    public function addProducts($productID, $quantity)
    {
        return $this->attach($productID, $quantity);
    }


    /**
     * Adds products to the shopping cart
     *
     * @param $id
     * @param $quantity
     *
     * @return mixed
     */
    public function attach($id, $quantity)
    {
        return $this->model->products()->attach([$id], ['quantity' => $quantity], [$this->getCartID()]);
    }


    /**
     * Removes a product from the shopping cart
     *
     * @param $id
     *
     * @return mixed
     */
    public function detach($id)
    {
        return $this->model->products()->detach($id);
    }
}