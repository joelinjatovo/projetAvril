<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use Validator;

use App\Models\Cart;
use App\Models\Image;
use App\Models\Localisation;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show current user profile
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->isAdmin()){
            $view = view('admin.user.profile');
        }else{
            $view = view('backend.user.profile');
        }
        
        return $view->with('title', __('app.profile'))
            ->with('item', Auth::user())
            ->with('breadcrumbs', __('app.profile'));
    }

    /**
     * Show form to edit current user profile
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $action = route('profile.edit');
        
        if(Auth::user()->isAdmin()){
            $view = view('admin.user.edit.update');
        }else{
            $view = view('backend.user.edit.update');
        }
        $breadcrumbs = [
            [
                'active' => false,
                'route'  => route('profile'),
                'label'  => __('app.profile'),
            ],
            [
                'active' => true,
                'label'  => __('app.profile.edit'),
            ],
            
        ];
        return $view->with('title', __('app.profile'))
            ->with('action', $action)
            ->with('item', Auth::user())
            ->with('breadcrumbs', $breadcrumbs);
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
        
        $default = [
            'name'     => 'required|unique:users,name|max:100',
            'email'    => 'required|unique:users,email|max:100',
            'language' => 'required|max:100',
            'image'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        
        switch($role){
            case 'member':
                $type=$request->input('type');
                if($type=='person'){
                    $rules = [
                        'first_name' => 'required|max:100',
                        'last_name'  => 'required|max:100',
                    ];
                }else{
                    $rules = [
                        'prefixPhone' => 'required|max:100',
                        'phone'       => 'required|max:100',

                        'orga_name'         => 'required|max:100',
                        'orga_presentation' => 'required|max:100',
                    ];
                }
                break;
            case 'afa':
                $rules = [
                    'orga_name'         => 'required|max:100',
                    'orga_presentation' => 'required|max:100',
                    'orga_email'        => 'required|email|max:100',
                    'orga_phone'        => 'required|max:100',
                    'orga_website'      => 'required|url|max:100',
                    
                    'orga_operation_state' => 'required|max:100',
                    'orga_operation_range' => 'required|max:100',

                    'contact_name'  => 'required|max:100',
                    'contact_email' => 'required|max:100',
                    'contact_phone' => 'required|max:100',

                    'crm_name'   => 'required|max:100',
                    'crm_email'  => 'required|max:100',
                ];
                break;
            case 'apl':
                $rules = [
                    'orga_name'         => 'required|max:100',
                    'orga_presentation' => 'required|max:100',
                    'orga_email'        => 'required|email|max:100',
                    'orga_phone'        => 'required|max:100',
                    'orga_website'      => 'required|url|max:100',
                    
                    'orga_operation_range' => 'required|max:100',

                    'contact_name'  => 'required|max:100',
                    'contact_email' => 'required|email|max:100',
                    'contact_phone' => 'required|max:100',

                    'bank_iban' => 'max:100',
                    'bank_bic' => 'max:100',
                ];
                break;
            case 'seller':
                $rules = [
                    'orga_name'         => 'required|max:100',
                    'orga_presentation' => 'required|max:100',
                    'orga_email'        => 'required|email|max:100',
                    'orga_phone'        => 'required|max:100',
                    'orga_website'      => 'required|url|max:100',

                    'contact_name'  => 'required|max:100',
                    'contact_email' => 'required|max:100',
                    'contact_phone' => 'required|max:100',

                    'crm_name'   => 'required|max:100',
                    'crm_email'  => 'required|max:100',

                ];
                break;
            case 'admin':
                $rules = [
                    'email'    => 'required|unique:users,email|max:100',
                    'language'   => 'required|max:100',
                    'first_name' => 'required|max:100',
                    'last_name'  => 'required|max:100',
                ];
                break;
            default:
                abort(404);
        }

        // Validate request
        if(!$user->isAdmin()){
            $rules = array_merge($default, $rules);
        }
        
        $validator = Validator::make($datas, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        if(!$user->isAdmin()){
            // Store image file
            $datas['image_id'] = 0;
            if($file=$request->file('image')){
                $image = Image::storeAndSave($file);
                $datas['image_id'] = $image->id;
            }
        }
        
        try{
            // Update user
            $user->fill($datas);
            $user->save();
            
            // Create OR Update MetaData
            $user->handles($request);
            
        }catch (\Exception $exception) {
            logger()->error($exception);
            return back()->with('info', 'Unable to edit your profile.');
        }
    
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
        if(Auth::user()->isAdmin()){
            $view = view('admin.user.edit.password');
        }else{
            $view = view('backend.user.edit.password');
        }
        
        $breadcrumbs = [
            [
                'active'=>false,
                'route'=>route('profile'),
                'label'=>__('app.profile'),
            ],
            [
                'active'=>true,
                'label'=>__('app.password'),
            ],
            
        ];
        return $view->with('title', __('app.password'))
            ->with('breadcrumbs', $breadcrumbs);
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
        if(Auth::user()->isAdmin()){
            $view = view('admin.user.edit.avatar');
        }else{
            $view = view('backend.user.edit.avatar');
        }
        
        $breadcrumbs = [
            [
                'active'=>false,
                'route'=>route('profile'),
                'label'=>__('app.profile'),
            ],
            [
                'active'=>true,
                'label'=>__('app.avatar'),
            ],
            
        ];
        return $view->with('title', __('app.avatar'))
            ->with('item', Auth::user())
            ->with('breadcrumbs', $breadcrumbs);
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
        if(Auth::user()->isAdmin()){
            $view = view('admin.user.edit.location');
        }else{
            $view = view('backend.user.edit.location');
        }
        
        $breadcrumbs = [
            [
                'active'=>false,
                'route'=>route('profile'),
                'label'=>__('app.profile'),
            ],
            [
                'active'=>true,
                'label'=>__('app.location'),
            ],
            
        ];
        return $view->with('title', __('app.location'))
            ->with('item', Auth::user()->with('location'))
            ->with('location',  Auth::user()->location)
            ->with('breadcrumbs',  $breadcrumbs);
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
        $datas = $request->all();
        if($location = $user->location){
            
            $location->fill($datas);
            
            // Success
            return back()->with('success',"Votre location a été bien modifiée.");
        }else if($location = Localisation::create($datas)){
            $user->location_id = $location->id>0?$location->id:0;
        }
        
        try{
            $user->save();
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
        
        // Success
        return back()->with('success',"Votre location a été bien ajoutée.");
    }

}
