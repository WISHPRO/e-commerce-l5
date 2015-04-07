<?php namespace app\Antony\DomainLogic\Modules\Contact;

use App\Antony\DomainLogic\Modules\DAL\EloquentDataAccessRepository;
use App\Models\AnonymousMessages;

class ContactMessageRepo extends EloquentDataAccessRepository
{

    /**
     * @param AnonymousMessages $anonymousMessages
     */
    public function __construct(AnonymousMessages $anonymousMessages)
    {
        $this->model = $anonymousMessages;
    }
}