<?php

use App\Http\Controllers\Controller;


class BackendController extends Controller
{

    public function index()
    {
        return view('backend.index');
    }

}