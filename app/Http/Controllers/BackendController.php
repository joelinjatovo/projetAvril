<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use Validator;

use App\Models\Sale;
use App\Models\Image;
use App\Models\Mail;
use App\Models\MailUser;
use App\Models\User;

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
    }

    /**
     * Show the dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        $view = view('backend.dashboard.'.$user->role)
            ->with('title', __('app.dashboard'))
            ->with('item', $user);
        
        $recent = [];
        $count  = [];
        
                
        $count['pins']  = $user->pins()->count();
        $recent['pins'] = $user->pins()
            ->orderBy('created_at', 'desc')
            ->take($this->recentSize)
            ->get();

        $count['favorites']  = $user->favorites()->count();
        $recent['favorites'] = $user->favorites()
            ->orderBy('created_at', 'desc')
            ->take($this->recentSize)
            ->get();
        
        switch($user->role){
            case 'member':
                $sale = Session::has('sale') ? Session::get('sale') : null;
                $view->with('sale', $sale);
                
                $count['orders']  = $user->purchases()->wherePivot('status', 'ordered')->count();
                $recent['orders'] = $user->purchases()
                    ->wherePivot('status', 'ordered')
                    ->orderBy('created_at', 'desc')
                    ->take($this->recentSize)
                    ->get();
                
                $count['purchases']  = $user->purchases()->wherePivot('status', 'paid')->count();
                $recent['purchases'] = $user->purchases()
                    ->wherePivot('status', 'paid')
                    ->orderBy('created_at', 'desc')
                    ->take($this->recentSize)
                    ->get();
                break;
            case 'apl':
                $count['customers']  = $user->customers()->count();
                $recent['customers'] = $user->customers()
                    ->isActive()
                    ->ofRole('member')
                    ->orderBy('created_at', 'desc')
                    ->take($this->recentSize)
                    ->get();
                
                $count['orders']  = $user->sales()->wherePivot('status', 'ordered')->count();
                $recent['orders'] = $user->sales()
                    ->wherePivot('status', 'ordered')
                    ->orderBy('created_at', 'desc')
                    ->take($this->recentSize)
                    ->get();
                
                $count['sales']  = $user->sales()->wherePivot('status', 'paid')->count();
                $recent['sales'] = $user->sales()
                    ->wherePivot('status', 'paid')
                    ->orderBy('created_at', 'desc')
                    ->take($this->recentSize)
                    ->get();
                break;
            case 'afa':
                $count['orders']  = $user->sales()->wherePivot('status', 'ordered')->count();
                $recent['orders'] = $user->sales()
                    ->wherePivot('status', 'ordered')
                    ->orderBy('created_at', 'desc')
                    ->take($this->recentSize)
                    ->get();
                
                $count['sales']  = $user->sales()->wherePivot('status', 'paid')->count();
                $recent['sales'] = $user->sales()
                    ->wherePivot('status', 'paid')
                    ->orderBy('created_at', 'desc')
                    ->take($this->recentSize)
                    ->get();
                break;
            case 'seller':
                $count['products']  = $user->products()->count();
                $recent['products'] = $user->products()
                    ->orderBy('products.created_at', 'desc')
                    ->take($this->recentSize)
                    ->get();
                
                $count['orders']  = $user->products()->where('products.status', 'ordered')->count();
                $recent['orders'] = $user->products()
                    ->where('products.status', 'ordered')
                    ->orderBy('products.created_at', 'desc')
                    ->take($this->recentSize)
                    ->get();
                
                $count['sales']  = $user->products()->where('products.status', 'paid')->count();
                $recent['sales'] = $user->products()
                    ->where('products.status', 'paid')
                    ->orderBy('products.created_at', 'desc')
                    ->take($this->recentSize)
                    ->get();
                break;
        } 
        
        $view->with('count', $count);
        $view->with('recent', $recent);
        return $view;
    }
    
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function favorites()
    {
        $items = Auth::user()->favorites()
            ->paginate($this->pageSize);
        
        return view('backend.product.all')
            ->with('title', __('app.favorites'))
            ->with('items', $items);
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function pins()
    {
        $items = Auth::user()->pins()
            ->paginate($this->pageSize);
        
        return view('backend.product.all')
            ->with('title', __('app.pins'))
            ->with('items', Auth::user()->pins)
            ->with('items', $items);
    }
    
    
    
    
    /*
    *
    *
    */
    public function contact(Request $request, User $user)
    {
        if(!Auth::user()->canContact($user)){
            abort(404);
        }
        
        $mail = new Mail();
        if($value = $request->old('subject'))    $mail->subject = $value;
        if($value = $request->old('content'))    $mail->content = $value;
        
        return view('backend.user.contact')
            ->with('title', __('app.contact_user', ['name'=>$user->name, "email"=>$user->email]))
            ->with('action', route(Auth::user()->role.'.user.contact', $user))
            ->with('item', $user)
            ->with('mail', $mail);
    }
    
    /*
    *
    */
    public function postContact(Request $request, User $user)
    {
        if(!Auth::user()->canContact($user)){
            abort(404);
        }
        
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

}
