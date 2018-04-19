<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;
use Event;

use App\Events\UserRegistered;

use App\Models\User;
use App\Models\Localization;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    
    /**
     * Show form registration switch $role
     *
     * @param  Illuminate\Http\Request  $request
     * @param  String $role
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $role)
    {
        $action = route('register',['role'=>$role]);
        switch($role){
            case "member":
                $pays = $this->getPaysFromCsv();
                $tels = $this->getTelsFromCsv();
                return view('login.'.$role, ["pays"=>$pays , "tels"=>$tels, "action"=>$action]);
            break;
            case "apl":
                $request->session()->put("step", "condition");
                return view('login.condition.apl');
            break;
            case "afa":
                $request->session()->put("step", "condition");
                return view('login.condition.apl');
            break;
            case "seller":
                return view('login.'.$role);
            break;
        }
    }
    
    /**
     * Store user information into database
     *
     * @param  Illuminate\Http\Request  $request
     * @param  String $role
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request, $role)
    {
        switch($role){
            case "member":
                return $this->registerMember($request);
            break;
            case "apl":
                if($request->session()->get("step") == "condition"){
                    $request->session()->put("step", "register");
                    $pays = $this->getPaysFromCsv();
                    $action = route('register',['role'=>'apl']);
                    return view('login.apl', ["pays"=>$pays , "action"=>$action]);
                }elseif($request->session()->get("step") == "register"){
                    $request->session()->put("step", "");
                    return $this->registerApl($request);
                }else{
                    return redirect()->route('register',['role'=>'apl']);
                }
            break;
            case "afa":
                if($request->session()->get("step") == "condition"){
                    $request->session()->put("step", "register");
                    $pays = $this->getPaysFromCsv();
                    $action = route('register',['role'=>'afa']);
                    return view('login.afa', ["pays"=>$pays , "action"=>$action]);
                }elseif($request->session()->get("step") == "register"){
                    $request->session()->put("step", "");
                    return $this->registerAfa($request);
                }else{
                    return redirect()->route('register',['role'=>'afa']);
                }
            break;
            case "seller":
                if($request->session()->get("step") == "condition"){
                    $request->session()->put("step", "register");
                    $pays = $this->getPaysFromCsv();
                    $action = route('register',['role'=>'seller']);
                    return view('login.seller', ["pays"=>$pays , "action"=>$action]);
                }elseif($request->session()->get("step") == "register"){
                    $request->session()->put("step", "");
                    return $this->registerSeller($request);
                }else{
                    return redirect()->route('register',['role'=>'seller']);
                }
            break;
        }
    }

    /*
    * Store Seller information into database
    * Go back after saving data
    *
    * @param  Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    private function registerSeller(Request $request)
    {
        $rules = [
            'name' => 'required|unique:users,name|max:100',
            'email' => 'required|unique:users,email|max:100',
            'orga_name' => 'required|max:100',
            'orga_presentation' => 'required|max:100',
            'address' => 'required|max:100',
            'city' => 'required|max:100',
            'country' => 'required|max:100',
            'state' => 'required|max:100',
            'postalCode' => 'required|max:100',
            'language' => 'required|max:100',
            'prefixPhone' => 'required|max:100',
            'phone' => 'required|max:100',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        
        // Validate request
        $validator = Validator::make($datas, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        $password = '1111';
        $datas['password'] = bcrypt($password);
        $datas['status'] = 'pinged';
        $datas['role'] = 'apl';
        $datas['type'] = 'organization';
        
        // Create Localization
        $location = Localization::create($datas);
        $datas['location_id'] = $location->id;
        
        // Create user
        $user = User::create($datas);
        
        // Update MetaData
        if($value = $request->input('orga_name')) $user->update_meta("orga_name", $value);
        if($value = $request->input('orga_presentation')) $user->update_meta("orga_presentation", $value);
        if($value = $request->input('prefixPhone')) $user->update_meta("prefixPhone", $value);
        if($value = $request->input('phone')) $user->update_meta("phone", $value);
        
        // Common datas
        if($value = $request->input('language')) $user->update_meta("language", $value);
        if($value = $request->input('newsletter')) $user->update_meta("newsletter", $value);
        if($value = $request->input('allow_sharing')) $user->update_meta("allow_sharing", $value);
                
        // Store image file
        if($user && $file=$request->file('image')){
            $image = $file->store('uploads');
            $user->update_meta("image", $image);
        }
        
        //firing an event
        Event::fire(new UserRegistered($user));
        
        // Success
        return back()->with('success',"L'utilisateur a été bien enregistré.");
    }

    /*
    * Store AFA information into database
    * Go back after saving data
    *
    * @param  Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    private function registerAfa(Request $request)
    {  
        $rules = [
            'name' => 'required|unique:users,name|max:100',
            'email' => 'required|unique:users,email|max:100',
            'orga_name' => 'required|max:100',
            'orga_presentation' => 'required|max:100',
            'address' => 'required|max:100',
            'city' => 'required|max:100',
            'country' => 'required|max:100',
            'state' => 'required|max:100',
            'postalCode' => 'required|max:100',
            'language' => 'required|max:100',
            'prefixPhone' => 'required|max:100',
            'phone' => 'required|max:100',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        
        // Validate request
        $validator = Validator::make($datas, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        $password = '1111';
        $datas['password'] = bcrypt($password);
        $datas['status'] = 'pinged';
        $datas['role'] = 'afa';
        $datas['type'] = 'organization';
        
        // Create Localization
        $location = Localization::create($datas);
        $datas['location_id'] = $location->id;
        
        // Create user
        $user = User::create($datas);
        
        // Update MetaData
        if($value = $request->input('orga_name')) $user->update_meta("orga_name", $value);
        if($value = $request->input('orga_presentation')) $user->update_meta("orga_presentation", $value);
        if($value = $request->input('prefixPhone')) $user->update_meta("prefixPhone", $value);
        if($value = $request->input('phone')) $user->update_meta("phone", $value);
        
        // Common datas
        if($value = $request->input('language')) $user->update_meta("language", $value);
        if($value = $request->input('newsletter')) $user->update_meta("newsletter", $value);
        if($value = $request->input('allow_sharing')) $user->update_meta("allow_sharing", $value);
                
        // Store image file
        if($user && $file=$request->file('image')){
            $image = $file->store('uploads');
            $user->update_meta("image", $image);
        }
        
        //firing an event
        Event::fire(new UserRegistered($user));
        
        // Success
        return back()->with('success',"L'utilisateur a été bien enregistré.");
    }

    /*
    * Store APL information into database
    * Go back after saving data
    *
    * @param  Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    private function registerApl(Request $request)
    {  
        $rules = [
            'name' => 'required|unique:users,name|max:100',
            'email' => 'required|unique:users,email|max:100',
            'orga_name' => 'required|max:100',
            'orga_presentation' => 'required|max:100',
            'address' => 'required|max:100',
            'city' => 'required|max:100',
            'country' => 'required|max:100',
            'state' => 'required|max:100',
            'postalCode' => 'required|max:100',
            'language' => 'required|max:100',
            'prefixPhone' => 'required|max:100',
            'phone' => 'required|max:100',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        
        // Validate request
        $validator = Validator::make($datas, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        $password = '1111';
        $datas['password'] = bcrypt($password);
        $datas['status'] = 'pinged';
        $datas['role'] = 'apl';
        $datas['type'] = 'organization';
        
        // Create Localization
        $location = Localization::create($datas);
        $datas['location_id'] = $location->id;
        
        // Create user
        $user = User::create($datas);
        
        // Update MetaData
        if($value = $request->input('orga_name')) $user->update_meta("orga_name", $value);
        if($value = $request->input('orga_presentation')) $user->update_meta("orga_presentation", $value);
        if($value = $request->input('prefixPhone')) $user->update_meta("prefixPhone", $value);
        if($value = $request->input('phone')) $user->update_meta("phone", $value);
        
        // Common datas
        if($value = $request->input('language')) $user->update_meta("language", $value);
        if($value = $request->input('newsletter')) $user->update_meta("newsletter", $value);
        if($value = $request->input('allow_sharing')) $user->update_meta("allow_sharing", $value);
                
        // Store image file
        if($user && $file=$request->file('image')){
            $image = $file->store('uploads');
            $user->update_meta("image", $image);
        }
        
        //firing an event
        Event::fire(new UserRegistered($user));
        
        // Success
        return back()->with('success',"L'utilisateur a été bien enregistré.");
    }

    /*
    * Store member information into database
    * Go back after saving data
    *
    * @param  Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    private function registerMember(Request $request)
    {    
        if($type=$request->input('type')){
            $datas = $request->all();
            if($type=='person'){
                $rules = [
                    'name' => 'required|unique:users,name|max:100',
                    'email' => 'required|unique:users,email|max:100',
                    'firstname' => 'nullable|max:100',
                    'lastname' => 'nullable|max:100',
                    'country' => 'required|max:100',
                    'language' => 'required|max:100',
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ];
            }else if($type=='organization'){
                $rules = [
                    'name' => 'required|unique:users,name|max:100',
                    'email' => 'required|unique:users,email|max:100',
                    'orga_name' => 'required|max:100',
                    'orga_presentation' => 'required|max:100',
                    'address' => 'required|max:100',
                    'city' => 'required|max:100',
                    'country' => 'required|max:100',
                    'state' => 'required|max:100',
                    'postalCode' => 'required|max:100',
                    'language' => 'required|max:100',
                    'prefixPhone' => 'required|max:100',
                    'phone' => 'required|max:100',
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ];
            }
            
            // type organization OR person
            if($rules){
                // Validate request
                $validator = Validator::make($datas, $rules);
                if ($validator->fails()) {
                    return back()->withErrors($validator)
                                ->withInput();
                }
                
                $password = '1212'; //Hash::generate();
                $datas['password'] = bcrypt($password);
                $datas['status'] = 'pinged';
                $datas['role'] = 'member';
                $datas['type'] = $type;
                if($type=='organization'){
                    // Create Localization
                    $location = Localization::create($datas);
                    $datas['location_id'] = $location->id;
                    
                    // Create user
                    $user = User::create($datas);
                    
                    // Update MetaData
                    if($value = $request->input('orga_name')) $user->update_meta("orga_name", $value);
                    if($value = $request->input('orga_presentation')) $user->update_meta("orga_presentation", $value);
                    if($value = $request->input('prefixPhone')) $user->update_meta("prefixPhone", $value);
                    if($value = $request->input('phone')) $user->update_meta("phone", $value);
                }else{
                    // Create user
                    $user = User::create($datas);
                    
                    // Update MetaData
                    if($value = $request->input('firstname')) $user->update_meta("firstname", $value);
                    if($value = $request->input('lastname')) $user->update_meta("lastname", $value);
                    if($value = $request->input('country')) $user->update_meta("country", $value);
                    
                }
                
                // Common datas
                if($value = $request->input('language')) $user->update_meta("language", $value);
                if($value = $request->input('newsletter')) $user->update_meta("newsletter", $value);
                if($value = $request->input('allow_sharing')) $user->update_meta("allow_sharing", $value);
                
                
                // Store image file
                if($user && $file=$request->file('image')){
                    $image = $file->store('uploads');
                    $user->update_meta("image", $image);
                }
        
                //firing an event
                Event::fire(new UserRegistered($user));
                
                // Success
                return back()->with('success',"L'utilisateur a été bien enregistré.");
            }
        }
        return back()->with('warning', 'Veuillez re-saisir les données.');
        
    }

    /*
    * Load country code from csv file
    *
    */
    private function getPaysFromCsv(){
        $ligne = 1;
        $fic = fopen(resource_path()."/csv/country-code-fr.csv", "a+");
        $listePays = array();
        while($tab=fgetcsv($fic,1024))
        {
            $champs = count($tab);
            $ligne ++;
            for($i=0; $i<$champs; $i ++)
            {
                $pays = explode(";", $tab[$i]);
                array_push( $listePays, $pays[1]) ;
            }
        }
        return $listePays;
    }

    /*
    * Load tel code from csv file
    *
    */
    private function getTelsFromCsv(){
        $ligne = 1;
        $fic = fopen(resource_path()."/csv/tel-code-fr.csv" , "a+");
        $listeContact = array();
        while($tab=fgetcsv($fic,1024))
        {
            $champs = count($tab);
            $ligne ++;
            for($i=0; $i<$champs; $i ++)
            {
                $contact = explode(";", $tab[$i]);
                array_push( $listeContact, $contact[0]."  ".$contact[1]) ;
            }
        }
        return $listeContact;
    }
}
