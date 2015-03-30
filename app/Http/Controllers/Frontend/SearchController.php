<?php namespace app\Http\Controllers\Frontend;

use App\Antony\DomainLogic\Modules\Product\ProductSearch;
use App\Http\Controllers\Controller;
use App\Http\Requests\Search\SearchRequest;


class SearchController extends Controller
{

    protected $model;

    /**
     * @param ProductSearch $productSearch
     */
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

    public function show(SearchRequest $request)
    {
        return $this->model->search($request->get('q'));
    }

}