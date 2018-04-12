<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index.index');
    }

    /**
     * Show the service's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function service()
    {
        return view('index.service');
    }

    /**
     * Show the term and condition page.
     *
     * @return \Illuminate\Http\Response
     */
    public function terms()
    {
        return view('index.service');
    }

    /**
     * Show the help's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function help()
    {
        return view('index.service');
    }

    /**
     * Show the publicity's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function publicities()
    {
        return view('index.service');
    }

    /**
     * Show the confidentiality's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function confidentialities()
    {
        return view('index.service');
    }
}
