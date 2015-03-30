<?php namespace app\Http\Controllers\Frontend;

use App\Antony\DomainLogic\modules\Cookies\ApplicationCookie as ShoppingCartCookie;
use App\Antony\DomainLogic\modules\Product\ProductRepository;
use App\Antony\DomainLogic\Modules\ShoppingCart\CartRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\ShoppingCartRequest;
use App\Models\Cart;
use Illuminate\Http\Request;
use Response;

class CartController extends Controller
{

    protected $cart;

    protected $cookie;

    protected $product;

    /**
     * @param CartRepository $repository
     * @param ShoppingCartCookie $cartCookie
     */
    public function __construct(CartRepository $repository, ShoppingCartCookie $cartCookie, ProductRepository $productRepository)
    {
        $this->middleware('cart.check', ['except' => ['store']]);

        $this->cart = $repository;

        $this->cookie = $cartCookie;

        $cartCookie->name = 'shopping_cart';

        $cartCookie->timespan = 3600;

        $this->product = $productRepository;
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
     * @param ShoppingCartRequest $request
     * @param $productID
     *
     * @return Response
     */
    public function store(ShoppingCartRequest $request, $productID)
    {
        // quantity will always default to 1, unless user specifies
        $newQuantity = $request->get('quantity') != null ? $request->get('quantity') : 1;

        // create the shopping cart
        $cart = $this->cart->createIfDoesNotExist($request->all());

        // get existing product quantity for this product in the shopping cart
        $oldQuantity = $this->cart->getExistingQuantity($productID);

        if ($oldQuantity <= 0) {
            // The product with id xxx is not in the user's shopping cart, so we add it
            $this->cart->addProducts($productID, $newQuantity);

            // create shopping cart cookie
            $shoppingCookie = $this->cookie->create([$cart]);

            // queue the cookie, so that it will be sent in the next request
            $this->cookie->queue();

            // the added product
            $addedProduct = $this->product->find($productID, ['reviews']);

            // process AJAX request, if its available
            if ($request->ajax()) {

                return response()->json(['message' => 'The following product was successfully added to your shopping cart', 'product' => $addedProduct]);
            }

            // fallback if request isn't AJAX
            flash()->overlay('The product was successfully added to your shopping cart', "Shopping cart information");

            return redirect()->route('cart.view')->withCookie($shoppingCookie);

        } else {

            // cart has Items. we simply update the qt
            $this->cart->updateExistingQuantity($oldQuantity, $newQuantity, $productID);

            $updated = $newQuantity + $oldQuantity;

            if ($request->ajax()) {
                return response()->json(['message' => 'This product was already in your shopping cart. Its quantity was updated']);
            }

            flash()->overlay(
                "This product was already in your cart. We've updated the quantity to {$updated}",
                "Shopping cart information"
            );

            return redirect()->back();
        }
    }

    /**
     * Allows the user to view the items in their shopping cart
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
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
     * @param ShoppingCartRequest $request
     * @param  int $productID
     *
     * @return Response
     */
    public function update(ShoppingCartRequest $request, $productID)
    {
        // verify that the cart exists in the database
        $cartID = $this->cookie->fetch()->get('id');

        // attempt to associate the cart to the user
        $this->cart->associate = true;

        $cart = $this->cart->find($cartID, false);

        $oldQuantity = $this->cart->getExistingQuantity($productID);

        // get new quantity
        $newQT = $request->get('quantity');

        $this->cart->updateExistingQuantity($oldQuantity, $newQT, $productID, true);

        if ($request->json()) {

            return response()->json(['message' => 'The quantity was successfully updated']);
        }
        flash('The quantity was successfully updated');

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param $productID
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeProduct(Request $request, $productID)
    {
        $this->cart->setCartID($this->cookie->fetch()->get('id'));

        $this->cart->detach($productID);

        if ($request->ajax()) {

            return response()->json(['message', 'The product was successfully removed from your shopping cart']);
        }

        return redirect()->back();
    }

}