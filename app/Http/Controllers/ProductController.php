<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\Product;
use App\Models\Category;
use App\Models\ObjectCategory;
use App\Models\Image;
use App\Models\Page;
use App\Models\Pub;
use App\Models\User;
use App\Models\State;
use App\Models\Type;

class ProductController extends Controller
{
    /**
     * Show the row product at the front.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Product $product)
    {
        if(!$product->isDisponible()){
            return view('product.unavailable');
        }
        
        $product->view_count++;
        $product->save();
        
        $products = Product::orderBy('created_at','desc')
            ->ofStatus('published')
            ->take($this->recentSize)
            ->get();
        
        $categories = Category::orderBy('created_at', 'desc')
            ->has('products')
            ->withCount('products')
            ->take($this->recentSize)
            ->get();
        
        $page = Page::where('path', '=', '/products*')
            ->first();
        
        if($page){$pubs = $page->pubs;}else{$pubs = [];}
        
        $apls = User::ofRole('apl')->isActive()->get();
        
        $data = [
              'id' => $product->id,
              'lat' => $product->location?$product->location->latitude:0,
              'lng' => $product->location?$product->location->longitude:0,
              'title' => $product->title,
              'area' => $product->area,
              'type' => 'product',
            ];
        
        $product->load('images');
        
        $types = Type::orderBy('title', 'asc')
            ->where('object_type', 'type')
            ->get();
        
        $locationTypes = Type::orderBy('title', 'asc')
            ->where('object_type', 'location')
            ->get();
        
        $states = State::orderBy('content', 'asc')
            ->get();
        
        return view('product.index')
            ->with('item', $product)
            ->with('location', $product->location)
            ->with('pubs', $pubs)
            ->with('products', $products)
            ->with('apls', $apls)
            ->with('data', json_encode($data))
            ->with('states', $states)
            ->with('locationTypes', $locationTypes)
            ->with('types', $types)
            ->with('categories', $categories); 
    }
    
    /**
     * Show the row product at the back.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Product $product)
    {
        $this->middleware('auth');
        if(\Auth::user()->hasRole('admin')){
            return view('admin.product.index')
                ->with('item', $product)
                ->with('breadcrumbs', __('app.product'));
        }
        
        if(\Auth::user()->hasRole('seller') && ($product->seller_id == \Auth::user()->id)){
            return view('seller.product.index')
                ->with('item', $product)
                ->with('breadcrumbs', __('app.product'));
        }
        
        abort(403);
        
    }

    /**
     * Render form to create a product
     *
     * @param  Illuminate\Http\Request  $request
     * @return Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');

        $product = new Product();
        if($value = $request->old('title'))             $product->title = $value;
        if($value = $request->old('content'))           $product->content = $value;
        if($value = $request->old('is_new'))            $product->is_new = $value;
        if($value = $request->old('display_address'))   $product->is_new = $value;
        if($value = $request->old('year_built'))        $product->year_built = $value;
        if($value = $request->old('price'))             $product->price = $value;
        if($value = $request->old('currency'))          $product->currency = $value;
        if($value = $request->old('tma'))               $product->tma = $value;
        if($value = $request->old('type_id'))           $product->type_id = $value;
        if($value = $request->old('location_type_id'))  $product->location_type_id = $value;
        if($value = $request->old('postalCode'))        $product->postalCode = $value;
        if($value = $request->old('state_id'))          $product->state_id = $value;
        if($value = $request->old('location_id'))       $product->location_id = $value;
        
        if($value = $request->old('area'))              $product->area = $value;
        if($value = $request->old('carport_spaces'))    $product->carport_spaces = $value;
        if($value = $request->old('garage_spaces'))     $product->garage_spaces = $value;
        if($value = $request->old('off_street_spaces')) $product->off_street_spaces = $value;
        if($value = $request->old('bathrooms'))         $product->bathrooms = $value;
        if($value = $request->old('bedrooms'))          $product->bedrooms = $value;
        if($value = $request->old('ensuite'))           $product->ensuite = $value;
        if($value = $request->old('toillet'))           $product->toillet = $value;
        if($value = $request->old('land_area'))         $product->land_area = $value;
        if($value = $request->old('floor_area'))        $product->floor_area = $value;
        if($value = $request->old('number_of_floors'))  $product->number_of_floors = $value;
        if($value = $request->old('new_construction'))  $product->new_construction = $value;

        $action = route('admin.product.store');
        
        return view('admin.product.update')
            ->with('title', __('admin.product.create'))
            ->with('item', $product)
            ->with('action', $action)
            ->with('states', State::get())
            ->with('types', Type::where("object_type", "type")->get())
            ->with('location_types', Type::where("object_type", "location")->get())
            ->with('breadcrumbs', __('app.product.create'));
    }

    /**
     * Store a product
     *
     * @param  Illuminate\Http\Request  $request
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        return back()->with('success',"L'article a été bien enregistré.");
    }
    
    /**
     * Show the list of product.
     * Admin Only
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String $filter
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request, $filter='all')
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $categories = Category::orderBy('created_at', 'desc')
            ->has('products')
            ->withCount('products')
            ->get();
        
        $page = $request->get('page');
        if(!$page) $page = 1;
        
        $record = $request->get('record');
        if(!$record) $record = $this->pageSize;
        
        $items = new Product();
        
        switch($filter){
            case 'ordered':
            case 'paid':
            case 'published':
            case 'pinged':
            case 'archived':
            case 'trashed':
                $items = $items->ofStatus($filter);
                $title = __('app.product.list.status', ['status'=>__('app.'.$filter)]);
                break;
            default:
            case 'all':
                $title = __('app.product.list');
                break;
        }
        
        $category = $request->get('category');
        $category = intval($category);
        if($category){
            $items = $items->where('category_id', $category);
        }
        
        $q = $request->get('q');
        $q = trim($q);
        if($q){
            $items = $items->where(function($query) use($q){
                return $query->orWhere('title', 'LIKE', '%'.$q.'%')
                    ->orWhere('content', 'LIKE', '%'.$q.'%');
            });
        }
        
        $states = State::all();
        $state = $request->get('state');
        $state = intval($state);
        if($state){
            $items = $items->where('state_id', $state);
        }
        
        $sellers = User::ofRole('seller')->isActive()->get();
        $seller = $request->get('seller');
        $seller = intval($seller);
        if($seller){
            $items = $items->where('seller_id', $seller);
        }
        
        $items = $items->paginate($record);
        
        return view('admin.product.all', compact('items', 'filter', 'page'))
            ->with('q', $q) 
            ->with('record', $record) 
            ->with('category', $category) 
            ->with('categories', $categories) 
            ->with('state', $state)
            ->with('states', $states)
            ->with('seller', $seller)
            ->with('sellers', $sellers)
            ->with('title', $title)
            ->with('breadcrumbs', $title);
    }
    
    /**
    * Handle action Produt
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function action(Request $request)
    {
        $this->middleware('auth');
        
        // Validate request
        $this->validate($request, [
            'action' => 'required|max:10',
            'data_id'   => 'required|numeric'
        ]);
        
        $product = Product::findOrFail($request->data_id);
        
        if(!\Auth::user()->hasRole('admin') && ($product->seller_id != \Auth::user()->id)){
            abort(403);
        }
        
        switch($product->status){
            case 'ordered':
                $msg = "Ce produit est en cours de vente.";
                if($request->ajax()){
                    return response()->json([
                        'status'  => 0,
                        'message' => $msg
                    ]);
                }
                return redirect()->route('admin.dashboard')
                    ->with('success',$msg);
            break;
            case 'paid':
                $msg = "Ce produit est déjà vendu.";
                if($request->ajax()){
                    return response()->json([
                        'status'  => 0,
                        'message' => $msg
                    ]);
                }
                return redirect()->route('admin.dashboard')
                    ->with('success',$msg);
            break;
        }
        
        $action = $request->action;
        
        switch($action){
            case 'archive':
                $product->status = 'archived';
                $product->save();
                $message = "Le produit a été achivé avec succés";
            break;
            case 'publish':
                $product->status = 'published';
                $product->save();
                $message = "Le produit a été publié avec succés";
            break;
            case 'delete':
                $product->delete();
                $message = "Le produit a été supprimé avec succés";
            break;
            default:
                abort(404);
            break;
        }
        
        if($request->ajax()){
            return response()->json([
                'status'=>1,
                'message'=>$message
            ]);
        }
        
        return redirect()->route('admin.dashboard')
            ->with('success',"Le produit a été supprimé avec succés");
    }

}
