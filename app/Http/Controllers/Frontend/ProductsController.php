<?php

use App\Http\Controllers\Controller;

class ProductsController extends Controller {

	/**
	 * Display a listing of products
	 *
	 * @return Response
	 */
	public function index()
	{
		$products = Product::all();

		$products->load('name', 'price');

		return View::make('frontend.products.index', compact('products'));
	}

	/**
	 * Display the specified product.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$product = Product::with('reviews')->findOrFail($id);
//		dd($products);
		return View::make('frontend.products.single', compact('product'));
	}

}
