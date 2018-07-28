<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;

use App\Notifications\NewOrder;
use App\Notifications\OrderPaid;

use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use App\Models\Page;
use App\Models\Pub;
use App\Models\User;
use App\Models\Image;

use Validator;

class ImageController extends Controller
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
     * Show the list of product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String $category
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        
        $title = __('app.image.list');
        
        $items = new Image();
        
        $record = $request->get('record');
        if(!$record) $record = $this->pageSize;
        
        $q = $request->get('q');
        $q = trim($q);
        if($q){
            $items = $items->where(function($query) use($q){
                return $query;
            });
        }
        $items = $items->paginate($record);
        
        return view('admin.image.all')
            ->with('q', $q) 
            ->with('record', $record) 
            ->with('title', $title)
            ->with('items', $items)
            ->with('breadcrumbs',$title); 
    }

    /**
     * Render form to edit a $postalcode
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\Image $image
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request, Image $image)
    {
        if($value = $request->old('filename')) $image->filename = $value;

        $action = route('admin.image.update', $image);
        
        return view('admin.image.update')
            ->with('title', __('app.image.update'))
            ->with('item', $image)
            ->with('action', $action);
    }

    /**
     * Update $postalcode
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        // Validate request
        $validator = Validator::make($request->all(),[
                            'filename' => 'required',
                        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        $image->filename = $request->filename;
        $image->save();

        return back()->with('success',"L'image a été bien modifié.");
    }

    /**
    * Delete PostalCode $postalcode
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Image $image
    * @return \Illuminate\Http\Response
    */
    public function delete(Request $request, Image $image)
    {
        
        $image->delete();
        
        return redirect()->route('admin.dashboard')
            ->with('success',"L'image a été supprimé avec succés");
    }
}
