<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
     * Show the dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('admin.--dashboard');
    }

    /**
     * Show the dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function chart($type)
    {
        switch($type){
            case "product":
                return view('admin.dashboard.index');
            case "user":
                return view('admin.dashboard.user');
            case "member":
                return view('admin.dashboard.member');
            case "afa":
                return view('admin.dashboard.afa');
            case "apl":
                return view('admin.dashboard.apl');
            case "seller":
                return view('admin.dashboard.seller');
            case "cart":
                return view('admin.dashboard.cart');
            default:
                abort(404);
                
        }
    }

    /**
     * Show the card config.
     *
     * @return \Illuminate\Http\Response
     */
    public function card()
    {
        return view('admin.card');
    }

}
