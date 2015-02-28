<?php namespace app\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use Response;


class SearchController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /search
     *
     * @return Response
     */
    public function index()
    {
        // some view. like advanced search or etc
    }


    /**
     * Display the specified resource.
     * GET /search/{id}
     *
     * @return Response
     * @internal param string $name
     * @internal param int|string $id
     * @internal param array $sortOptions
     */
    public function show(SearchRequest $request)
    {
        $query = $request->get('q');

        return findProduct($query, ctype_digit($query) ? $query : null);

    }


}