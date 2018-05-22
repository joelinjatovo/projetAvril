<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\User;

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
            ->with('title', __('app.'.$user->role));
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
        
        switch($filter){
            case 'admin':
            case 'apl':
            case 'afa':
            case 'member':
            case 'seller':
                $title = __('app.user.list.role', ['role'=>__('app.'.$filter)]);
                $items = User::ofRole($filter)
                    ->isActive()
                    ->paginate($this->pageSize);
                break;
            case 'person':
            case 'organization':
                $title = __('app.user.list.type', ['type'=>__('app.'.$filter)]);
                $items = User::ofType($filter)
                    ->isActive()
                    ->paginate($this->pageSize);
                break;
            case 'active':
            case 'pinged':
            case 'disabled':
            case 'blocked':
                $title = __('app.user.list.status', ['status'=>__('app.'.$filter)]);
                $items = User::ofStatus($filter)
                    ->paginate($this->pageSize);
                break;
            default:
            case 'all':
                $title = __('app.admin.user.list');
                $items = User::paginate($this->pageSize);
                break;
        }
        
        return view('admin.user.all')
            ->with('items',$items)
            ->with('title', $title); 
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
        
        return back()->with('success',"L'utilsateur a été activé avec succés");
    }
    
    /**
    * Block User
    *
    * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\User  $user
    * @return \Illuminate\Http\Response
    */
    public function block(Request $request,User $user)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        if($user->id==1){
            return back()->with('error',"Cette action ne peut pas etre réalisée.");
        }
        
        $this->middleware('auth');
        $this->middleware('role:admin');
        $user->status = 'blocked';
        $user->save();
        
        return back()->with('success',"L'utilsateur a été bloqué avec succés");
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
        
        $user->status = 'disabled';
        $user->save();
        
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
