<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
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
     * Show the blog page by slug.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        return view('blog.index');
    }

    /**
     * Show the list of blog.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        return view('blog.all');
    }
}
