<?php namespace app\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShoppingCartRequest;
use app\Models\Cart;
use Response;


class CartController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /cart
     *
     * @return Response
     */
    public function index()
    {
        return view( 'frontend.cart.index' );
    }

    /**
     * Store a newly created resource in storage.
     * POST /cart
     *
     * @return Response
     */
    public function store( ShoppingCartRequest $request, $id )
    {
        // quantity will always default to 1, unless user specifies
        $qt = $request->get( 'quantity' ) != null ? $request->get( 'quantity' ) : 1;

        // ensure that there's a cart to begin with
        if(session('shopping_cart') == null)
        {
            $cart = new Cart();
            $cart = $cart->createNewCart();
        }
        else {
            // verify that the cart exists in the database
            $cart = Cart::find(session('shopping_cart'));

            // non existent cart
            if (is_null( $cart ))
            {
                // just display the cart index page
                return view( 'frontend.cart.index' );
            }
        }

        // we store this temporarily to avoid a second round-trip to the DB, to determine the existing quantity
        $data = $cart->checkForExistingProduct( $id );
        // get old quantity
        $oldQt = $cart->getExistingQtInDB( $data );

        if (!empty( $data ) & !is_null( $oldQt )) {
            // update product quantity, and tell the user
            $cart->updateExistingQuantity( $cart, $oldQt, $qt, $id );

            $updated = $oldQt + $qt;

            flash()->message(
                "This product was already in your cart. We've updated the quantity to {$updated}"
            );

            return redirect()->route('cart.view');

        } else {
            // insert new product
            $cart->products()->attach( [ $id ], [ 'quantity' => $qt ], [ $cart->id ] );

            flash()->success( 'product added to cart successfully' );

            return redirect()->route('cart.view');
        }

    }

    public function view()
    {
        return view( 'frontend.Cart.products');
    }

    /**
     * Update the specified resource in storage.
     * PUT /cart/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update( ShoppingCartRequest $request, $id )
    {
        // ensure that there's a cart to begin with
        if(session('shopping_cart') == null)
        {
            return view( 'frontend.Cart.index' );
        }
        // verify that the cart exists in the database
        $cart = Cart::find(session('shopping_cart'));

        // non existent cart
        if (is_null( $cart ))
        {
            // just display the cart index page
            return view( 'frontend.cart.index' );
        }

        // we store this temporarily to avoid a second round-trip to the DB, to determine the existing quantity
        $data = $cart->checkForExistingProduct( $id );
        // get old quantity
        $oldQt = $cart->getExistingQtInDB( $data );
        // get new quantity
        $newQT = $request->get( 'quantity' );
        // attempt modification
        if (!empty( $data ) & !is_null( $oldQt ))
        {
            $cart->updateExistingQuantity( $cart, $oldQt, $newQT, $id, true );

            return redirect()->back();

        } else {
            // empty or non existing shopping cart
            return view( 'frontend.Cart.index' );
        }
    }

    /**
     * Remove a product from the shopping cart
     * PUT /cart/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function removeProduct( $id )
    {
        // ensure that there's a cart to begin with
        if(session('shopping_cart') == null)
        {
            return view( 'frontend.Cart.index' );
        }
        // verify that the cart exists in the database
        $cart = Cart::find(session('shopping_cart'));

        // non existent cart
        if (is_null( $cart ))
        {
            // just display the cart index page
            return view( 'frontend.cart.index' );
        }

        // get existing quantity
        // we store this temporarily to avoid a second round-trip to the DB, to determine the existing quantity
        $data = $cart->checkForExistingProduct( $id );

        if (!empty( $data ))
        {
            $status = $cart->removeProductFromCart( $cart, $id );

            return redirect()->back();

        } else {
            // empty or non existing shopping cart
            return view( 'frontend.Cart.index' );
        }
    }

}