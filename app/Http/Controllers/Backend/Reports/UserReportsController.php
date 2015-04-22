<?php namespace App\Http\Controllers\Backend\Reports;

use app\Antony\DomainLogic\Modules\User\Reports\UserReports;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

class UserReportsController extends Controller
{

    /**
     * @var UserReports
     */
    private $users;


    /**
     * @param UserReports $users
     */
    public function __construct(UserReports $users)
    {


        $this->users = $users;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.Reports.Users.index');
    }

    /**
     * @param Request $request
     */
    public function getUsersByCounty(Request $request)
    {

        if ($request->ajax()) {
            return $this->users->getUsersByCounty();
        }
        return view('backend.Reports.Users.users');
    }

    /**
     * @param Request $request
     */
    public function getUserOrders(Request $request)
    {

        $this->users->getUsersByCounty();
    }
}
