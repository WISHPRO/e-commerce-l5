<?php namespace app\Antony\DomainLogic\Modules\Checkout\Guest;

use app\Antony\DomainLogic\Contracts\Checkout\ShippingDataContract;
use app\Antony\DomainLogic\Modules\Checkout\Base\AppCheckout;
use App\Antony\DomainLogic\Modules\Guests\GuestRepository;
use Illuminate\Http\Request;
use InvalidArgumentException;

class ShippingStep extends AppCheckout implements ShippingDataContract
{
    /**
     * @var array
     */
    protected $cookieData;

    /**
     * @var GuestRepository
     */
    private $guestRepository;

    /**
     * @param GuestRepository $guestRepository
     */
    public function __construct(GuestRepository $guestRepository)
    {

        $this->guestRepository = $guestRepository;
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

            case ShippingDataContract::STEP_ALREADY_DONE : {

                // redirect with data
                return redirect()->back()->withInput($this->cookieData);
            }
            case ShippingDataContract::STEP_INCOMPLETE : {

                return redirect()->route('checkout.step2');
            }
            case ShippingDataContract::STEP_COMPLETED : {

                // redirect user to the next step
                return redirect()->route('checkout.step3');
            }
        }
        return redirect()->route('checkout.auth');
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function processShippingDetails($data)
    {
        $result = $this->guestRepository->update($data, $this->cookieData->id);

        if (!$result) {

            $this->setStepStatus(ShippingDataContract::STEP_INCOMPLETE);

            return $this;
        }

        $this->setStepStatus(ShippingDataContract::STEP_COMPLETED);

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
     * @return mixed
     */
    public function verifyCurrentStep()
    {
        // TODO: Implement verifyCurrentStep() method.
    }
}