<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\Order;

class MemberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:member');
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function showCart(Cart $cart)
    {
        return view('backend.cart.index')
            ->with('title', __('app.cart'))
            ->with('item', $cart);
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function orders()
    {
        $items = Auth::user()->purchases()
            ->wherePivot('status', 'ordered')
            ->paginate($this->pageSize);
        
        return view('backend.product.all')
            ->with('title', __('app.orders'))
            ->with('items', $items);
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function purchases()
    {
        $items = Auth::user()->purchases()
            ->wherePivot('status', 'paid')
            ->paginate($this->pageSize);
        
        return view('backend.product.all')
            ->with('title', __('app.purchases'))
            ->with('items', $items);
    }
    
    

    public function contactAdmin(Request $request){
        return view('backend.mail.admin')
            ->with('title', __('app.contact_admin'));
    }

    public function sendMailAdmin(Request $request)
    {
        $current = Auth::user();

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

        $receiver = User::ofRole('admin')
                ->isActive()
                ->first();
        
        if(!$receiver){
            return back()->with('error', 'No user selected');
        }
        
        $to = option('site.admin', $receiver->email);

        $item = new Mail();
        $item->subject = $request->subject;
        $item->content = $request->content;
        $item->receiver_id = $receiver->id;
        
        $item->save();

        try{

            $data = array('name'=>"Virat Gandhi");
            
            \Mail::send('mail', $data, function($message) use($item, $to) {
                $message->to($to)
                        ->subject($item->subject)
                        ->from($item->sender->email, $item->sender->name);
            });
            
        
            $receiver->notify(new NewMail($item));
            
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Message envoyé avec succes.');
    }

}
