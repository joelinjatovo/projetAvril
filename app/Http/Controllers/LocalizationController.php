<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    /**
     * Change locale variable in Session and go back
     *
     * @return \Illuminate\Http\Response
     */
    public function index($locale)
    {
        return view('index.index');
    }

}
