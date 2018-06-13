<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Plan;

use Validator;
use Auth;

class PlanController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    public function index()
    {
        return view('plan.index')
            ->with('items', Plan::where('role', Auth::user()->role)->get());
    }
    
    public function show(Plan $plan)
    {
        return view('plan.show')->with(['plan' => $plan]);
    }
    
    public function subscribe(Request $request)
    {
        try{
          $user = $request->user();
            
          // get the plan after submitting the form
          $plan = Plan::findOrFail($request->plan);

          // subscribe the user
          $user->newSubscription('main', $plan->name)
              ->create($request->payment_method_nonce);
        
          // Notify User
          $user->notify(new UserSubscribed($user, $plan));

          // redirect to home after a successful subscription
          return redirect()->route('profile')->with('success', 'Succesfull subscription');
            
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
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
        $title = __('app.admin.plan.list');
        
        $items = new Plan();
        
        $record = $request->get('record');
        if(!$record) $record = $this->pageSize;
        
        $q = $request->get('q');
        $q = trim($q);
        if($q){
            $items = $items->where('name', 'LIKE', '%'.$q.'%');
        }
        
        $items = $items->paginate($record);
        
        return view('admin.plan.all')
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
        $plan = new Plan();
        if($value = $request->old('name')) $plan->name = $value;
        if($value = $request->old('description')) $plan->description = $value;
        if($value = $request->old('cost')) $plan->cost = $value;
        if($value = $request->old('role')) $plan->role = $value;
        if($value = $request->old('type')) $plan->type = $value;

        $action = route('admin.plan.store');
        
        return view('admin.plan.update')
            ->with('title', __('app.admin.plan.create'))
            ->with('item', $plan)
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
                            'name' => 'required',
                            'description' => 'required',
                            'cost' => 'required',
                            'type' => 'required',
                            'role' => 'required',
                        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        $plan = new Plan();
        
        $slug = $slugOriginal = generateSlug($request->name);
        $i = 1;
        while(Plan::where('slug', $slug)->exists()){
            $slug = $slugOriginal + '-' + $i++;
        }
        
        $plan->slug = $slug;
        $plan->name = $request->name;
        $plan->description = $request->description;
        $plan->cost = $request->cost;
        $plan->type = $request->type;
        $plan->role = $request->role;
        $plan->save();
        
        return back()->with('success',"Le plan a été bien enregistré.");
    }

    /**
     * Render form to edit a plan
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\Plan $plan
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request, Plan $plan)
    {
        if($value = $request->old('name')) $plan->name = $value;
        if($value = $request->old('description')) $plan->description = $value;
        if($value = $request->old('cost')) $plan->cost = $value;
        if($value = $request->old('role')) $plan->role = $value;
        if($value = $request->old('type')) $plan->type = $value;

        $action = route('admin.plan.update', ['plan'=>$plan]);
        
        return view('admin.plan.update')
            ->with('title', __('app.admin.plan.update'))
            ->with('item', $plan)
            ->with('action', $action);
    }

    /**
     * Update BadWord $word
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plan $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        // Validate request
        $validator = Validator::make($request->all(),[
                            'name' => 'required',
                            'description' => 'required',
                            'cost' => 'required',
                            'type' => 'required',
                            'role' => 'required',
                        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        $slug = $slugOriginal = generateSlug($request->name);
        $i = 1;
        while(Plan::where('slug', $slug)->exists()){
            $slug = $slugOriginal + '-' + $i++;
        }
        
        $plan->slug = $slug;
        $plan->name = $request->name;
        $plan->description = $request->description;
        $plan->cost = $request->cost;
        $plan->type = $request->type;
        $plan->role = $request->role;
        $plan->save();

        return back()->with('success',"Le plan a été bien modifié.");
    }

    /**
    * Delete Bad Word
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Plan $plan
    * @return \Illuminate\Http\Response
    */
    public function delete(Request $request, Plan $plan)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $plan->delete();
        
        return redirect()->route('admin.dashboard')
            ->with('success',"Le plan a été supprimé avec succés");
    }
}
