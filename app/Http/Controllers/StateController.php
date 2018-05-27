<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\State;

class StateController extends Controller
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
     * Show the list of bad words.
     * Admin Only
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String $filter
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $title = __('app.admin.state.list');
        
        $items = new State();
        
        $record = $request->get('record');
        if(!$record) $record = $this->pageSize;
        
        $q = $request->get('q');
        $q = trim($q);
        if($q){
            $items = $items->where('content', 'LIKE', '%'.$q.'%');
        }
        
        $items = $items->paginate($record);
        
        return view('admin.state.all')
            ->with('q', $q) 
            ->with('record', $record) 
            ->with('title', $title)
            ->with('items', $items); 
    }
    
    
    /**
     * Render form to create a badwords
     *
     * @param  Illuminate\Http\Request  $request
     * @return Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $state = new State();
        if($value = $request->old('content')) $state->content = $value;

        $action = route('admin.state.store');
        
        return view('admin.state.update')
            ->with('title', __('app.admin.state.create'))
            ->with('item', $state)
            ->with('action', $action);
    }

    /**
     * Store a blog
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

        $state = new State();
        $state->content = $request->content;
        $state->save();
        
        return back()->with('success',"L'Etat a été bien enregistré.");
    }

    /**
     * Render form to edit a state
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\State $state
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request, State $state)
    {
        if($value = $request->old('content')) $state->content = $value;

        $action = route('admin.state.update', ['state'=>$state]);
        
        return view('admin.state.update')
            ->with('title', __('app.admin.state.update'))
            ->with('item', $state)
            ->with('action', $action);
    }

    /**
     * Update $state
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\State $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        // Validate request
        $validator = Validator::make($request->all(),[
                            'content' => 'required',
                        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        $state->content = $request->content;
        $state->save();

        return back()->with('success',"L'Etat a été bien modifié.");
    }

    /**
    * Delete state
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\State $state
    * @return \Illuminate\Http\Response
    */
    public function delete(Request $request, State $state)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $state->delete();
        
        return redirect()->route('admin.dashboard')
            ->with('success',"L'Etat a été supprimé avec succés");
    }

}
