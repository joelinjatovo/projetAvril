<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\PostalCode;

class PostalCodeController extends Controller
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
     * Show the list of PostalCode
     * Admin Only
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String $filter
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $items = PostalCode::paginate($this->pageSize);
        return view('admin.state.all')
            ->with('items', $items); 
    }
    
    
    /**
     * Render form to create a PostalCode
     *
     * @param  Illuminate\Http\Request  $request
     * @return Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $postalcode = new PostalCode();
        if($value = $request->old('content')) $postalcode->content = $value;

        $action = route('admin.postalcode.store');
        
        return view('admin.postalcode.update')
            ->with('title', __('app.postalcode.create'))
            ->with('item', $postalcode)
            ->with('action', $action);
    }

    /**
     * Store a postalcode
     *
     * @param  Illuminate\Http\Request  $request
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate request
        $datas = $request->all();
        $validator = Validator::make($datas,[
                            'content' => 'required',
                        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        $postalcode = new PostalCode();
        $postalcode->content = $postalcode->content;
        $postalcode->save();
        
        return back()->with('success',"Le code postal a été bien enregistré.");
    }

    /**
     * Render form to edit a $postalcode
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\PostalCode $postalcode
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request, PostalCode $postalcode)
    {
        if($value = $request->old('content')) $state->content = $value;

        $action = route('admin.postalcode.update', ['state'=>$state]);
        
        return view('admin.postalcode.update')
            ->with('title', __('app.postalcode.update'))
            ->with('item', $postalcode)
            ->with('action', $action);
    }

    /**
     * Update $postalcode
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostalCode $postalcode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostalCode $postalcode)
    {
        // Validate request
        $validator = Validator::make($request->all(),[
                            'content' => 'required',
                        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        $postalcode->content = $postalcode->content;
        $postalcode->save();

        return back()->with('success',"Le code postal a été bien modifié.");
    }

    /**
    * Delete PostalCode $postalcode
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\PostalCode $postalcode
    * @return \Illuminate\Http\Response
    */
    public function delete(Request $request, PostalCode $postalcode)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $postalcode->delete();
        
        return redirect()->route('admin.dashboard')
            ->with('success',"Le code postal a été supprimé avec succés");
    }

}
