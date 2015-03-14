<?php namespace app\Anto\DomainLogic\repositories\Guest;

use app\Anto\domainLogic\repositories\DataAccessRepository;
use app\Models\Guest;

class GuestRepository extends DataAccessRepository
{

    public function __construct(Guest $guest)
    {
        parent::__construct($guest);
    }
}