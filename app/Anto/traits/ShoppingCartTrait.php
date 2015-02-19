<?php

namespace app\Anto\Traits;


use App\Http\Requests\ShoppingCartRequest;
use App\Models\Cart;
use Illuminate\Http\Request;
use Response;

trait ShoppingCartTrait {

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
        if($request->get('quantity') != null)
        {
            $qt = $request->get('quantity');

        } else {

            $qt = 1;
        }

        $model = createCartIfNotExist();

        // queryExisting might return null, so just in case:
        if(is_null($model)){
            // just create a new one
            $model = createNewCart();
        }

        // add products
        if(checkForExistingProduct($id))
        {
            flash()->success('product added to cart successfully');

            return \Redirect::back();

        } else {

            $model->products()->attach([$id], ['quantity' => $qt], [$model->id]);

            flash()->success('product added to cart successfully');

            return \Redirect::back();
        }

    }

    public function view()
    {
        // ensure that there's a cart object in the current session
        if(cartExists()){

            // display all products in the shopping cart stored in the current user's session
            $items = Cart::with('products.carts')->whereId(getCartID())->get();

            return view('frontend.cart.products', compact('items'));
        }

        // just display the cart index page
        return view('frontend.cart.index');

    }
    /**
     * Update the specified resource in storage.
     * PUT /cart/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /cart/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}