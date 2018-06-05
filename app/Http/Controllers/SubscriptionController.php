<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Notifications\UserSubscribed;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        try{
          $user = $request->user();
            
          //Stripe
          $user->newSubscription('grape shop', 'grape-shop')->create($request->stripe_token);
            
            /* Baintree
          // get the plan after submitting the form
          $plan = Plan::findOrFail($request->plan);

          // subscribe the user
          $user->newSubscription('main', $plan->braintree_plan)
              ->create($request->payment_method_nonce);
        
            */
            
          // Notify User
          $user->notify(new UserSubscribed($user, $plan));

            
          // redirect to home after a successful subscription
          return redirect()->route('subscription.success');
            
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }
    
    public function success()
    {
        return view('subscription.success');
    }
}
