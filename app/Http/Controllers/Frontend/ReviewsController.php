<?php namespace app\Http\Controllers\Frontend;

use app\Anto\DomainLogic\repositories\Reviews\ReviewsRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewProductRequest;
use App\Models\Review;
use app\Models\User;
use Illuminate\Auth\Guard;

class ReviewsController extends Controller
{

    protected $auth = null;

    protected $model = null;

    /**
     * @param Guard $guard
     * @param ReviewsRepository $repository
     */
    public function __construct(Guard $guard, ReviewsRepository $repository)
    {
        $this->middleware('auth');

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
        $data = [
            'user_id' => $this->auth->id(),
            'product_id' => $id,
            'comment' => $request->get('comment'),
            'stars' => $request->get('stars')
        ];

        if ($this->auth->user()->hasMadeProductReview($id)) {
            flash('You\'ve already rated this product. Thank you');

            return redirect()->back();
        }

        $this->model->add($data);

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

        flash('Your review was successfully modified');

        return redirect()->back();
    }

}