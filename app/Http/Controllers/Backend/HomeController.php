<?php namespace app\Http\Controllers\Backend;

use App\Http\Controllers\Controller;


class HomeController extends Controller
{

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.index');
    }

}