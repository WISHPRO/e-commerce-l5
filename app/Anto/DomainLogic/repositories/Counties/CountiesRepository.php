<?php namespace app\Anto\DomainLogic\repositories\Counties;

use app\Anto\domainLogic\repositories\DataAccessRepository;
use app\Models\County;

class CountiesRepository extends DataAccessRepository
{

    public function __construct(County $county)
    {
        parent::__construct($county);
    }
}