<?php namespace app\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewProductRequest;
use App\Models\Review;
use app\Models\User;
use Response;

class ReviewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     * POST /productreviews
     *
     * @return Response
     */
    public function store(ReviewProductRequest $request, $id)
    {
        $request['user_id'] = \Auth::id();
        $request['product_id'] = $id;

        if (\Auth::user()->hasMadeProductReview($id)) {
            flash('You\'ve already rated this product. Thank you');

            return redirect()->back();
        }

        Review::create($request->all());

        flash('your comment was saved. Thank you');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     * GET /productreviews/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * PUT /productreviews/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update(ReviewProductRequest $request, $p, $r)
    {
        $review = Review::find($r);

        $review->stars = $request->get('stars');

        $review->comment = $request->get('comment');

        $review->save();

        flash('Your review was successfully modified');

        return redirect()->back();
    }

}