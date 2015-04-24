<?php namespace App\Http\Controllers\Frontend;

use app\Antony\DomainLogic\Modules\Reviews\Base\ProductReviews;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reviews\ReviewProductRequest;

class ReviewsController extends Controller
{

    /**
     * @var ProductReviews
     */
    private $productReviews;

    /**
     * @param ProductReviews $productReviews
     */
    public function __construct(ProductReviews $productReviews)
    {

        $this->productReviews = $productReviews;
    }


    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        // $reviews = $this->productReviews->get();
        return redirect()->back();
    }

    /**
     * @param ReviewProductRequest $request
     * @param $productID
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function store(ReviewProductRequest $request, $productID)
    {
        $data = array_add($request->except('_token'), 'product_id', $productID);

        return $this->productReviews->create($data)->handleRedirect($request);
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
     * @param $id
     *
     * @return $this|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function update(ReviewProductRequest $request, $id)
    {
        return $this->productReviews->edit($id, $request->except('_token'))->handleRedirect($request);
    }

}