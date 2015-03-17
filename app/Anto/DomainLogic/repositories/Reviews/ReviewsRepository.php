<?php namespace app\Anto\DomainLogic\repositories\Reviews;

use app\Anto\domainLogic\repositories\EloquentDataAccessRepository;
use app\Models\Review;

class ReviewsRepository extends EloquentDataAccessRepository
{


    public function __construct(Review $review)
    {
        parent::__construct($review);

    }

}