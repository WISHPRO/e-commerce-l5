<?php namespace App\Http\Controllers\Frontend;

use App\Antony\DomainLogic\Modules\Product\ProductSearch;
use App\Http\Controllers\Controller;
use App\Http\Requests\Search\SearchRequest;
use Illuminate\Http\Request;


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
        // display a view. like advanced search or etc
    }

    /**
     * @param SearchRequest $request
     *
     * @return $this|\Illuminate\View\View|mixed|\Symfony\Component\HttpFoundation\Response
     */
    public function show(SearchRequest $request)
    {
        if ($request->ajax()) {
            // turn on AJAX search in the search class
            $this->model->useAJAX = true;

            // disable pagination
            $this->model->paginate = false;

            // no need to set the request search param object, since it matches our requirements

            return $this->model->search($request)->processAJAXRequest();
        }

        return $this->model->search($request);

    }

}