<?php namespace app\Http\Controllers\Backend;

use app\Anto\DomainLogic\repositories\Counties\CountiesRepository;
use app\Anto\DomainLogic\repositories\Product\ProductRepository;
use app\Anto\DomainLogic\repositories\Security\RolesRepository;
use app\Anto\DomainLogic\repositories\User\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Response;

class StatisticsController extends Controller
{

    protected $user;

    protected $product;

    protected $orders;

    protected $sales;

    protected $roles;

    protected $counties;

    /**
     * @param UserRepository $userRepository
     * @param ProductRepository $productRepository
     * @param RolesRepository $rolesRepository
     * @param CountiesRepository $countiesRepository
     */
    public function __construct(UserRepository $userRepository, ProductRepository $productRepository, RolesRepository $rolesRepository, CountiesRepository $countiesRepository)
    {

        $this->user = $userRepository;

        $this->product = $productRepository;

        $this->roles = $rolesRepository;

        $this->counties = $countiesRepository;
    }

    /**
     * Statistics landing page
     *
     * @return Response
     */
    public function index()
    {
        return view('backend.Statistics.index');
    }

    /**
     * Display site user statistics
     *
     * @return Response
     */
    public function getUserStatistics()
    {
        $data = $this->user->with(['county'])->get()->count();

        // count the users in a county
        $c = $this->counties->with(['users'])->get()->count();


        return view('backend.Statistics.users', compact('data'));
    }

    /**
     * Display system security statistics
     *
     * @return Response
     */
    public function getSecurityStatistics()
    {
        //
    }

    /**
     * Display product inventory statistics
     *
     * @return Response
     */
    public function getInventoryStatistics()
    {
        //
    }

    /**
     * Display product order statistics
     *
     * @return Response
     */
    public function getOrderStatistics()
    {
        //
    }

    /**
     * Display product sales statistics
     *
     * @return Response
     */
    public function getSalesStatistics()
    {
        //
    }

    /**
     * Display county statistics
     *
     * @return Response
     */
    public function getCountyStatistics()
    {
        //
    }
}
