<?php namespace app\Anto\domainLogic\repositories\Cart;

use app\Anto\domainLogic\repositories\Cookies\ShoppingCartCookie;
use app\Anto\domainLogic\repositories\DataAccessRepository;
use app\Models\Cart;
use Illuminate\Auth\Guard;

class CartRepository extends DataAccessRepository
{

    public $auth = null;

    public $cookie = null;

    public $cartID = null;

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
     * @param $data
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection|null|static
     */
    public function createIfNotExist($data)
    {
        // ensure that there's a cart to begin with
        if (empty($this->cookie->fetch()->data)) {

            $cart = $this->add($data);
        } else {
            // try to find the cart in the db, if its cookie exists
            $cart = $this->find($this->cookie->get('id'));

            // just create a new one, if it does not exist
            if ($cart == null) {

                $cart = $this->model->add($data);
            }
        }

        $this->setCartID($cart->id);

        return $cart;
    }

    /**
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
        $model = $this->model->create($data);
        $this->setCartID($model->id);

        return $model;
    }

    public function setCartID($id)
    {
        $this->model->id = $id;
    }

    public function getCartID()
    {
        return $this->model->id;
    }

    /**
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
     * @param $id
     * @param $cart_id
     *
     * @return array
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
     * @param $id
     *
     * @return mixed
     */
    public function detach($id)
    {
        return $this->model->products()->detach($id);
    }
}