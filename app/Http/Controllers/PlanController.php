<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;

class PlanController extends Controller
{
    
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
          // get the plan after submitting the form
          $plan = Plan::findOrFail($request->plan);

          // subscribe the user
          $request->user()->newSubscription('main', $plan->braintree_plan)
              ->create($request->payment_method_nonce);
        
          // Notify User
          $user->notify(new UserSubscribed($user, $plan));

          // redirect to home after a successful subscription
          return redirect('/');
    }
}
