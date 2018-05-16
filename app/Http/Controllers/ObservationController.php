<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Models\User;
use App\Models\Observation;

class ObservationController extends Controller
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
     * Render form to create a observation
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\User  $user
     * @return Illuminate\Http\Response
     */
    public function create(Request $request, User $user)
    {
        $item = new Observation();
        if($value = $request->old('content'))   $item->content = $value;

        $action = route('admin.observation.store');
        
        return view('admin.observation.update', ['item'=>$item, 'action'=>$action]);
    }

    /**
     * Store a observation
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\User  $user
     * @return Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        // Validate request
        $datas = $request->all();
        $validator = Validator::make($datas,['content' => 'required']);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        $model = new Observation();
        $model->content = $request->content;
        $model->user_id = $user->id;
        $model->save();

        return back()->with('success',"L'observation a été bien enregistrée.");
    }

    /**
     * Render form to edit a observation
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\Observation  $observation
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request, Observation  $observation)
    {
        if($value = $request->old('content'))   $item->content = $value;
        
        $action = route('admin.observation.update', ['observation'=>$observation]);
        
        return view('admin.observation.update', ['item'=>$observation, 'action'=>$action]);
    }

    /**
     * Update category
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Observation  $observation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Observation  $observation)
    {
        // Validate request
        $validator = Validator::make($request->all(),['content' => 'required']);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        $observation->content = $request->content;
        $observation->save();
        
        return back()->with('success',"L'observation a été bien modifié.");
    }

}