<?php namespace app\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Request;
use Response;


class SearchController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /search
	 *
	 * @return Response
	 */
	public function index()
	{

	}


	/**
	 * Display the specified resource.
	 * GET /search/{id}
	 * @return Response
	 * @internal param string $name
	 * @internal param int|string $id
	 * @internal param array $sortOptions
	 */
	public function show(Request $request)
	{
		$query = $request->get('q');

		// we dont need to call the search function, if the user just didn't give us sth to work with
		return empty($query) ? view('frontend.index') : ClientSearch($query, ctype_digit($query) ? $query : null);

	}


}