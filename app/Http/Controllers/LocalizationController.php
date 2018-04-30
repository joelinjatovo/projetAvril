<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Session;

class LocalizationController extends Controller
{
    /**
     * Change locale variable in Session and go back
     *
     * @return \Illuminate\Http\Response
     */
    public function index($locale)
    {
        Session::put('locale',$locale);
        Session::save();
        return back()->with('success', 'Langue modifié');
    }

}
