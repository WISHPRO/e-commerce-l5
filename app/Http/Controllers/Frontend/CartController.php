<?php namespace app\Http\Controllers\Frontend;

use app\Anto\domainLogic\repositories\Cart\CartRepository;
use app\Anto\domainLogic\repositories\Cookies\ShoppingCartCookie;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShoppingCartRequest;
use app\Models\Cart;
use Response;

class CartController extends Controller
{

    private $cart = null;

    private $cookie = null;

    public function __construct(CartRepository $repository, ShoppingCartCookie $cartCookie)
    {
        $this->middleware('cart.check', ['except' => ['store']]);

        $this->cart = $repository;

        $this->cookie = $cartCookie;
    }

    /**
     * Display a listing of the resource.
     * GET /cart
     *
     * @return Response
     */
    public function index()
    {
        return view('frontend.cart.index');
    }

    /**
     * Store a newly created resource in storage.
     * POST /cart
     *
     * @return Response
     */
    public function store(ShoppingCartRequest $request, $productID)
    {
        // quantity will always default to 1, unless user specifies
        $newQuantity = $request->get('quantity') != null ? $request->get('quantity') : 1;

        $cartInfo = [
            'id' => str_random()
        ];

        $cart = $this->cart->createIfNotExist($cartInfo);

        // get existing quantity
        $oldQuantity = $this->cart->getExistingQuantity($productID);

        if ($oldQuantity <= 0) {
            // cart has no items
            $this->cart->addProducts($productID, $newQuantity);

            flash()->overlay('The product was successfully added to your shopping cart', "Shopping cart information");

            return redirect()->route('cart.view')->withCookie($this->cookie->create([$cart]));

        } else {

            // cart has Items. we simply update the qt
            $this->cart->updateExistingQuantity($oldQuantity, $newQuantity, $productID);

            $updated = $newQuantity + $oldQuantity;
            // notify the user
            flash()->overlay(
                "This product was already in your cart. We've updated the quantity to {$updated}",
                "Shopping cart information"
            );

            return redirect()->back();
        }
    }

    public function view()
    {
        $cart = $this->cart->find($this->cookie->fetch()->get('id'));
        if ($cart->hasItems()) {
            return view('frontend.Cart.products');
        }
        return redirect()->route('cart.index');
    }

    /**
     * Update the specified resource in storage.
     * PUT /cart/{id}
     *
     * @param  int $productID
     *
     * @return Response
     */
    public function update(ShoppingCartRequest $request, $productID)
    {
        // verify that the cart exists in the database
        $cart = $this->cart->find($this->cookie->fetch()->get('id'));

        if ($cart == null) {
            return view('frontend.Cart.index');
        }

        $oldQuantity = $this->cart->getExistingQuantity($productID);

        // get new quantity
        $newQT = $request->get('quantity');

        $this->cart->updateExistingQuantity($oldQuantity, $newQT, $productID, true);

        return redirect()->back();
    }

    public function removeProduct($productID)
    {
        $this->cart->setCartID($this->cookie->fetch()->get('id'));

        $this->cart->detach($productID);

        return redirect()->back();
    }

}