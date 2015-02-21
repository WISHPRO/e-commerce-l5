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

        $model = createCartIfNotExist();

        // queryExisting might return null, so just in case:
        if (is_null( $model )) {
            // just create a new one
            $model = createNewCart();
        }

        // we store this temporarily to avoid a second round-trip to the DB, to determine the existing quantity
        $data = checkForExistingProduct( $id );
        // get old quantity
        $oldQt = getExistingQtInDB( $data );

        if (!empty( $data ) & !is_null( $oldQt )) {
            // update product quantity, and tell the user
            updateExistingQuantity( $model, $oldQt, $qt, $id );

            flash()->message(
                'This product was already in your cart. We\'ve updated the quantity to ' . '{$oldQt + $qt}'
            );

            return \Redirect::back();

        } else {
            // insert new product
            $model->products()->attach( [ $id ], [ 'quantity' => $qt ], [ $model->id ] );

            flash()->success( 'product added to cart successfully' );

            return \Redirect::back();
        }

    }

    public function view()
    {
        // ensure that there's a cart with products

        if (cartExists()) {
            $cart = verifyCart();

            if (is_null( $cart )) {
                // just display the cart index page
                return view( 'frontend.cart.index' );
            }

            if (hasItems( $cart )) {

                // display all products in the shopping cart stored in the current user's session
                $items = Cart::with( 'products.carts' )->whereId( retrieveCartIDFromSession() )->get();

                return view( 'frontend.cart.products', compact( 'items' ) );
            }

            // just display the cart index page
            return view( 'frontend.cart.index' );
        }

        // just display the cart index page
        return view( 'frontend.cart.index' );

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
        // get existing quantity
        // we store this temporarily to avoid a second round-trip to the DB, to determine the existing quantity
        $data = checkForExistingProduct( $id );
        // get old quantity
        $oldQt = getExistingQtInDB( $data );
        // get new quantity
        $newQT = $request->get( 'quantity' );
        // attempt modification
        if (!empty( $data ) & !is_null( $oldQt )) {
            updateExistingQuantity( queryExisting(), $oldQt, $newQT, $id, true );

            flash()->success( 'success' );

            return redirect()->back();

        } else {
            // empty or non existing shopping cart
            return view( 'frontend.cart.index' );
        }
    }

    /**
     * Remove a product from the shoppin cart
     * PUT /cart/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function removeProduct( $id )
    {
        // get existing quantity
        // we store this temporarily to avoid a second round-trip to the DB, to determine the existing quantity
        $data = checkForExistingProduct( $id );

        if (!empty( $data )) {
            $status = removeProductFromCart( queryExisting(), $id );

            flash()->success( 'success' );

            return redirect()->back();

        } else {
            // empty or non existing shopping cart
            return view( 'frontend.cart.index' );
        }
    }

}