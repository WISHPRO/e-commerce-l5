<?php namespace app\Http\Controllers\Frontend;

use app\Anto\domainLogic\repositories\Product\ProductSearch;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;


class SearchController extends Controller
{

    private $model = null;

    public function __construct(ProductSearch $productSearch)
    {
        $this->model = $productSearch;

    }

    /**
     *
     */
    public function index()
    {
        // some view. like advanced search or etc
    }

    /**
     * @param \App\Http\Requests\SearchRequest $request
     *
     * @return $this|\Illuminate\View\View
     */
    public function show(SearchRequest $request)
    {
        return $this->model->search($request->get('q'));
    }


}