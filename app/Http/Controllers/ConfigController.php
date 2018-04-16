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
        //$this->middleware('auth');
    }

    /**
     * Show site information config page.
     *
     * @return \Illuminate\Http\Response
     */
    public function site(Request $request)
    {
        $item = Config::findOrFail(1);
        $keys = ["identifiant", "app_name", "app_email", "meta_title", "latitude", "longitude"];
        
        if ($request->isMethod('post')) {
            
            // Validate request
            $datas = $request->all();
            $validator = Validator::make($datas,[
                            'identifiant' => 'required|max:100',
                            'app_name' => 'required|max:100',
                            'app_email' => 'required|max:100',
                            'meta_title' => 'required|max:100',
                            'latitude' => 'required|max:100',
                            'longitude' => 'required|max:100',
                        ]);
            
            // Check validation
            if ($validator->fails()) {
                return back()->withErrors($validator)
                            ->withInput();
            }
            
            // Save Config into MetaData
            foreach($keys as $key){
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
