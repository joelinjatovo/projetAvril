<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Validator;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Mail;
use App\Models\MailUser;

use App\Notifications\NewMail;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
//        /$this->middleware('role:admin');
    }

    /**
     * Show the dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin');
    }

    /**
     * Show the dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $count = [];
        $count['users'] = User::count();
        $count['products'] = Product::count();
        $count['orders'] = Product::ofStatus('ordered')->count();
        $count['sales'] = Product::ofStatus('paid')->count();
        
        $data = [];
        $data['orders'] = \DB::table('products')
          ->select(
            \DB::raw('DATE(created_at) as date'), 
            \DB::raw("COUNT(
                        CASE 
                            WHEN `status` LIKE 'paid' THEN 1 
                        END) as count_1"),
            \DB::raw("COUNT(
                        CASE 
                            WHEN `status` LIKE 'ordered' THEN 1 
                            WHEN `status` LIKE 'paid' THEN 1 
                        END
                        ) as count_2")
          )
          ->groupBy('date')
          ->get()
          ->toArray();
        
        $data['users'] = \DB::table('countries')
            ->join('users', 'users.country_id', '=' , 'countries.id')
            ->select(
                "code_2",
                \DB::raw('COUNT(users.id) as count')
             )
            ->groupBy('code_2')
             ->pluck('count','code_2');
        
        $recent = [];
        $recent['users'] = User::orderBy('created_at', 'desc')
            ->take(8)
            ->get();
        $recent['products'] = Product::orderBy('created_at', 'desc')
            ->ofStatus('published')
            ->take(8)
            ->get();
        $recent['orders'] = Order::orderBy('created_at', 'desc')
            ->take(8)
            ->get();
        
        return view('admin.dashboard.index')
            ->with('recent', $recent)
            ->with('count', $count)
            ->with('data', $data);
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
                return view('admin.dashboard.product');
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
    *
    */
    public function compose(Request $request, Mail $mail = null)
    {
        $this->middleware('auth');
        $this->middleware('auth:admin');
        
        if(!$mail || !$mail->id){
            $mail = new Mail();
        }
        
        $users = User::isActive()
            ->where('id', '<>', \Auth::user()->id)
            ->get();
        
        return view('admin.mail.compose')
            ->with('item', $mail)
            ->with('users', $users);
    }
    
    /*
    *
    */
    public function sendMail(Request $request, Mail $mail = null)
    {
        $this->middleware('auth');
        $this->middleware('auth:admin');
        
        //echo var_dump($request->request);
        //exit;
            
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
        
        if(!$mail || !$mail->id){
            $item = new Mail();
        }else{
            if(($mail->subject == $request->subject) && ($mail->content == $request->content)){
                $item = $mail;
            }else{
                $item = new Mail();
                $item->copied_from = $mail->id;
            }
        }
        
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
        if($request->has('role')){
            $users = User::isActive()
                ->ofRole($request->role)
                ->where('id', '<>', \Auth::user()->id)
                ->get();
            
            foreach($users as $user){
                if(in_array($user->id, $receiverIds)){
                    continue;
                }
                $receiverIds[] = $user->id;
                
                $mailItem = new MailUser();
                $mailItem->mail_id = $item->id;
                $mailItem->user_id = $user->id;
                $mailItem->is_sent = 1;
                $mailItem->read    = 0;
                $mailItem->save();
                
                $sent = true;
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
                }
            }
        }
        
        if($request->has('users')&&is_array($request->users)){
            foreach($request->users as $id){
                if(in_array($id, $receiverIds)){
                    continue;
                }
                
                $user = User::find($id);
                if(!$user){
                    continue;
                }
                
                $receiverIds[] = $id;
                
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
                }
            }
        }
        
        return back()->with('success', 'Messages envoyés avec succes. '.count($receiverIds));
    }

}
