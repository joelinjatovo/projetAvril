<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;

use App\Models\User;
use App\Models\Config;

class ConfigController extends Controller
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
     * Show site information config page.
     *
     * @return \Illuminate\Http\Response
     */
    public function site(Request $request)
    {
        $item = Config::site();
        $keys = Config::siteRules();
        
        if ($request->isMethod('post')) {
            
            // Validate request
            $datas = $request->all();
            $validator = Validator::make($datas, $keys);
            
            // Check validation
            if ($validator->fails()) {
                return back()->withErrors($validator)
                            ->withInput();
            }
            
            // Save Config into MetaData By Validator rules key
            foreach($keys as $key=>$val){
                if($value = $request->input($key)) $item->update_meta($key, $value);
            }
            
            // Go back with notification
            return back()->with('success','La configuration a été modifiée avec succés ! ');
        }
        
        return view('config.site',compact('item', 'keys'));
    }

    /**
     * Show social config page.
     *
     * @return \Illuminate\Http\Response
     */
    public function social(Request $request)
    {
        $item = Config::social();
        $keys = Config::socialRules();
        $titles = Config::socialTitles();
        
        if ($request->isMethod('post')) {
            // Validate request
            $datas = $request->all();
            $validator = Validator::make($datas, $keys);
            
            // Check validation
            if ($validator->fails()) {
                return back()->withErrors($validator)
                            ->withInput();
            }
            
            // Save Config into MetaData By Validator rules key
            foreach($keys as $key=>$val){
                if($value = $request->input($key)) $item->update_meta($key, $value);
            }
            
            // Go back with notification
            return back()->with('success','La configuration a été modifiée avec succés ! ');
        }
        
        return view('config.social',compact('item', 'keys', 'titles'));
    }

    /**
     * Show payment config page.
     *
     * @return \Illuminate\Http\Response
     */
    public function payment(Request $request)
    {
        $item = Config::payment();
        $keys = Config::paymentRules();
        
        if ($request->isMethod('post')) {
            
            // Validate request
            $datas = $request->all();
            $validator = Validator::make($datas, $keys);
            
            // Check validation
            if ($validator->fails()) {
                return back()->withErrors($validator)
                            ->withInput();
            }
            
            // Save Config into MetaData By Validator rules key
            foreach($keys as $key=>$val){
                $value = $request->input($key)?$request->input($key):0;
                $item->update_meta($key, $value);
            }
            
            // Go back with notification
            return back()->with('success','La configuration a été modifiée avec succés ! ');
        }
        
        return view('config.payment',compact('item', 'keys'));
    }
    
    
    /**
    * Search FontAwesome
    * @param string $d , string $q, string $m
    * @return Redirection 
    */
    public function fontawesome(Request $request)
    {
        $query = $request->input('query');

        if( !empty($query))
            $link = "https://fontawesome.com/icons?d=gallery&q=".rawurlencode($query)."&m=free";
        else
            $link = "https://fontawesome.com/icons?d=gallery&m=free";
        
        return redirect()->away($link);
    }


}
