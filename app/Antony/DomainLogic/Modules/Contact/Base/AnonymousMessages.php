<?php namespace app\Antony\DomainLogic\Modules\Contact\Base;

use app\Antony\DomainLogic\Contracts\Contact\ContactMessageContract;
use app\Antony\DomainLogic\Modules\Contact\ContactMessageRepo;
use app\Antony\DomainLogic\Modules\DAL\Base\DataAccessLayer;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use InvalidArgumentException;

class AnonymousMessages extends DataAccessLayer implements ContactMessageContract
{

    /**
     * @var Store
     */
    private $store;

    /**
     * @var ContactMessageRepo
     */
    private $messageRepo;

    /**
     * @param Store $store
     * @param ContactMessageRepo $messageRepo
     */
    public function __construct(Store $store, ContactMessageRepo $messageRepo)
    {

        $this->store = $store;
        $this->messageRepo = $messageRepo;
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|null
     */
    public function get()
    {
        // TODO: Implement get() method.
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function send($data)
    {
        $msg = parent::create($data);

        if (is_null($msg)) {

            $this->setResult(ContactMessageContract::MESSAGE_NOT_SENT);

            return $this;
        }

        $this->setResult(ContactMessageContract::MESSAGE_SENT);

        // we store the sent status in the session, to prevent multiple messages from being sent by the same user, in the same session
        $this->store->put(ContactMessageContract::MESSAGE_SENT, ContactMessageContract::MESSAGE_SENT);

        return $this;
    }

    /**
     * @param $request
     *
     * @return $this|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function handleRedirect($request)
    {
        if (!$request instanceof Request) {
            throw new InvalidArgumentException('You need to provide a request class to this method');
        }
        switch ($this->getResult()) {

            case ContactMessageContract::MESSAGE_SENT: {
                if ($request->ajax()) {
                    return response()->json(['message' => 'Your message was successfully sent'], 200);
                }
                flash('Your message was successfully sent');
                return redirect()->back();
            }

            case ContactMessageContract::MESSAGE_NOT_SENT: {
                if ($request->ajax()) {
                    return response()->json(['message' => 'Oops!. Your message was not sent. Please try again'], 422);
                }
                flash()->error('Oops!. Your message was not sent. Please try again');
                return redirect()->back()->withInput($request->all());
            }

        }
        return redirect()->back();
    }
}