<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Product;
use App\Models\Page;
use App\Models\Pub;
use App\Models\Category;
use App\Models\Blog;

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
     * Show home page
     *
     * @param  Illuminate\Http\Request  $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->render($request, 1);
    }

    /**
     * Show home page
     *
     * @param  Illuminate\Http\Request  $request
     * @return Illuminate\Http\Response
     */
    public function apl(Request $request)
    {
        $apls = User::ofRole('apl')
            ->isActive()
            ->has('location')
            ->with('location')
            ->get();
        
        $data = [];
        foreach($apls as $item){
            $html = view('user.map')->with('item', $item)->render();
            $data[] = [
              'id' => $item->id,
              'lat' => $item->location?$item->location->latitude:0,
              'lng' => $item->location?$item->location->longitude:0,
              'title' => $item->name,
              'content' => $item->get_meta('orga_description')?$item->get_meta('orga_description')->value:'',
              'type' => $item->role,
              'html' => $html,
            ];
        }
        
    	return view('index.apl')
            ->with('items', $apls)
            ->with(['data' => json_encode($data)]);
    }

    /**
     * Show the service's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function services(Request $request)
    {
        return $this->render($request, 3);
    }

    /**
     * Show the publicity's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function publicities(Request $request)
    {
        return $this->render($request, 5);
    }

    /**
     * Show the term and condition page.
     *
     * @return \Illuminate\Http\Response
     */
    public function terms(Request $request)
    {
        return $this->render($request, 6);
    }

    /**
     * Show the guide's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function help(Request $request)
    {
        return $this->render($request, 8);
    }

    /**
     * Show the confidentiality's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function confidentialities(Request $request)
    {
        return $this->render($request, 7);
    }

    /**
     * Render page 
     *
     * @param Integer $id
     * @return \Illuminate\Http\Response
     */
    private function render(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $ctrl = new PageController();
        return $ctrl->index($request, $page);
    }
}
