<?php namespace app\http\ViewComposers;


use App\Antony\DomainLogic\Modules\Composers\ViewComposer;
use App\Antony\DomainLogic\Modules\Cookies\ShoppingCartCookie;
use App\Antony\DomainLogic\Modules\ShoppingCart\Base\CartRepository;
use App\Models\Cart;
use Illuminate\View\View;

class ShoppingCart extends ViewComposer
{
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

            $id = $this->cookie->fetch()->get()->id;

            $cart = $this->model->getFirstBy('id', '=', $id, ['products']);

            if (!$cart->hasItems()) {

                return null;

            }

            return $view->with('cart', $cart);
        }

        return null;
    }
}