<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Page;
use App\Models\Pub;
use App\Models\Category;

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
        $products = Product::orderBy('created_at','desc')->paginate(3);
        $page = Page::where('path', '=', '/')->first();
        $categories = Category::orderBy('created_at', 'desc')->paginate(5);
        $pubs = Pub::orderBy('created_at', 'desc')->paginate(5);
        return view('index.index')
            ->with('pubs', $pubs)
            ->with('products', $products)
            ->with('categories', $categories);
            //->with('pubs', $page->pubs);
    }

    /**
     * Show the service's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function services()
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
