<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;

class PlanController extends Controller
{
    
    public function index()
    {
        return view('plan.index')->with(['items' => Plan::get()]);
    }
    
    public function show(Plan $plan)
    {
        return view('plan.show')->with(['plan' => $plan]);
    }
}
