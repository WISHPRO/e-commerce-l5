<?php namespace app\Anto\DomainLogic\repositories\Guest;

use app\Anto\domainLogic\repositories\EloquentDataAccessRepository;
use app\Models\Guest;

class GuestRepository extends EloquentDataAccessRepository
{

    public function __construct(Guest $guest)
    {
        parent::__construct($guest);
    }
}