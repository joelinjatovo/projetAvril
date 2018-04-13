<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class ConfigController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show site information config page.
     *
     * @return \Illuminate\Http\Response
     */
    public function site(Request $request)
    {
        if (!$request->isMethod('post')) {
            $datas = [
                'identifiant' => 'admin@iea.com', //Auth::user()->email,
                'nomSite' => param('nom'),
                'titre' => param('titre'),
                'email' => param('email'), 
                'latitude' => param('latitude'),
                'longitude' =>  param('longitude')
                ];
            $donnees = json_decode(json_encode($datas),false);
            return view('config.site',compact('donnees'));
        }
        
        // Request is POST
        $compteur = false;
        $inputs = $request->input();
        unset($inputs['_token']);
        $configs = param();
        foreach ($inputs as $key => $value) {
            foreach ($configs['app'] as $cle => $valeur) {
                if( $key == $cle )
                    if( $value != $valeur){
                        $compteur = true;
                        param($key,$value);
                    }
            }
        }
        if( $compteur )
            return back()->with('success','La configuration a été modifiée avec succés ! ');
        else
            return back()->with('error','Aucune modification n\'a été enregistrée ! ');
    }

    /**
     * Show social config page.
     *
     * @return \Illuminate\Http\Response
     */
    public function social(Request $request)
    {
        if (!$request->isMethod('post')) {
            return view('config.social');
        }
        
        // Request is POST
    	$updates = $request->input();
    	unset($updates['_token']);
    	$compteur = false;
    	foreach ($updates as $key => $value) {
    		$cles = explode('-',$key);
    		if( !isset($cles[1])){
    			$compteur = true;
    			$indice = $key . '.value';
                if( preg_match('@^(?:https://)@i',$value) == 1 )
                    $new_value = $value;
                if( $value == "#" || is_null($value))
                    $new_value = "#";
                elseif( preg_match('@^(?:https://)@i',$value) == 0 )
                    $new_value = "https://" . $value;
                
            social($indice,$new_value);
    		}
    		elseif( isset($cles[1]) ){
    			$compteur = true;
    			$indice = $cles[1] . '.font';
    			social($indice,$value);
    		}
    	}
    	if( $compteur )
    		return back()->with('success','Les modifications ont bien étée enregistrées !');
    	else
    		return back()->with('error','Aucune modification n\'a été enregistrée !');
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
