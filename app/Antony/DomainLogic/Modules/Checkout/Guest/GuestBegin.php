<?php namespace app\Antony\DomainLogic\Modules\Checkout\Guest;

use app\Antony\DomainLogic\Contracts\Checkout\GuestCheckoutContract;
use app\Antony\DomainLogic\Modules\Checkout\Base\AppCheckout;
use app\Antony\DomainLogic\Modules\Cookies\CheckOutCookie;
use App\Antony\DomainLogic\Modules\Guests\GuestRepository;
use App\Models\Guest;
use Illuminate\Http\Request;
use InvalidArgumentException;

class GuestBegin extends AppCheckout implements GuestCheckoutContract
{
    /**
     * @var Guest
     */
    protected $guest;

    /**
     * @var array
     */
    protected $cookieData;

    /**
     * @var GuestRepository
     */
    private $guestRepository;

    /**
     * @var CheckOutCookie
     */
    private $checkOutCookie;

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
     * @return $this
     */
    public function verifyCurrentStep()
    {
        $currentStep = array_get($this->checkOutCookie->fetch()->get(), 'step');

        $stepData = $this->getCookieData();

        $stepStatus = array_get($this->checkOutCookie->fetch()->get(), 'state');

        if ($currentStep !== GuestCheckoutContract::STEP) {

            return $this;
        }
        if (!$stepData instanceof Guest) {

            return $this;
        }

        $this->setStepStatus($stepStatus);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCookieData()
    {
        $this->cookieData = array_get($this->checkOutCookie->fetch()->get(), 'data');

        return $this->cookieData;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function processGuestDetails($data)
    {
        if (empty($this->getCookieData())) {

            // this step has not yet been initialized, so we create the guest user
            $this->guest = $this->guestRepository->add($data);

            if ($this->guest !== null) {

                $this->setStepStatus(GuestCheckoutContract::STEP_COMPLETED);

                return $this;
            }

            // guest data already exists
            $this->setStepStatus(GuestCheckoutContract::STEP_INCOMPLETE);

            return $this;
        }

        $this->guest = $this->cookieData;

        $this->setStepStatus(GuestCheckoutContract::STEP_ALREADY_DONE);

        return $this;
    }

    /**
     *
     */
    public function makeGuestCheckoutCookie()
    {
        $data = [
            'step' => GuestCheckoutContract::STEP,
            'state' => $this->getStepStatus(),
            'data' => $this->guest
        ];
        // make the cookie that will determine the user's state in the checkout progress
        $this->checkOutCookie->cookie->queue($this->checkOutCookie->name, $data, $this->checkOutCookie->timespan);
    }

    /**
     * Handle a redirect after a CRUD operation
     *
     * @param $request
     *
     * @return mixed
     */
    public function handleRedirect($request)
    {
        if (!$request instanceof Request) {

            throw new InvalidArgumentException('Please provide a request class to this method');
        }

        if (is_null($this->getStepStatus())) {

            return redirect()->route('checkout.auth');
        }
        switch ($this->getStepStatus()) {

            case GuestCheckoutContract::STEP_ALREADY_DONE : {

                // redirect with data
                return redirect()->back()->withInput($this->cookieData);
            }
            case GuestCheckoutContract::STEP_INCOMPLETE : {

                return redirect()->route('checkout.step1');
            }
            case GuestCheckoutContract::STEP_COMPLETED : {

                // redirect user to the next step
                return redirect()->route('checkout.step2');
            }
        }
        return redirect()->route('checkout.auth');
    }
}