<?php namespace App\Antony\DomainLogic\Modules\Reviews;

use App\Antony\DomainLogic\Modules\DAL\EloquentDataAccessRepository;
use App\Models\Review;
use Illuminate\Contracts\Auth\Guard;

class ReviewsRepository extends EloquentDataAccessRepository
{

    /**
     * @var Guard
     */
    protected $auth;

    /**
     * @var Review
     */
    private $review;

    /**
     * @param Review $review
     * @param Guard $guard
     */
    public function __construct(Review $review, Guard $guard)
    {
        parent::__construct($review);

        $this->auth = $guard;

        $this->review = $review;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function add($data)
    {
        // authenticated user
        $authUser = $this->auth->user();

        $productID = array_pull($data, 'product_id');

        // associate the review to a product and the currently logged in user
        $this->model->creating(function($r) use ($productID, $authUser){

            $r->product_id = $productID;

            $r->user_id = $authUser->getAuthIdentifier();
        });

        return parent::add($data);
    }
}