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
        $products = Product::orderBy('created_at','desc')->take(3)->get();
        $categories = Category::orderBy('created_at', 'desc')->take(5)->get();
        if($page = Page::where('path', '=', '/blogs*')->first()){
            $pubs = $page->pubs;
        }else{
            $pubs = [];
        }
        return view('index.index')
            ->with('pubs', $pubs)
            ->with('products', $products)
            ->with('categories', $categories);
    }

    /**
     * Show the service's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function services()
    {
        $products = Product::orderBy('created_at','desc')->take(3)->get();
        $categories = Category::orderBy('created_at', 'desc')->take(5)->get();
        if($page = Page::where('path', '=', '/blogs*')->first()){
            $pubs = $page->pubs;
        }else{
            $pubs = [];
        }
        return view('index.service')
            ->with('pubs', $pubs)
            ->with('products', $products)
            ->with('categories', $categories);
    }

    /**
     * Show the term and condition page.
     *
     * @return \Illuminate\Http\Response
     */
    public function terms()
    {
        $products = Product::orderBy('created_at','desc')->take(3)->get();
        $categories = Category::orderBy('created_at', 'desc')->take(5)->get();
        if($page = Page::where('path', '=', '/blogs*')->first()){
            $pubs = $page->pubs;
        }else{
            $pubs = [];
        }
        return view('index.service')
            ->with('pubs', $pubs)
            ->with('products', $products)
            ->with('categories', $categories);
    }

    /**
     * Show the help's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function help()
    {
        $products = Product::orderBy('created_at','desc')->take(3)->get();
        $categories = Category::orderBy('created_at', 'desc')->take(5)->get();
        if($page = Page::where('path', '=', '/blogs*')->first()){
            $pubs = $page->pubs;
        }else{
            $pubs = [];
        }
        return view('index.service')
            ->with('pubs', $pubs)
            ->with('products', $products)
            ->with('categories', $categories);
    }

    /**
     * Show the publicity's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function publicities()
    {
        $products = Product::orderBy('created_at','desc')->take(3)->get();
        $categories = Category::orderBy('created_at', 'desc')->take(5)->get();
        if($page = Page::where('path', '=', '/blogs*')->first()){
            $pubs = $page->pubs;
        }else{
            $pubs = [];
        }
        return view('index.publicities')
            ->with('pubs', $pubs)
            ->with('products', $products)
            ->with('categories', $categories);
    }

    /**
     * Show the confidentiality's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function confidentialities()
    {
        $products = Product::orderBy('created_at','desc')->take(3)->get();
        $categories = Category::orderBy('created_at', 'desc')->take(5)->get();
        if($page = Page::where('path', '=', '/blogs*')->first()){
            $pubs = $page->pubs;
        }else{
            $pubs = [];
        }
        return view('index.service')
            ->with('pubs', $pubs)
            ->with('products', $products)
            ->with('categories', $categories);
    }
}
