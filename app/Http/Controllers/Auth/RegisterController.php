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
     * @param  array  $datas
     * @return \App\Models\User
     */
    protected function create(array $datas)
    {
        $password = '1212'; //Hash::generate();
        $datas['password'] = bcrypt($password);
        $datas['status'] = 'pinged';
        
        return User::create($datas);
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
            case "seller":
                $request->session()->put("step", "condition");
                return view('login.condition.seller');
            break;
            case "afa":
                $request->session()->put("step", "condition");
                return view('login.condition.afa');
            break;
            case "apl":
                $request->session()->put("step", "condition");
                return view('login.condition.apl');
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
        if($role=='member') return $this->registerMember($request);
        
        // Switch to get Condition and Term count
        $conditionCount = 0;
        switch($role){
            case "seller":
                $conditionCount = 2;
            break;
            case "afa":
                $conditionCount = 4;
            break;
            case "apl":
                $conditionCount = 5;
            break;
        }
        
        // Shown condition form
        if($request->session()->get("step") == "condition"){
            // Validate term check
            $count = 0;
            if($conditions = $request->condition && is_array($conditions)){
                foreach($conditions as $condition){
                    if($condition==1) $count++;
                }
            }
            if($count!=$conditionCount){
                return back()->with('error', 'You must agree the term and condition');
            }

            $request->session()->put("step", "register");
            $pays = $this->getPaysFromCsv();
            $action = route('register',['role'=>$role]);
            return view('login.'.$role, ["pays"=>$pays , "action"=>$action]);
            
        }
        
        // Shown Register form
        if($request->session()->get("step") == "register"){
            $request->session()->forget("step");
            switch($role){
                case "seller":
                    return $this->registerSeller($request);
                case "afa":
                    return $this->registerAfa($request);
                case "apl":
                    return $this->registerApl($request);
            }
        }
        
        // Open First Page of registration
        return redirect()->route('register',['role'=>$role]);
        
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
        // Get post datas
        $datas = $request->all();
        
        // Validate type Only
        $validator = Validator::make($datas, ['type' => 'required|max:100',]);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        $type=$request->input('type');
        if($type=='person'){
            $rules = [
                'name' => 'required|unique:users,name|max:100',
                'email' => 'required|unique:users,email|max:100',
                'language' => 'required|max:100',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                
                'firstname' => 'nullable|max:100',
                'lastname' => 'nullable|max:100',
                
                'country' => 'required|max:100',
            ];
        }else{
            $rules = [
                'name' => 'required|unique:users,name|max:100',
                'email' => 'required|unique:users,email|max:100',
                'language' => 'required|max:100',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                
                'prefixPhone' => 'required|max:100',
                'phone' => 'required|max:100',
                
                'orga_name' => 'required|max:100',
                'orga_presentation' => 'required|max:100',
                
                'address' => 'required|max:100',
                'city' => 'required|max:100',
                'country' => 'required|max:100',
                'state' => 'required|max:100',
                'postalCode' => 'required|max:100',
            ];
        }

        // Validate request
        $validator = Validator::make($datas, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        // Create Localization
        $datas['location_id'] = '';
        if($location = Localization::create($datas)){
            $datas['location_id'] = $location->id;
        }
        
        // Store image file
        $datas['image_id'] = '';
        if($file=$request->file('image')){
            $image = Image::storeAndSave($file);
            $datas['image_id'] = $image->id;
        }
        
        // Role
        $datas['role'] = 'member';

        // Create user
        $user = $this->create($datas);
        
        if($type=='organization'){
            // Update MetaData
            if($value = $request->input('orga_name')) $user->update_meta("orga_name", $value);
            if($value = $request->input('orga_presentation')) $user->update_meta("orga_presentation", $value);
            if($value = $request->input('prefixPhone')) $user->update_meta("prefixPhone", $value);
            if($value = $request->input('phone')) $user->update_meta("phone", $value);
        }else{
            // Update MetaData
            if($value = $request->input('firstname')) $user->update_meta("firstname", $value);
            if($value = $request->input('lastname')) $user->update_meta("lastname", $value);

        }

        // Common datas
        if($value = $request->input('newsletter')) $user->update_meta("newsletter", $value);
        if($value = $request->input('allow_sharing')) $user->update_meta("allow_sharing", $value);

        // Firing an event
        Event::fire(new UserRegistered($user));

        // Success
        return back()->with('success',"L'utilisateur a été bien enregistré.");
        
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
            'email' => 'required|email|unique:users,email|max:100',
            'language' => 'required|max:100',
            'type' => 'required|max:100',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
            'orga_name' => 'required|max:100',
            'orga_presentation' => 'required|max:100',
            'orga_email' => 'required|email|max:100',
            'orga_phone' => 'required|tel|max:100',
            'orga_website' => 'required|url|max:100',
            
            'address' => 'max:100',
            'street' => 'required|max:100',
            'suburd' => 'required|max:100',
            'city' => 'max:100',
            'country' => 'max:100',
            'state' => 'required|max:100',
            'postalCode' => 'required|max:100',
            
            'contact_name' => 'required|max:100',
            'contact_email' => 'required|max:100',
            'contact_phone' => 'required|max:100',
            
            'crm_name' => 'required|max:100',
            'crm_email' => 'required|max:100',
        ];
        
        // Validate request
        $validator = Validator::make($datas, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        // Create Localization
        $datas['location_id'] = '';
        if($location = Localization::create($datas)){
            $datas['location_id'] = $location->id;
        }
        
        // Store image file
        $datas['image_id'] = '';
        if($file=$request->file('image')){
            $image = Image::storeAndSave($file);
            $datas['image_id'] = $image->id;
        }
        
        // Role
        $datas['role'] = 'seller';

        // Create user
        $user = $this->create($datas);
        
        // Create Organisation MetaData
        if($value = $request->input('orga_name'))           $user->update_meta("orga_name", $value);
        if($value = $request->input('orga_presentation'))   $user->update_meta("orga_presentation", $value);
        if($value = $request->input('orga_email'))          $user->update_meta("orga_email", $value);
        if($value = $request->input('orga_phone'))          $user->update_meta("orga_phone", $value);
        if($value = $request->input('orga_website'))        $user->update_meta("orga_website", $value);
        
        // Create Contact MetaData
        if($value = $request->input('contact_name'))        $user->update_meta("contact_name", $value);
        if($value = $request->input('contact_email'))       $user->update_meta("contact_email", $value);
        if($value = $request->input('contact_phone'))       $user->update_meta("contact_phone", $value);
        
        // CRM Prodvider data
        if($value = $request->input('crm_name'))       $user->update_meta("crm_name", $value);
        if($value = $request->input('crm_email'))      $user->update_meta("crm_email", $value);
        
        // Common datas
        if($value = $request->input('newsletter'))          $user->update_meta("newsletter", $value);
        if($value = $request->input('allow_sharing'))       $user->update_meta("allow_sharing", $value);
                
        // Firing an event
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
            'language' => 'required|max:100',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'orga_name' => 'required|max:100',
            'orga_presentation' => 'required|max:100',
            'orga_email' => 'required|email|max:100',
            'orga_phone' => 'required|tel|max:100',
            'orga_website' => 'required|url|max:100',
            'orga_operation_state' => 'required|url|max:100',
            'orga_operation_range' => 'required|url|max:100',
            
            'address' => 'required|max:100',
            'city' => 'required|max:100',
            'country' => 'required|max:100',
            'state' => 'required|max:100',
            'postalCode' => 'required|max:100',
            
            'contact_name' => 'required|max:100',
            'contact_email' => 'required|max:100',
            'contact_phone' => 'required|max:100',
            
            'crm_name' => 'required|max:100',
            'crm_email' => 'required|max:100',
        ];
        
        // Validate request
        $validator = Validator::make($datas, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        // Create Localization
        $datas['location_id'] = '';
        if($location = Localization::create($datas)){
            $datas['location_id'] = $location->id;
        }
        
        // Store image file
        $datas['image_id'] = '';
        if($file=$request->file('image')){
            $image = Image::storeAndSave($file);
            $datas['image_id'] = $image->id;
        }
        
        // Role and Type
        $datas['role'] = 'afa';
        $datas['type'] = 'organization';
        
        // Create user
        $user = User::create($datas);
        
        // Update MetaData
        if($value = $request->input('orga_name')) $user->update_meta("orga_name", $value);
        if($value = $request->input('orga_presentation')) $user->update_meta("orga_presentation", $value);
        if($value = $request->input('orga_email')) $user->update_meta("orga_email", $value);
        if($value = $request->input('orga_phone')) $user->update_meta("orga_phone", $value);
        if($value = $request->input('orga_website')) $user->update_meta("orga_website", $value);
        if($value = $request->input('orga_operation_state')) $user->update_meta("orga_operation_state", $value);
        if($value = $request->input('orga_operation_range')) $user->update_meta("orga_operation_range", $value);
        
        // Create Contact MetaData
        if($value = $request->input('contact_name'))        $user->update_meta("contact_name", $value);
        if($value = $request->input('contact_email'))       $user->update_meta("contact_email", $value);
        if($value = $request->input('contact_phone'))       $user->update_meta("contact_phone", $value);
        
        // CRM Prodvider data
        if($value = $request->input('crm_name'))       $user->update_meta("crm_name", $value);
        if($value = $request->input('crm_email'))      $user->update_meta("crm_email", $value);
        
        // Common datas
        if($value = $request->input('newsletter')) $user->update_meta("newsletter", $value);
        if($value = $request->input('allow_sharing')) $user->update_meta("allow_sharing", $value);
        
        //firing an event
        Event::fire(new UserRegistered($user));
        
        // Success
        return back()->with('success',"L'afa a été bien enregistré.");
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
            'language' => 'required|max:100',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'orga_name' => 'required|max:100',
            'orga_presentation' => 'required|max:100',
            'orga_email' => 'required|email|max:100',
            'orga_phone' => 'required|tel|max:100',
            'orga_website' => 'required|url|max:100',
            'orga_operation_range' => 'required|url|max:100',
            
            'street' => 'required|max:100',
            'address' => 'required|max:100',
            'city' => 'required|max:100',
            'country' => 'required|max:100',
            'state' => 'required|max:100',
            'postalCode' => 'required|max:100',
            
            'contact_name' => 'required|max:100',
            'contact_email' => 'required|max:100',
            'contact_phone' => 'required|max:100',
            
            'bank_iban' => 'required|max:100',
            'bank_bic' => 'required|max:100',
        ];
        
        // Validate request
        $validator = Validator::make($datas, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        // Create Localization
        $datas['location_id'] = '';
        if($location = Localization::create($datas)){
            $datas['location_id'] = $location->id;
        }
        
        // Store image file
        $datas['image_id'] = '';
        if($file=$request->file('image')){
            $image = Image::storeAndSave($file);
            $datas['image_id'] = $image->id;
        }
        
        // Role and Type
        $datas['role'] = 'apl';
        $datas['type'] = 'organization';
        
        // Create user
        $user = User::create($datas);
        
        // Update MetaData
        if($value = $request->input('orga_name')) $user->update_meta("orga_name", $value);
        if($value = $request->input('orga_presentation')) $user->update_meta("orga_presentation", $value);
        if($value = $request->input('orga_email')) $user->update_meta("orga_email", $value);
        if($value = $request->input('orga_phone')) $user->update_meta("orga_phone", $value);
        if($value = $request->input('orga_website')) $user->update_meta("orga_website", $value);
        if($value = $request->input('orga_operation_range')) $user->update_meta("orga_operation_range", $value);
        
        // Create Contact MetaData
        if($value = $request->input('contact_name'))        $user->update_meta("contact_name", $value);
        if($value = $request->input('contact_email'))       $user->update_meta("contact_email", $value);
        if($value = $request->input('contact_phone'))       $user->update_meta("contact_phone", $value);
        
        // CRM Prodvider data
        if($value = $request->input('bank_iban'))     $user->update_meta("bank_iban", $value);
        if($value = $request->input('bank_bic'))      $user->update_meta("bank_bic", $value);
        
        // Common datas
        if($value = $request->input('newsletter'))    $user->update_meta("newsletter", $value);
        if($value = $request->input('allow_sharing')) $user->update_meta("allow_sharing", $value);
        
        //firing an event
        Event::fire(new UserRegistered($user));
        
        // Success
        return back()->with('success',"L'afa a été bien enregistré.");
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
