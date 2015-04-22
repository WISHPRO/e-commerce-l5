<?php namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use App\Http\Requests;

class ReportsController extends Controller
{

    //

    public function index()
    {

        return view('backend.Reports.index');
    }

}
