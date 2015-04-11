<?php namespace app\Antony\DomainLogic\Modules\Checkout\AuthUser;

use app\Antony\DomainLogic\Modules\Checkout\Base\AuthUserCheckout;
use Illuminate\Http\Request;
use InvalidArgumentException;

class ShippingStep extends AuthUserCheckout
{

    /**
     * Step identifier
     *
     * @var int
     */
    const STEP_ID = 2;

    /**
     * Handle a redirect after a CRUD operation
     *
     * @param $request
     *
     * @return mixed
     */
    public function handleRedirect($request)
    {
        if(!$request instanceof Request){

            throw new InvalidArgumentException('You need to provide a request class to this method');
        }
        switch ($this->getStepStatus()) {

            case (static::STEP_COMPLETE): {

                if($request->ajax()){
                    return response()->json(['message' => 'You Successfully edited your shipping details']);
                } else {
                    flash('You Successfully edited your shipping details');
                    return redirect()->back();
                }

            }
            case (static::STEP_INCOMPLETE): {

                return redirect()->back()->withInput($request->all());
            }
            default: {

                return redirect()->back();
            }
        }

    }


    /**
     * @param $data
     *
     * @return $this
     */
    public function processCurrentStep($data)
    {
        $status = $this->users->edit($this->authenticatable->getAuthIdentifier(), $data);

        if ($status->getResult() === static::UPDATE_SUCCEEDED) {

            $this->createUserCheckoutCookie(static::STEP_ID, $this->authenticatable);

            $this->setStepStatus(static::STEP_COMPLETE);

            return $this;
        }

        $this->setStepStatus(static::STEP_INCOMPLETE);

        return $this;
    }
}