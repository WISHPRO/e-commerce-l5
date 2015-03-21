<?php namespace app\http\ViewComposers;

use app\Anto\domainLogic\repositories\Cart\CartRepository;
use app\Anto\domainLogic\repositories\composers\ViewComposer;
use app\Anto\domainLogic\repositories\Cookies\ShoppingCartCookie;
use app\Models\Cart;
use Illuminate\View\View;

class ShoppingCart extends ViewComposer
{
    /**
     * The products repository
     *
     * @var CartRepository
     */
    protected $model;

    /**
     * The cookie repository
     *
     * @var ShoppingCartCookie
     */
    protected $cookie;

    /**
     * @param CartRepository $repository
     * @param ShoppingCartCookie $cookie
     */
    public function __construct(CartRepository $repository, ShoppingCartCookie $cookie)
    {
        $this->model = $repository;

        $this->cookie = $cookie;
    }

    /**
     * compose the view
     *
     * @param View $view
     *
     * @return mixed
     */
    public function compose(View $view)
    {
        if (!empty($this->cookie->fetch()->data)) {

            $id = $this->cookie->fetch()->get('id');

            $cart = $this->model->getFirstBy('id', '=', $id, ['products.carts', 'products']);

            if (!$cart->hasItems()) {

                return null;

            }

            return $view->with('cart', $cart);
        }

        return null;
    }
}