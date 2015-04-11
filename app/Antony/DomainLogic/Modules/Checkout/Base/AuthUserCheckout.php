<?php namespace app\Antony\DomainLogic\Modules\Checkout\Base;

use app\Antony\DomainLogic\Contracts\Checkout\AuthenticatedUser\AuthUserCheckoutContract;
use app\Antony\DomainLogic\Contracts\Database\DataActionResult;
use app\Antony\DomainLogic\Contracts\Redirects\AppRedirector;
use app\Antony\DomainLogic\Modules\Cookies\CheckOutCookie;
use app\Antony\DomainLogic\Modules\User\Base\Users;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

abstract class AuthUserCheckout implements AuthUserCheckoutContract, AppRedirector, DataActionResult
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
     * @var User
     */
    protected $user;

    /**
     * @var Users
     */
    protected $users;

    /**
     * @var CheckOutCookie
     */
    protected $checkOutCookie;

    /**
     * @var Authenticatable
     */
    protected $authenticatable;

    /**
     * @param Users $usersModule
     * @param CheckOutCookie $checkOutCookie
     */
    public function __construct(Users $usersModule, CheckOutCookie $checkOutCookie, Authenticatable $authenticatable)
    {
        $this->users = $usersModule;
        $this->checkOutCookie = $checkOutCookie;
        $this->authenticatable = $authenticatable;
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
    public function retrieveStepData()
    {
        return $this->getCookieData();
    }

    /**
     * @return Authenticatable
     */
    public function retrieveUserDetails()
    {
        return $this->authenticatable;
    }

    /**
     * @param mixed $stepStatus
     */
    public function setStepStatus($stepStatus)
    {
        $this->stepStatus = $stepStatus;
    }

    /**
     * Creates and queues the checkout cookie
     *
     * @param $step_id
     * @param $data
     *
     * @return mixed|void
     */
    public function createUserCheckoutCookie($step_id, $data)
    {
        $cookie_data = [
            'step' => $step_id,
            'state' => $this->getStepStatus(),
            'data' => $data
        ];
        // make the cookie that will determine the user's state in the checkout progress
        $this->checkOutCookie->cookie->queue($this->checkOutCookie->name, $cookie_data, $this->checkOutCookie->timespan);
    }

}