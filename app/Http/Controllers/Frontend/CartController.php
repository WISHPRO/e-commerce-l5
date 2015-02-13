<?php
use App\Http\Controllers\Controller;


class CartController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /cart
	 *
	 * @return Response
	 */
	public function index()
	{
		// display all products in the cart
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /cart
	 *
	 * @return Response
	 */
	public function store($id)
	{
		$product_id = $id;
		$quantity = Input::get('quantity', 1);

		$original_quanity = Input::get('qt');
//		dd($quantity, ' ', $original_quanity);
		// validate quantities
		if (ctype_digit($quantity) & $quantity <= $original_quanity )
		{
			// proceed with save
			// get cart_id from cookie
			$cart_id = Cookie::get('shopping_cart', null);

			// create a cart instance, to be used later
			$cart = new Cart();
			// if the cart_id is null, it means the cookie expired, or got deleted.
			// So, we recreate the cookie
			if(is_null($cart_id)){

				// the product will be added to the new cart, and a redirect will be issued back to the user, containing the cookie
				return $this->createCart($cart, $product_id, $quantity);

			} else {

				// verify that the cart exists in the database
				$code = Cart::find($cart_id);

				// if code is empty, it means the cart is invalid. so, we simply create another one
				if(is_null($code)){

					return $this->createCart($cart, $product_id, false);

				} else {
					// cart exists, so we use it
					$cart->id = $cart_id;

					// $user->roles()->sync(array(1 => array('expires' => true)));
					$cart->products()->sync([$product_id], ['quantity' => $quantity], [$cart_id], false);
					return Redirect::back()->with('message', $this->productAddedToCartMsg)->with('alertclass', 'alert-success');
				}

			}
		}
		return Redirect::back()->with('message', 'you entered an invalid quantity. Please try again');

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

	/**
	 * @param Cart $cart
	 * @param $product_id
	 * @param $exists
	 * @return \Illuminate\Http\RedirectResponse
	 */
	private function createCart(Cart $cart, $product_id, $quantity, $exists = true)
	{
		if($exists){

			return $cart->doCartCreation($cart, $product_id, $quantity);
		}
		else {
			// destroy the previous cookie
			Cookie::forget('shopping_cart');
			// create a new shopping cart
			return $cart->doCartCreation($cart, $product_id, $quantity);
		}

	}

}