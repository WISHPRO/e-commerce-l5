<?php namespace app\http\ViewComposers;

use app\Anto\domainLogic\repositories\Cart\CartRepository;
use app\Anto\domainLogic\repositories\composers\ViewComposer;
use app\Anto\domainLogic\repositories\Cookies\ShoppingCartCookie;
use app\Models\Cart;
use Illuminate\View\View;

class ShoppingCart extends ViewComposer
{
    protected $model = null;

    protected $cookie = null;

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
        if ($this->cookie->exists()) {

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