<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\BadWord;

class BadWordController extends Controller
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
        $items = BadWord::paginate($this->pageSize);
        return view('admin.badword.all')
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
        $badword = new BadWord();
        if($value = $request->old('content')) $badword->content = $value;

        $action = route('admin.badword.store');
        
        return view('admin.badword.update')
            ->with('title', __('app.badword.create'))
            ->with('item', $badword)
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

        $badword = new BadWord();
        $badword->content = $request->content;
        $badword->save();
        
        return back()->with('success',"Le mot a été bien enregistré.");
    }

    /**
     * Render form to edit a blog
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\BadWord $word
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request, BadWord $badword)
    {
        if($value = $request->old('content')) $badword->content = $value;

        $action = route('admin.badword.update', ['badword'=>$badword]);
        
        return view('admin.badword.update')
            ->with('title', __('app.badword.update'))
            ->with('item', $badword)
            ->with('action', $action);
    }

    /**
     * Update BadWord $word
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BadWord $word
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BadWord $badword)
    {
        // Validate request
        $validator = Validator::make($request->all(),[
                            'content' => 'required',
                        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        $badword->content = $request->content;
        $badword->save();

        return back()->with('success',"Le mot a été bien modifié.");
    }

    /**
    * Delete Bad Word
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\BadWord $word
    * @return \Illuminate\Http\Response
    */
    public function delete(Request $request, BadWord $badword)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $badword->delete();
        
        return redirect()->route('admin.dashboard')
            ->with('success',"Le mot a été supprimé avec succés");
    }

}
