<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Product;
use App\Models\Page;
use App\Models\Pub;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Type;
use App\Models\State;

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
        $types = Type::orderBy('title', 'asc')
            ->where('object_type', 'type')
            ->withCount('products')
            ->get();
        
        $locationTypes = Type::orderBy('title', 'asc')
            ->where('object_type', 'location')
            ->withCount('products')
            ->get();
        
        $states = State::orderBy('content', 'asc')
            ->withCount('products')
            ->get();
        
        return $this->render($request, '/')
            ->with('states',$states)
            ->with('locationTypes',$locationTypes)
            ->with('types',$types);
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
        return $this->render($request, '/services');
    }

    /**
     * Show the publicity's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function publicities(Request $request)
    {
        return $this->render($request, '/pubs');
    }

    /**
     * Show the term and condition page.
     *
     * @return \Illuminate\Http\Response
     */
    public function terms(Request $request)
    {
        return $this->render($request, '/terms');
    }

    /**
     * Show the guide's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function help(Request $request)
    {
        return $this->render($request, '/help');
    }

    /**
     * Show the confidentiality's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function confidentialities(Request $request)
    {
        return $this->render($request, '/confidentialities');
    }

    /**
     * Render page 
     *
     * @param Integer $id
     * @return \Illuminate\Http\Response
     */
    private function render(Request $request, $path)
    {
        $page = Page::where('path', $path)->where('parent_id', 0)->first();
        if(!$page){
            abort(404);
        }
        $ctrl = new PageController();
        return $ctrl->index($request, $page);
    }
}
