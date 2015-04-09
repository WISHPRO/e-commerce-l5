<?php namespace App\Antony\DomainLogic\Modules\Guests;

use App\Antony\DomainLogic\Modules\DAL\EloquentDataAccessRepository;
use App\Models\Guest;

class GuestRepository extends EloquentDataAccessRepository
{
    public function __construct(Guest $guest)
    {
        parent::__construct($guest);
    }
}