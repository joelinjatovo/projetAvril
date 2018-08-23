<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Auth;

use App\Notifications\UserSubscribed;

use App\Models\Plan;
use App\Models\User;

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
        return view('plan.show')->with('plan', $plan);
    }
    
    public function subscribe(Request $request)
    {
        // Validate request
        $datas = $request->all();
        $validator = Validator::make($datas,[
            'plan' => 'required|integer',
            'stripe_token' => 'required',
        ]);

        $user = $request->user();
            
        // get the plan after submitting the form
        $plan = Plan::findOrFail($request->plan);

        // subscribe the user
        try{
            $user->newSubscription('main', $plan->name)
                ->create($request->stripe_token);
        }catch(\Exception $e){
            //return back()->with('error', $e->getMessage());
        }
        
        // subscription_ends_at OR trial_ends_at
        if(!$user->subscription_ends_at){
            $date = \Carbon\Carbon::now();
        }else{
            $date = $user->subscription_ends_at;
        }
        $user->subscription_ends_at = $date->addDays($plan->getDayCount());

        // Notify User
        try{
            $user->notify(new UserSubscribed($user, $plan));
        }catch(\Exception $e){
        }
        
        // Notify Admin
        try{
            $adminId = option('site.admin', 1);
            $admin = User::find($adminId);
            if($admin){
                $admin->notify(new UserSubscribed($user, $plan));
            }
        }catch(\Exception $e){
        }

        // redirect to home after a successful subscription
        return redirect()->route('profile')
            ->with('success', 'Succesfull subscription');

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
        $plan = new Plan();
        if($value = $request->old('name')) $plan->name = $value;
        if($value = $request->old('description')) $plan->description = $value;
        if($value = $request->old('cost')) $plan->cost = $value;
        if($value = $request->old('role')) $plan->role = $value;
        if($value = $request->old('type')) $plan->type = $value;
        $action = route('admin.plan.store');
        
        return $this->_listAll($request)
            ->with('item', $plan)
            ->with('action', $action);
    }
    
    
    /**
     * Render form to create a badwords
     *
     * @param  Illuminate\Http\Request  $request
     * @return Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return $this->all($request);
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
        
        return $this->_listAll($request)
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

    /**
     * return view to show list of plan
     * Admin Only
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function _listAll(Request $request)
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
}
