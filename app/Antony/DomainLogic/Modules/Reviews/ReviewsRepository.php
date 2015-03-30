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

        // associate the reviews to the user
        return $this->auth->user()->reviews()->save($data);
    }
}