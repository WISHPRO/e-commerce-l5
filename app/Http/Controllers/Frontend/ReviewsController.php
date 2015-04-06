<?php namespace App\Http\Controllers\Frontend;

use app\Antony\DomainLogic\Modules\Reviews\Base\ProductReviews;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reviews\ReviewProductRequest;
use App\Models\Review;
use App\Models\User;

class ReviewsController extends Controller
{

    /**
     * @var ProductReviews
     */
    private $productReviews;

    public function __construct(ProductReviews $productReviews)
    {

        $this->productReviews = $productReviews;
    }


    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        return redirect()->back();
    }

    /**
     * @param ReviewProductRequest $request
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ReviewProductRequest $request, $id)
    {
        dd();
        $data = array_add($request->except('_token'), 'product_id', $id);

        return $this->productReviews->addReview($data)->handleRedirect($request);
    }


    /**
     * @param $id
     */
    public function show($id)
    {
        //
    }

    /**
     * @param ReviewProductRequest $request
     * @param $p
     * @param $r
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ReviewProductRequest $request, $p, $r)
    {
        return $this->productReviews->editReview($r, $request->except('_token'))->handleRedirect($request);
    }

}