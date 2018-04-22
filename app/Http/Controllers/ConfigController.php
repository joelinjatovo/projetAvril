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
        $item = Config::findOrFail(1);
        $keys = [
                'identifiant' => 'required|max:100',
                'app_name' => 'required|max:100',
                'app_email' => 'required|max:100',
                'meta_title' => 'required|max:100',
                'latitude' => 'required|max:100',
                'longitude' => 'required|max:100',
            ];
        
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
        $item = Config::findOrFail(2);
        $keys = [
                'facebook' => 'max:100',
                'font_facebook' => 'max:100',
                'twitter' => 'max:100',
                'font_twitter' => 'max:100',
                'googleplus' => 'max:100',
                'font_googleplus' => 'max:100',
                'linkedin' => 'max:100',
                'font_linkedin' => 'max:100',
                'tumblr' => 'max:100',
                'font_tumblr' => 'max:100',
                'youtube' => 'max:100',
                'font_youtube' => 'max:100',
                'pinterest' => 'max:100',
                'font_pinterest' => 'max:100',
                'vimeo' => 'max:100',
                'font_vimeo' => 'max:100',
            ];
        $titles = [
                'facebook' => 'Facebook',
                'twitter' => 'Twitter',
                'googleplus' => 'Google+',
                'linkedin' => 'LinkedIn',
                'tumblr' => 'Tumblr',
                'youtube' => 'YouTube',
                'pinterest' => 'Pinterest',
                'vimeo' => 'Vimeo',
            ];
        
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
     * Show paiement config page.
     *
     * @return \Illuminate\Http\Response
     */
    public function paiement(Request $request)
    {
        $item = Config::findOrFail(1);
        $keys = [
                'percent_inscription_member' => 'required|max:100',
                'percent_inscription_seller' => 'required|max:100',
                'percent_inscription_afa' => 'required|max:100',
                'percent_inscription_apl' => 'required|max:100',
            
                'percent_reservation' => 'required|max:100',
            
                'percent_presentation_afa' => 'required|max:100',
                'percent_presentation_apl' => 'required|max:100',
            
                'disable_inscription_percent' => 'required|max:100',
                'trial_delay' => 'required|max:100',
            ];
        $titles = [
                'percent_inscription_member' => "Pourcentage d'inscription des membres",
                'percent_inscription_seller' => "Pourcentage d'inscription des vendeurs",
                'percent_inscription_afa' => "Pourcentage d'inscription des afa",
                'percent_inscription_apl' => "Pourcentage d'inscription des apl",
            
                'percent_reservation' => "Pourcentage de reservation de produit",
            
                'percent_presentation_afa' => "Pourcentage de presentation de produit pour les afa",
                'percent_presentation_apl' => "Pourcentage de presentation de produit pour les apl",
            
                'disable_inscription_percent' => "Desactiver le paiement de droit d'inscription",
                'trial_delay' => "Duree d'essaie",
            ];
        
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
        
        return view('config.paiement',compact('item', 'titles'));
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
