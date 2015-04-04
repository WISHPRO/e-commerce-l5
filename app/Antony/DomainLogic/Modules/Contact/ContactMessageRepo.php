<?php namespace app\Antony\DomainLogic\Modules\Contact;

use app\Antony\DomainLogic\Contracts\Contact\ContactMessageContract as MsgStatus;
use App\Antony\DomainLogic\Modules\DAL\EloquentDataAccessRepository;
use App\Models\AnonymousMessages;
use Illuminate\Session\Store;

class ContactMessageRepo extends EloquentDataAccessRepository implements MsgStatus
{

    /**
     * @var Store
     */
    private $store;

    /**
     * @param AnonymousMessages $anonymousMessages
     * @param Store $store
     */
    public function __construct(AnonymousMessages $anonymousMessages, Store $store)
    {

        $this->model = $anonymousMessages;
        $this->store = $store;
    }

    /**
     * Send an anonymous message
     *
     * @param $data
     *
     * @return string
     */
    public function send($data)
    {
        $msg = parent::add($data);

        if (is_null($msg)) {
            return MsgStatus::MESSAGE_NOT_SENT;
        }

        // we store the sent status in the session, to prevent multiple messages from being sent by the same user
        $this->store->put(MsgStatus::MESSAGE_SENT, MsgStatus::MESSAGE_SENT);

        return MsgStatus::MESSAGE_SENT;
    }
}