<?php namespace App\Http\Controllers\Backend;

use app\Anto\DomainLogic\repositories\User\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Contracts\Auth\Guard;
use Response;

class AccountController extends Controller
{

    protected $user;

    protected $auth;

    public function __construct(UserRepository $userRepository, Guard $guard)
    {
        $this->user = $userRepository;

        $this->auth = $guard;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = $this->user->find($this->auth->user()->id);

        return view('backend.Account.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
