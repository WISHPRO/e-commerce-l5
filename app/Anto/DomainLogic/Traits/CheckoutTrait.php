<?php namespace app\Anto\domainLogic\Traits;

trait CheckoutTrait
{

    protected $guestCookieName = 'g_c';

    protected $progressCookieName = 'c_p';

    protected $cookieExpiry = 120;

    public static function redirect_to_p_state()
    {
        $d = p_state();

        if ($d == false) {
            // The user was nowhere close to getting done
            return redirect()->route('checkout.step1');
        }
        // grab the step pos
        $step = array_get($d, 'step');

        $state = array_get($d, 'state');

        $data_state = array_get($d, 'progressData');

        // okay. The logic is that, we grab data from the checkout cookie, and use the data to determine the user's progress in checking out
        // The states are set in the checkout controller actions
        // so, if a user had completed a step, we redirect them to the next step
        // otherwise, we redirect them back to the step they were

        switch ($step) {
            case 1: {
                // step 1
                if ($state == 'complete') {
                    // redirect to step 2
                    return redirect()->route('checkout.step2')->with('data', $data_state);
                }

                return redirect()->route('');
            }
                break;
            case 2: {
                // step 2
                if ($state == 'complete') {
                    // redirect to step 2
                    return redirect()->route('checkout.step3');
                }

                return redirect()->route('checkout.step2');
            }
                break;
            case 3: {
                // step 3
                if ($state == 'complete') {
                    // redirect to step 4
                    return redirect()->route('checkout.step4');
                }

                return redirect()->route('checkout.step3');
            }
                break;
            case 4: {
                // step 4
                if ($state == 'complete') {
                    // the user had just completed the checkout process. HAHA
                    return redirect()->route('checkout.step4');
                }

                return redirect()->route('checkout.step3');
            }
                break;
            default: {
                // The user was nowhere close to getting done
                return redirect()->route('checkout.step1');
            }

        }
    }

    /**
     * @param $data
     *
     * @return \Symfony\Component\HttpFoundation\Cookie
     */
    public function makeProgressCookie($data)
    {
        return cookie($this->progressCookieName, $data, $this->cookieExpiry, '/');
    }

    /**
     * @param $gID
     *
     * @return \Symfony\Component\HttpFoundation\Cookie
     */
    public function makeGuestCookie($gID)
    {
        return cookie($this->guestCookieName, $gID, $this->cookieExpiry, '/');
    }
}