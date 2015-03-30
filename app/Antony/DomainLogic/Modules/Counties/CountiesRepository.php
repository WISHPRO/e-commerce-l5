<?php namespace App\Antony\DomainLogic\Modules\Counties;

use App\Antony\DomainLogic\Modules\DAL\EloquentDataAccessRepository;
use App\Models\County;

class CountiesRepository extends EloquentDataAccessRepository
{

    /**
     * @var County
     */
    private $county;

    public function __construct(County $county)
    {
        parent::__construct($county);
        $this->county = $county;
    }
}