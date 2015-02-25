<?php namespace app\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\Review;
use Redirect;
use Response;

class ReviewsController extends Controller
{


    public function index()
    {
//		$data = Review::with('products')->where('stars', '>=', '4')->get()->pivot->review_count;
//		$product = new Product();

        $data = Review::with( 'products' )->where( 'stars', '>=', '4' )->get();

        dd( $data );
        Redirect::route( 'home' );
    }

    /**
     * Store a newly created resource in storage.
     * POST /productreviews
     *
     * @return Response
     */
    public function store()
    {
        // should process an AJAX post request from the client

    }

    /**
     * Display the specified resource.
     * GET /productreviews/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show( $id )
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
    public function update( $id )
    {
        // allow a user to edit their comment. To be implemented later
        return Redirect::back()->with( 'message', $this->notImplementedMessage )->with( 'alertclass', 'alert-info' );
    }

}