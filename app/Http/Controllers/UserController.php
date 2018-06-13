<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Notifications\AccountActivated;
use App\Notifications\AccountDisabled;

use App\Models\User;
use App\Models\Mail;
use App\Models\MailUser;
use App\Models\Country;
use App\Models\State;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    
    /*
    *
    *
    */
    public function contact(Request $request, User $user)
    {
        $this->middleware('auth');
        $this->middleware('auth:admin');
        
        $mail = new Mail();
        if($value = $request->old('subject'))    $mail->subject = $value;
        if($value = $request->old('content'))    $mail->content = $value;
        
        return view('admin.user.contact')
            ->with('title', __('app.contact_user', ['name'=>$user->name, "email"=>$user->email]))
            ->with('item', $user)
            ->with('mail', $mail);
    }
    
    /*
    *
    */
    public function postContact(Request $request, User $user)
    {
        $this->middleware('auth');
        $this->middleware('auth:admin');
            
        // Validate request
        $datas = $request->all();
        $validator = Validator::make($datas,[
            'method' => 'required',
            'subject' => 'required|max:100',
            'content' => 'required|max:1000'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        $item = new Mail();
        $item->subject = $request->subject;
        $item->content = $request->content;
        
        switch($request->method){
            case 'model':
                $item->status = 'model';
                $item->save();
            return back()->with('success', 'Message enregistré au model.');
            case 'draft':
                $item->status = 'draft';
                $item->save();
            return back()->with('success', 'Message enregistré au brouillon.');
            case 'send':
                $item->status = 'send';
                $item->save();
            break;
        }

        $receiverIds = [];
        $receiverIds[] = $user->id;

        $mailItem = new MailUser();
        $mailItem->mail_id = $item->id;
        $mailItem->user_id = $user->id;
        $mailItem->is_sent = 1;
        $mailItem->read    = 0;
        $mailItem->save();
        
        try{
            $data = array('name'=>"Virat Gandhi");
            \Mail::send('mail', $data, function($message) use($mailItem, $user, $item) {
                $message->to($user->email, $user->name)
                        ->subject($item->subject)
                        ->from($user->email, $user->name);
            });
        }catch(\Exception $e){
            $mailItem->is_sent = 0;
            $mailItem->save();
            return back()->with('success', 'Message non envoyé. '. $e->getMessage());
        }
        
        return back()->with('success', 'Messages envoyés avec succes. '.count($receiverIds));
    }
    
    /**
     * Show the user info in Admin Panel.
     *
     * @param  App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        if(!in_array($user->role, ['admin', 'member', 'afa', 'apl', 'seller'])){
            return back()->with('error', 'Un probleme a survenu');
        }
        
        if(Auth::user()->id == $user->id){
            return redirect()->route('profile');
        }
        
        return view('admin.user.index')
            ->with('item', $user)
            ->with('title', __('app.'.$user->role))
            ->with('breadcrumbs', __('app.'.$user->role));
    }
    
    /**
     * Show the list of user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String $filter
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request, $filter='all')
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $items = new User();
        
        switch($filter){
            case 'admin':
            case 'apl':
            case 'afa':
            case 'member':
            case 'seller':
                $title = __('app.user.list.role', ['role'=>__('app.'.$filter)]);
                $items = $items->ofRole($filter)
                    ->isActive();
                break;
            case 'person':
            case 'organization':
                $title = __('app.user.list.type', ['type'=>__('app.'.$filter)]);
                $items = $items->ofType($filter)
                    ->isActive();
                break;
            case 'active':
            case 'pinged':
            case 'disabled':
            case 'blocked':
                $title = __('app.user.list.status', ['status'=>__('app.'.$filter)]);
                $items = $items->ofStatus($filter);
                break;
            default:
            case 'all':
                $title = __('app.admin.user.list');
                break;
        }
        
        $page = $request->get('page');
        if(!$page) $page = 1;
        
        $record = $request->get('record');
        if(!$record) $record = $this->pageSize;
        
        $role = $request->get('role');
        $role = trim($role);
        if($role){
            $items = $items->ofRole($role);
        }
        
        $country = $request->get('country');
        $country = intval($country);
        if($country){
            $items = $items->where('country_id', $country);
        }
        
        $state = $request->get('state');
        $state = intval($state);
        if($state){
            $items = $items->where('state_id', $state);
        }
        
        $q = $request->get('q');
        $q = trim($q);
        if($q){
            $items = $items->where(function($query) use($q){
                return $query->orWhere('name', 'LIKE', '%'.$q.'%')
                    ->orWhere('email', 'LIKE', '%'.$q.'%')
                    ->orWhere('role', 'LIKE', '%'.$q.'%');
            });
        }
        
        $items = $items->paginate($record);
        $countries = Country::all();
        $states = State::all();
        
        return view('admin.user.all')
            ->with('role', $role)
            ->with('q', $q)
            ->with('record', $record) 
            ->with('items',$items)
            ->with('country', $country)
            ->with('countries', $countries)
            ->with('state', $state)
            ->with('states', $states)
            ->with('title', $title)
            ->with('breadcrumbs', $title);
    }
    
    /**
    * Active User
    *
    * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\User  $user
    * @return \Illuminate\Http\Response
    */
    public function active(Request $request,User $user)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        if($user->id==1){
            return back()->with('error',"Cette action ne peut pas etre réalisée.");
        }
        
        $user->status = 'active';
        $user->save();
        
        try{
            $user->notify(new AccountActivated($user, $status));
        }catch(\Exception $e){

        }
        
        return back()->with('success',"L'utilsateur a été activé avec succés");
    }
    
    /**
    * Disable User
    *
    * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\User  $user
    * @return \Illuminate\Http\Response
    */
    public function disable(Request $request,User $user)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        if($user->id==1){
            return back()->with('error',"Cette action ne peut pas etre réalisée.");
        }
        
        $status = $user->status;
        
        $user->status = 'disabled';
        $user->save();
        
        try{
            $user->notify(new AccountDisabled($user, $status));
        }catch(\Exception $e){

        }
        
        return back()->with('success',"L'utilsateur a été desactivé avec succés");
    }
    
    /**
    * Delete User
    *
    * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\User  $user
    * @return \Illuminate\Http\Response
    */
    public function delete(Request $request,User $user)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        if($user->id==1){
            return back()->with('error',"Cette action ne peut pas etre réalisée.");
        }
        
        $user->delete();
        
        return redirect()->route('admin.dashboard')
            ->with('success',"L'utilsateur a été supprimé avec succés");
    }
}
