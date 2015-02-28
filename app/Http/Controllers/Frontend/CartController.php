<?php namespace app\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShoppingCartRequest;
use app\Models\Cart;
use Response;


class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('cart.check', ['except' => ['store']]);
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
    public function store(ShoppingCartRequest $request, $id)
    {
        // quantity will always default to 1, unless user specifies
        $qt = $request->get('quantity') != null ? $request->get('quantity') : 1;

        // ensure that there's a cart to begin with
        $cart = cartExists(true);

        if ($cart == null) {
            // the shopping cart does not exist in the database
            $cart = new Cart();
            $cart = $cart->createNewCart();
        }

        // we store this temporarily to avoid a second round-trip to the DB, to determine the existing quantity
        $data = $cart->checkForExistingProduct($id);

        // get old quantity
        $oldQt = $cart->getExistingQtInDB($data);

        if (!empty($data) & !is_null($oldQt)) {
            // update product quantity, and tell the user
            $cart->updateExistingQuantity($oldQt, $qt, $id);

            $updated = $oldQt + $qt;

            flash()->overlay(
                "This product was already in your cart. We've updated the quantity to {$updated}",
                "Shopping cart information"
            );

            return redirect()->back();

        } else {
            // insert new product
            $cart->products()->attach([$id], ['quantity' => $qt], [$cart->id]);

            flash()->overlay(
                'The product was successfully added to your shopping cart',
                "Shopping cart information"
            );

            return redirect()->route('cart.view')->withCookie(
                $cart->makeCartCookie()
            );
        }

    }

    public function view()
    {
        $cart = cartCookieValue(true);

        return view('frontend.Cart.products');
    }

    /**
     * Update the specified resource in storage.
     * PUT /cart/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update(ShoppingCartRequest $request, $id)
    {
        // verify that the cart exists in the database
        $cart = cartExists(true);
        // ensure that there's a cart to begin with
        if (!$cart) {
            return view('frontend.Cart.index');
        }

        // we store this temporarily to avoid a second round-trip to the DB, to determine the existing quantity
        $data = $cart->checkForExistingProduct($id);
        // get old quantity
        $oldQt = $cart->getExistingQtInDB($data);
        // get new quantity
        $newQT = $request->get('quantity');

        // attempt modification
        if (!empty($data) & !is_null($oldQt)) {
            $cart->updateExistingQuantity($oldQt, $newQT, $id, true);

            return redirect()->back();

        } else {
            // empty or non existing shopping cart
            return view('frontend.Cart.index');
        }
    }

    public function removeProduct($id)
    {
        // verify that the cart exists in the database
        $cart = cartExists(true);
        // ensure that there's a cart to begin with
        if (!$cart) {
            return view('frontend.Cart.index');
        }

        $cart->removeProductFromCart($id);

        return redirect()->back();
    }

}