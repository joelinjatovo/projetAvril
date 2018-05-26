<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
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
     * Show the dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('admin.dashboard.index');
    }

    /**
     * Show the dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function chart($type)
    {
        switch($type){
            case "product":
                return view('admin.dashboard.index');
            case "user":
                return view('admin.dashboard.user');
            case "member":
                return view('admin.dashboard.member');
            case "afa":
                return view('admin.dashboard.afa');
            case "apl":
                return view('admin.dashboard.apl');
            case "seller":
                return view('admin.dashboard.seller');
            case "cart":
                return view('admin.dashboard.cart');
            default:
                abort(404);
                
        }
    }
    
    /*
    *
    */
    public function compose(Request $request)
    {
        $this->middleware('auth');
        $this->middleware('auth:admin');
        
        $users = User::isActive()
            ->where('id', '<>', \Auth::user()->id)
            ->get();
        
        return view('admin.mail.compose')
            ->with('items', $users);
    }
    
    /*
    *
    */
    public function sendMail(Request $request)
    {
        $this->middleware('auth');
        $this->middleware('auth:admin');
            
        // Validate request
        $datas = $request->all();
        $validator = Validator::make($datas,[
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
        $item->receiver_id = 0;
        $item->save();

        $receiverIds = [];
        if($request->has('role')){
            $users = User::isActive()
                ->ofRole($request->role)
                ->where('id', '<>', \Auth::user()->id)
                ->get();
            
            foreach($users as $user){
                if($in_array($user->id, $receiverIds)){
                    continue;
                }
                
                $sent = true;
                try{
                    $data = array('name'=>"Virat Gandhi");
                    \Mail::send('mail', $data, function($message) use($mailItem, $user, $item) {
                        $message->to($user->email, $user->name)
                                ->subject($item->subject)
                                ->from($user->email, $user->name);
                    });
                }catch(\Exception $e){
                    $sent = false;
                }
                
                $mailItem = new MailUser();
                $mailItem->mail_id = $item->id;
                $mailItem->user_id = $user->id;
                $mailItem->is_sent = ($sent?1:0);
                $mailItem->read    = 0;
                $mailItem->save();
            }
        }
        
        if($request->has('users')){
            foreach($request->users as $id){
                if($in_array($id, $receiverIds)){
                    continue;
                }
                
                $user = User::find($id);
                if(!$user){
                    continue;
                }
                
                $sent = true;
                try{
                    $data = array('name'=>"Virat Gandhi");
                    \Mail::send('mail', $data, function($message) use($mailItem, $user, $item) {
                        $message->to($user->email, $user->name)
                                ->subject($item->subject)
                                ->from($user->email, $user->name);
                    });
                }catch(\Exception $e){
                    $sent = false;
                }
                
                $mailItem = new MailUser();
                $mailItem->mail_id = $item->id;
                $mailItem->user_id = $user->id;
                $mailItem->is_sent = ($sent?1:0);
                $mailItem->read    = 0;
                $mailItem->save();
            }
        }
        
        return back()->with('success', 'Messages envoyés avec succes.');
    }

}
