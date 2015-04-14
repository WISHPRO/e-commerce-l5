<?php namespace App\Http\Controllers\Frontend;

use app\Antony\DomainLogic\Modules\ShoppingCart\ShoppingCart;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\ShoppingCartRequest;
use Illuminate\Http\Request;

class CartController extends Controller
{

    /**
     * @var ShoppingCart
     */
    private $shoppingCart;

    /**
     * @param ShoppingCart $shoppingCart
     */
    public function __construct(ShoppingCart $shoppingCart)
    {
        $this->middleware('cart.check', ['except' => ['store']]);

        $this->shoppingCart = $shoppingCart;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.cart.index');
    }

    /**
     * @param ShoppingCartRequest $request
     * @param $productID
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function store(ShoppingCartRequest $request, $productID)
    {
        return $this->shoppingCart->create($request, $productID)->handleRedirect($request);
    }

    /**
     * Allows the user to view the items in their shopping cart
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function view()
    {
        if ($this->shoppingCart->hasProducts()) {
            // cart has items
            return view('frontend.Cart.products');
        }
        return redirect()->route('cart.index');
    }


    /**
     * @param ShoppingCartRequest $request
     * @param $productID
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function update(ShoppingCartRequest $request, $productID)
    {
        return $this->shoppingCart->updateShoppingCart($request, $productID)->handleRedirect($request);
    }

    /**
     * @param Request $request
     * @param $productID
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeProduct(Request $request, $productID)
    {
        return $this->shoppingCart->removeProduct($productID)->handleRedirect($request);
    }

}