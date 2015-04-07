<?php namespace App\Http\Controllers\Shared;

use app\Antony\DomainLogic\Modules\Accounts\Base\AccountsRepository;
use App\Http\Controllers\Controller;
use App\Http\Request\Accounts\updateShippingInfo;
use App\Http\Requests\Accounts\addMoreAccountInfo;
use App\Http\Requests\Accounts\ContactInfo;
use App\Http\Requests\Accounts\updatePasswordRequest;
use App\Http\Requests\User\CreateUserAccountRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * @var AccountsRepository
     */
    private $accounts;

    /**
     * @param AccountsRepository $accounts
     * @param Request $request
     */
    public function __construct(AccountsRepository $accounts, Request $request)
    {
        $this->accounts = $accounts;

        $this->accounts->backend = $request->segment(1) === 'backend' ? true : false;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = $this->accounts->getUserData();

        if ($this->accounts->backend) {

            return view('backend.Account.index', compact('user'));
        }
        return view('shared.Account.index', compact('user'));

    }

    /**
     * @param ContactInfo $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function patchContacts(ContactInfo $request)
    {
        return $this->accounts->updateContactInformation($request->except('_token'))->handleRedirect($request);
    }


    /**
     * @param updatePasswordRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function patchPassword(updatePasswordRequest $request)
    {
        return $this->accounts->updatePassword($request->get('password'), $request->has('logMeOut'))->handleRedirect($request);
    }

    public function patchShipping(updateShippingInfo $request)
    {

    }

    /**
     * @return \Illuminate\View\View
     */
    public function getDelete()
    {
        if ($this->accounts->backend) {
            return view('backend.Account.delete');
        }
        return view('shared.Account.delete');
    }

    /**
     * @param CreateUserAccountRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function patchAccount(CreateUserAccountRequest $request)
    {
        return $this->accounts->updateAllData($request->except('_token'))->handleRedirect($request);
    }

    /**
     * @param addMoreAccountInfo $addMoreAccountInfo
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function patchAccountAddingMoreDetails(addMoreAccountInfo $addMoreAccountInfo)
    {
        return $this->accounts->updateAllData($addMoreAccountInfo->except('_token'))->handleRedirect($addMoreAccountInfo);
    }

    /**
     * Deletes an account. Not actually though, since our users model implements the soft deletes trait
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteAccount(Request $request)
    {
        return $this->accounts->deleteAccount()->handleRedirect($request);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy(Request $request)
    {
        return $this->accounts->deleteAccount(true)->handleRedirect($request);
    }

}