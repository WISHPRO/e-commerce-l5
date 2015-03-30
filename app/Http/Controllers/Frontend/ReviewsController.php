<?php namespace app\Http\Controllers\Frontend;

use App\Antony\DomainLogic\Modules\Reviews\ReviewsRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reviews\ReviewProductRequest;
use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Guard;

class ReviewsController extends Controller
{

    protected $auth;

    protected $model;

    /**
     * @param Guard $guard
     * @param ReviewsRepository $repository
     */
    public function __construct(Guard $guard, ReviewsRepository $repository)
    {
        $this->auth = $guard;

        $this->model = $repository;
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

        $this->model->add($request->all());

        if ($request->ajax()) {
            return response()->json(['message' => 'Your comment was saved. Thank you']);
        }

        flash('your comment was saved. Thank you');

        return redirect()->back();
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
        $review = $this->model->update($request->all(), $r);

        if ($request->ajax()) {
            return response()->json(['message' => 'Your review was successfully modified']);
        }

        flash('Your review was successfully modified');

        return redirect()->back();
    }

}