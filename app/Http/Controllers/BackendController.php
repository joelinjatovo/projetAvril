<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use Validator;

use App\Models\Cart;
use App\Models\Image;

class BackendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        Auth::check();
    }

    /**
     * Show the dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $currentCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = Cart::getInstance($currentCart);
        
        return view('backend.dashboard.'.Auth::user()->role)
            ->with('item',Auth::user())
            ->with(['cart' => $cart]);
    }

    /**
     * Show form to edit current user profile
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $action = url(Auth::user()->role.'/edit');
        return view('backend.user.update')
            ->with('action',$action)
            ->with('item',Auth::user());
    }

    /**
     * Edit current user profile
     *
     * @return \Illuminate\Http\Response
     */
    public function editProfile(Request $request)
    {    
        $user = Auth::user();
        $role = $user->role;
        
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
                        'language' => 'required|max:100',
                        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                        'firstname' => 'nullable|max:100',
                        'lastname' => 'nullable|max:100',

                        'country' => 'required|max:100',
                    ];
                }else{
                    $rules = [
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
                break;
            case 'afa':
                $rules = [
                    'language' => 'required|max:100',
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                    'orga_name' => 'required|max:100',
                    'orga_presentation' => 'required|max:100',
                    'orga_email' => 'required|email|max:100',
                    'orga_phone' => 'required|max:100',
                    'orga_website' => 'required|url|max:100',
                    'orga_operation_state' => 'required|max:100',
                    'orga_operation_range' => 'required|max:100',

                    'address' => 'max:100',
                    'street' => 'max:100',
                    'suburb' => 'max:100',
                    'city' => 'max:100',
                    'country' => 'max:100',
                    'state' => 'max:100',
                    'postalCode' => 'max:100',

                    'contact_name' => 'max:100',
                    'contact_email' => 'max:100',
                    'contact_phone' => 'max:100',

                    'crm_name' => 'max:100',
                    'crm_email' => 'max:100',
                ];
                break;
            case 'apl':
                $rules = [
                    'language' => 'required|max:100',
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                    'orga_name' => 'required|max:100',
                    'orga_presentation' => 'required|max:100',
                    'orga_email' => 'required|email|max:100',
                    'orga_phone' => 'required|max:100',
                    'orga_website' => 'required|url|max:100',
                    'orga_operation_range' => 'required|max:100',

                    'address' => 'max:100',
                    'street' => 'max:100',
                    'suburb' => 'max:100',
                    'city' => 'max:100',
                    'country' => 'max:100',
                    'state' => 'max:100',
                    'postalCode' => 'max:100',

                    'contact_name' => 'max:100',
                    'contact_email' => 'max:100',
                    'contact_phone' => 'max:100',

                    'bank_iban' => 'max:100',
                    'bank_bic' => 'max:100',
                ];
                break;
            case 'seller':
                $rules = [
                    'language' => 'required|max:100',
                    'type' => 'required|max:100',
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                    'orga_name' => 'required|max:100',
                    'orga_presentation' => 'required|max:100',
                    'orga_email' => 'required|email|max:100',
                    'orga_phone' => 'required|max:100',
                    'orga_website' => 'required|url|max:100',

                    'address' => 'max:100',
                    'street' => 'max:100',
                    'suburb' => 'max:100',
                    'city' => 'max:100',
                    'country' => 'max:100',
                    'state' => 'max:100',
                    'postalCode' => 'max:100',

                    'contact_name' => 'max:100',
                    'contact_email' => 'max:100',
                    'contact_phone' => 'max:100',

                    'crm_name' => 'max:100',
                    'crm_email' => 'max:100',

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
        $datas['location_id'] = '';
        if($location = Localisation::create($datas)){
            $datas['location_id'] = $location->id;
        }
        
        // Store image file
        $datas['image_id'] = '';
        if($file=$request->file('image')){
            $image = Image::storeAndSave($file);
            $datas['image_id'] = $image->id;
        }
        
        // Create user
        try{
            $user->fill($datas);
        }catch (\Exception $exception) {
            logger()->error($exception);
            return back()->with('info', 'Unable to edit your profile.');
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
                    if($value = $request->input('firstname')) $user->update_meta("firstname", $value);
                    if($value = $request->input('lastname')) $user->update_meta("lastname", $value);

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

        // Success
        return back()->with('success',"Votre profile a été bien modifié.");
        
    }

    /**
     * Show form to edit current user password
     *
     * @return \Illuminate\Http\Response
     */
    public function password()
    {
        return view('backend.user.password');
    }

    /**
     * Show form to edit current user password
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(),[
                            'old_password' => 'required|max:100',
                            'password' => 'confirmed|max:100',
                        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator);
        }
        
        $old = bcrypt($request->old_password);
        if($old == Auth::user()->password){
            Auth::user()->password = bcrypt($request->password);
            Auth::user()->use_default_password = 0;
        }
        
        // Success
        return back()->with('success',"Votre mot de passe a été bien modifié.");
    }

    /**
     * Show form to edit current user avatar
     *
     * @return \Illuminate\Http\Response
     */
    public function avatar()
    {
        return view('backend.user.avatar')
            ->with('item', Auth::user());
    }

    /**
     * Show form to edit current user avatar
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAvatar(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(),[
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        $user = Auth::user();
        try{
            $file = $request->file('image');
            $image = Image::storeAndSave($file);
            $user->image_id = $image->id;
            $user->save();
        }catch(\Exception $e){
            return back()->with('success', $e->getMessage());
        }
        
        // Success
        return back()->with('success',"Votre photo a été bien modifiée.");
    }

    /**
     * Show form to edit current user location
     *
     * @return \Illuminate\Http\Response
     */
    public function location()
    {
        return view('backend.user.location')
            ->with('item', Auth::user()->with('location'))
            ->with('location',  Auth::user()->location);
    }

    /**
     * Show form to edit current user location
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateLocation(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(),[ 
            'latitude'     => 'required',
            'longitude'    => 'required',
            'country'      => 'max:100',
            'area_level_1' => 'max:100',
            'area_level_2' => 'max:100',
            'locality'     => 'max:100',
            'route'       => 'max:100',
            'formatted'    => 'max:100',
            'postalCode'   => 'max:100',
            ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        $user = Auth::user();
        
        // Create Localization
        if($location = Localisation::create($datas)){
            $user->location_id = $location->id>0?$location->id:0;
        }
        
        try{
            $user->save();
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
        
        // Success
        return back()->with('success',"Votre location a été bien modifiée.");
    }

    
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function favorites()
    {
        return view('backend.product.all')
            ->with('items', Auth::user()->favorites);
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function pins()
    {
        return view('backend.product.all')
            ->with('items', Auth::user()->pins);
    }

}
