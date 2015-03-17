<?php namespace app\Anto\DomainLogic\repositories\Counties;

use app\Anto\domainLogic\repositories\EloquentDataAccessRepository;
use app\Models\County;

class CountiesRepository extends EloquentDataAccessRepository
{

    public function __construct(County $county)
    {
        parent::__construct($county);
    }
}