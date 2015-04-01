<?php namespace App\Http\Controllers\Frontend;

use Illuminate\Routing\Controller;

class HomeController extends Controller
{


    /**
     * Shows the site homepage
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.index');
    }

}
