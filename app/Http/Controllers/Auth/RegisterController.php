<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;
use Event;

use App\Notifications\AccountCreated;

use App\Models\User;
use App\Models\Localisation;
use App\Models\Image;
use App\Models\Page;
use App\Models\Country;
use App\Models\State;

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
    protected $redirectTo = '/login';

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
        $password = $datas['password'];
        $datas['password'] = bcrypt($password);
        $datas['status'] = 'pinged';
        
        return User::create($datas);
    }
    
    
    /**
     * Activate the user with given activation code.
     * @param string $code
     * @return String
     */
    public function activateUser($code)
    {
        try {
            $user = User::where('activation_code', $code)->first();
            if (!$user) {
                return redirect()->route('login')
                    ->with('error',"The code does not exist for any user in our system.");
            }
            $user->status = 'active';
            $user->activation_code = null;
            $user->save();
        } catch (\Exception $exception) {
            logger()->error($exception);
            return redirect()->route('login')
                ->with('error',"Whoops! something went wrong.");
        }
        return redirect()->route('login')
                ->with('success',"Your account is activated. You can login now with your default password.");
    }
    
    
    /**
     * Resend activation mail
     * @param User $user
     * @return String
     */
    public function resendActivation(User $user)
    {
        if($user->isActive()){
            return back()
                ->with('error',"User already active. Operation not allowed");
        }
        
        try {
            $password = str_random(10);
            $user->password = bcrypt($password);
            $user->activation_code = md5(str_random(30).(time()*32));
            $user->save();
        } catch (\Exception $exception) {
            logger()->error($exception);
            return redirect()->route('login')
                ->with('error',"Whoops! something went wrong.");
        }
        
        // Notify User
        $user->notify(new AccountCreated($user, $password));
        
        return redirect()->route('login')
            ->with('success', 'Activation code sent. Please check your email and activate your account..<br>'
                  .'<a class="btn btn-default" href="'.route('resend_code', $user).'">Resend code</a>');
        
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
        $page = Page::where('path', '/register/'.$role)
            ->locale()
            ->first();
        switch($role){
            case "member":
                $pays = $this->getPaysFromCsv();
                $tels = $this->getTelsFromCsv();
                return view('login.'.$role)
                    ->with('action', $action)
                    ->with('countries', Country::all())
                    ->with('page', $page);
                break;
            case "afa":
                $request->session()->put("step", "condition");
                return view('login.condition.afa')
                    ->with('page', $page);
                break;
            case "apl":
                $request->session()->put("step", "condition");
                return view('login.condition.apl')
                    ->with('page', $page);
                break;
            case "seller":
                $request->session()->put("step", "condition");
                return view('login.condition.seller')
                    ->with('page', $page);
                break;
            default:
                abort(404);
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
        if($role=='member') return $this->storeByRole($request, $role);
        
        // Switch to get Condition and Term count
        $conditionCount = 0;
        switch($role){
            case "afa":
                $conditionCount = 4;
            break;
            case "apl":
                $conditionCount = 5;
            break;
            case "seller":
                $conditionCount = 2;
            break;
        }
        
        // Shown condition form
        if($request->session()->get("step") == "condition"){
            // Validate term check
            $count = 0;
            if(($conditions = $request->condition) && is_array($conditions)){
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
            return view('login.'.$role)
                    ->with('action', $action)
                    ->with('states', State::all())
                    ->with('countries', Country::all());
            
        }
        
        // Shown Register form
        if($request->session()->get("step") == "register"){
            return $this->storeByRole($request, $role);
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
    private function storeByRole(Request $request, $role)
    {    
        // Get post datas
        $datas = $request->all();
        
        // Validate type Only
        if($role=='member'){
            $validator = Validator::make($datas, ['type' => 'required|max:100',]);
            if ($validator->fails()) {
                return back()->withErrors($validator)
                            ->withInput();
            }
        }
        
        switch($role){
            case 'member':
                $type=$request->input('type');
                if($type=='person'){
                    $rules = [
                        'name'     => 'required|unique:users,name|max:100',
                        'email'    => 'required|unique:users,email|max:100',
                        'language' => 'required|max:100',
                        'image'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                        'first_name' => 'required|max:100',
                        'last_name'  => 'required|max:100',

                        'country'      => 'required|max:100',
                        'area_level_1' => 'nullable|max:100',
                        'area_level_2' => 'nullable|max:100',
                        'locality'     => 'nullable|max:100',
                        'route'        => 'nullable|max:100',
                        'postalCode'   => 'nullable|max:100',
                    ];
                }else{
                    $rules = [
                        'name'     => 'required|unique:users,name|max:100',
                        'email'    => 'required|unique:users,email|max:100',
                        'language' => 'required|max:100',
                        'image'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                        'prefixPhone' => 'required|max:100',
                        'phone'       => 'required|max:100',

                        'orga_name'         => 'required|max:100',
                        'orga_presentation' => 'required|max:100',

                        'country'      => 'required|max:100',
                        'area_level_1' => 'required|max:100',
                        'area_level_2' => 'nullable|max:100',
                        'locality'     => 'required|max:100',
                        'route'        => 'nullable|max:100',
                        'postalCode'   => 'nullable|max:100',
                    ];
                }
                break;
            case 'afa':
                $rules = [
                    'name'     => 'required|unique:users,name|max:100',
                    'email'    => 'required|unique:users,email|max:100',
                    'language' => 'required|max:100',
                    'image'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                    'orga_name'         => 'required|max:100',
                    'orga_presentation' => 'required|max:100',
                    'orga_email'        => 'required|email|max:100',
                    'orga_phone'        => 'required|max:100',
                    'orga_website'      => 'required|url|max:100',
                    
                    'orga_operation_state' => 'required|max:100',
                    'orga_operation_range' => 'required|max:100',

                    'country'      => 'nullable|max:100',
                    'area_level_1' => 'required|max:100',
                    'area_level_2' => 'required|max:100',
                    'locality'     => 'required|max:100',
                    'route'        => 'nullable|max:100',
                    'postalCode'   => 'nullable|max:100',

                    'contact_name'  => 'required|max:100',
                    'contact_email' => 'required|max:100',
                    'contact_phone' => 'required|max:100',

                    'crm_name'   => 'required|max:100',
                    'crm_email'  => 'required|max:100',
                ];
                break;
            case 'apl':
                $rules = [
                    'name'     => 'required|unique:users,name|max:100',
                    'email'    => 'required|unique:users,email|max:100',
                    'language' => 'required|max:100',
                    'image'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                    'orga_name'         => 'required|max:100',
                    'orga_presentation' => 'required|max:100',
                    'orga_email'        => 'required|email|max:100',
                    'orga_phone'        => 'required|max:100',
                    'orga_website'      => 'required|url|max:100',
                    
                    'orga_operation_range' => 'required|max:100',

                    'country'      => 'required|max:100',
                    'area_level_1' => 'nullable|max:100',
                    'area_level_2' => 'nullable|max:100',
                    'locality'     => 'required|max:100',
                    'route'        => 'nullable|max:100',
                    'postalCode'   => 'nullable|max:100',

                    'contact_name'  => 'required|max:100',
                    'contact_email' => 'required|email|max:100',
                    'contact_phone' => 'required|max:100',

                    'bank_iban' => 'max:100',
                    'bank_bic' => 'max:100',
                ];
                break;
            case 'seller':
                $rules = [
                    'name'     => 'required|unique:users,name|max:100',
                    'email'    => 'required|email|unique:users,email|max:100',
                    'language' => 'required|max:100',
                    'type'     => 'required|max:100',
                    'image'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                    'orga_name'         => 'required|max:100',
                    'orga_presentation' => 'required|max:100',
                    'orga_email'        => 'required|email|max:100',
                    'orga_phone'        => 'required|max:100',
                    'orga_website'      => 'required|url|max:100',

                    'country'      => 'nullable|max:100',
                    'area_level_1' => 'required|max:100',
                    'area_level_2' => 'required|max:100',
                    'locality'     => 'required|max:100',
                    'route'        => 'nullable|max:100',
                    'postalCode'   => 'nullable|max:100',

                    'contact_name'  => 'required|max:100',
                    'contact_email' => 'required|max:100',
                    'contact_phone' => 'required|max:100',

                    'crm_name'   => 'required|max:100',
                    'crm_email'  => 'required|max:100',

                ];
                break;
            default:
                abort(404);
        }

        // Validate request
        $validator = Validator::make($datas, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        // Create Localization
        $datas['location_id'] = 0;
        if($location = Localisation::create($datas)){
            $datas['location_id'] = $location->id>0?$location->id:0;
        }
        
        // Store image file
        $datas['image_id'] = 0;
        if($file=$request->file('image')){
            $image = Image::storeAndSave($file);
            $datas['image_id'] = $image->id>0?$image->id:0;
        }
        
        // More info
        $datas['role'] = $role;
        $datas['password'] = $password = str_random(10);
        $datas['activation_code'] = md5(str_random(30).(time()*32));
        $datas['use_default_password'] = 1;
        
        // Date d'essaie
        $datas['trial_ends_at'] = \Carbon\Carbon::now()->addDays(option('payment.trial_delay', 14));

        // Create user
        try{
            $user = $this->create($datas);
        }catch (\Exception $exception) {
            logger()->error($exception);
            return back()->with('info', 'Unable to create new user.');
        }
        
        
        switch($role){
            case 'member':
                if($type=='organization'){
                    // Update MetaData
                    if($value = $request->input('orga_name')) $user->update_meta("orga_name", $value);
                    if($value = $request->input('orga_presentation')) $user->update_meta("orga_presentation", $value);
                    if($value = $request->input('prefixPhone')) $user->update_meta("prefixPhone", $value);
                    if($value = $request->input('phone')) $user->update_meta("phone", $value);
                }else{
                    // Update MetaData
                    if($value = $request->input('first_name')) $user->update_meta("firstname", $value);
                    if($value = $request->input('last_name')) $user->update_meta("lastname", $value);

                }
                break;
            case 'afa':
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
                break;
            case 'apl':
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

                // Bank data
                if($value = $request->input('bank_iban'))     $user->update_meta("bank_iban", $value);
                if($value = $request->input('bank_bic'))      $user->update_meta("bank_bic", $value);
                break;
            case 'seller':
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
                break;
        }
        

        // Common datas
        if($value = $request->input('newsletter')) $user->update_meta("newsletter", $value);
        if($value = $request->input('allow_sharing')) $user->update_meta("allow_sharing", $value);

        $request->session()->forget("step");

        // Notify User
        try{
            $user->notify(new AccountCreated($user, $password));
        }catch(\Exception $e){
            $error = $e->getMessage();
            return redirect()->route('login')
                ->with('error', $error);
        }

        // Success
        return redirect()->route('login')
            ->with('success', 'Successfully created a new account. Please check your email and activate your account.<br>'
                  .'<a class="btn btn-default" href="'.route('resend_code', $user).'">Resend code</a>');
        
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
