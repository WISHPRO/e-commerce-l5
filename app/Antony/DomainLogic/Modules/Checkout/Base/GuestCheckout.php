<?php namespace app\Antony\DomainLogic\Modules\Checkout\Base;

use app\Antony\DomainLogic\Contracts\Checkout\Guest\GuestCheckoutContract;
use app\Antony\DomainLogic\Contracts\Database\DataActionResult;
use app\Antony\DomainLogic\Contracts\Redirects\AppRedirector;
use app\Antony\DomainLogic\Modules\Cookies\CheckOutCookie;
use App\Antony\DomainLogic\Modules\Guests\GuestRepository;
use App\Models\Guest;

abstract class GuestCheckout implements GuestCheckoutContract, DataActionResult, AppRedirector
{

    /**
     * constant representing status = completed
     *
     * @var string
     */
    const STEP_COMPLETE = 'step.completed';

    /**
     * constant representing status = incomplete
     *
     * @var string
     */
    const STEP_INCOMPLETE = 'step.incomplete';

    /**
     * constant representing status = has been done already
     *
     * @var string
     */
    const STEP_ALREADY_DONE = 'step.done.already';

    /**
     * @var string
     */
    protected $stepStatus;

    /**
     * @var array
     */
    protected $cookieData;

    /**
     * @var Guest
     */
    protected $guest;

    /**
     * @var GuestRepository
     */
    protected $guestRepository;

    /**
     * @var CheckOutCookie
     */
    protected $checkOutCookie;

    /**
     * @param GuestRepository $guestRepository
     * @param CheckOutCookie $checkOutCookie
     */
    public function __construct(GuestRepository $guestRepository, CheckOutCookie $checkOutCookie)
    {

        $this->guestRepository = $guestRepository;
        $this->checkOutCookie = $checkOutCookie;
    }

    /**
     * Creates and queues the checkout cookie
     */
    public function createGuestCheckoutCookie($step_id, $data)
    {
        $cookie_data = [
            'step' => $step_id,
            'state' => $this->getStepStatus(),
            'data' => $data
        ];
        // make the cookie that will determine the user's state in the checkout progress
        $this->checkOutCookie->cookie->queue($this->checkOutCookie->name, $cookie_data, $this->checkOutCookie->timespan);
    }

    /**
     * Gets the data from a cookie
     *
     * @return mixed
     */
    /**
     * @return mixed
     */
    public function getCookieData()
    {
        $this->cookieData = array_get($this->checkOutCookie->fetch()->get(), 'data');

        return $this->cookieData;
    }

    /**
     * @return mixed
     */
    public function getStepStatus()
    {
        return $this->stepStatus;
    }

    /**
     * @return mixed
     */
    public function retrieveGuestDetails()
    {
        return $this->getCookieData();
    }

    /**
     * Check if the user is a Guest
     *
     * @return bool
     */
    public function isAGuest()
    {
        return $this->retrieveGuestDetails() instanceof Guest;
    }


    /**
     * @param mixed $stepStatus
     */
    public function setStepStatus($stepStatus)
    {
        $this->stepStatus = $stepStatus;
    }
}