<?php namespace app\Anto\DomainLogic\repositories\Reviews;

use app\Anto\domainLogic\repositories\DataAccessRepository;
use app\Models\Review;

class ReviewsRepository extends DataAccessRepository{


    public function __construct(Review $review){
        parent::__construct($review);

    }

}