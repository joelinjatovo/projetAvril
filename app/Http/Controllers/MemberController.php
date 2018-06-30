<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;

use App\Notifications\NewMail;
use App\Notifications\AplChanged;

use App\Models\Order;
use App\Models\User;
use App\Models\Mail;
use App\Models\MailUser;

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
    public function carts()
    {
        $items = Auth::user()->purchases()
            ->wherePivot('status', 'pinged')
            ->paginate($this->pageSize);
        
        return view('backend.product.all')
            ->with('title', __('member.carts'))
            ->with('items', $items);
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
            ->with('title', __('member.orders'))
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
            ->with('title', __('member.purchases'))
            ->with('items', $items);
    }
    
    

    public function contact(Request $request, $role){
        $action = route('member.contact', ['role'=>$role]);
        
        if(($role=='apl') && !Auth::user()->apl){
            return redirect()->route('member.select.apl')
                ->with('error', 'Vous devez choisir un APL d\'abord.');
        }
        
        return view('backend.contact.member')
            ->with('action', $action)
            ->with('title', __('app.contact_'.$role));
    }

    public function sendMail(Request $request, $role)
    {
        
        if(($role=='apl') && !Auth::user()->apl){
            return redirect()->route('member.select.apl')
                ->with('error', 'Vous devez choisir un APL d\'abord.');
        }
        
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

        if($role=='admin'){
            $receiver = User::ofRole('admin')
                    ->isActive()
                    ->first();
            if(!$receiver){
                return back()->with('error', 'Une erreur est survenue.');
            }
            $to = option('site.admin_email', $receiver->email);
            $toName = option('site.admin_name', $receiver->name);
        }else if($role=='apl'){
            $receiver = $current->apl;
            if(!$receiver||!$receiver->active()){
                return back()->with('error', 'Une erreur est survenue.');
            }
            $to = $receiver->email;
            $toName = $receiver->name;
        }else{
            abort(404);
        }

        $item = new Mail();
        $item->subject = $request->subject;
        $item->content = $request->content;
        $item->status = 'send';
        $item->save();

        $mailUser = new MailUser();
        $mailUser->user_id = $receiver->id;
        $mailUser->mail_id = $item->id;
        $mailUser->save();

        try{
            $receiver->notify(new NewMail($item));
        }catch(\Exception $e){
            // DO nothing
        }
        
        try{
            $data = array('name'=>"Admin");
            \Mail::send('mail', $data, function($message) use($item, $to, $toName) {
                $message->to($to, $toName)
                        ->subject($item->subject)
                        ->from($item->sender->email, $item->sender->name);
            });
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Message envoyé avec succes.');
    }
    
    
    /**
     * Add product in cart
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product
     * @return \Illuminate\Http\Response
     */
    public function selectApl(Request $request){
        $this->middleware('auth');
        $this->middleware('role:member');
        
        $distance = $request->get('distance');
        if(empty($distance)) $distance = 100;
        
        $data = [];
        
        $apls = User::ofRole('apl')
            ->isActive()
            ->has('location')
            ->with('location')
            ->get();
        
        $userApl = Auth::user()->apl;
        
        $selected = null;
        
        foreach($apls as $item){
            $html = view('backend.apl.html')->with('item', $item)->render();
            $dataTemp = [
              'id' => $item->id,
              'lat' => $item->location?$item->location->latitude:0,
              'lng' => $item->location?$item->location->longitude:0,
              'title' => $item->name,
              'content' => $item->get_meta('orga_description')?$item->get_meta('orga_description')->value:'',
              'type' => $item->role,
              'html' => $html,
            ];
            
            $data[] = $dataTemp;
            
            if($userApl && ($item->id == $userApl->id)){
                $selected = $dataTemp;
            }
        }
        
        $action = route('member.select.apl');
    	return view('backend.apl.select')
            ->with('location', Auth::user()->location)
            ->with('action', $action)
            ->with('items', $apls)
            ->with('distance', $distance)
            ->with('distances', $this->distances)
            ->with('selected', json_encode($selected))
            ->with('data', json_encode($data));
    }
    
    
    /**
     * Update APl
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product
     * @return \Illuminate\Http\Response
     */
    public function updateApl(Request $request){
        $this->middleware('auth');
        $this->middleware('role:member');

        $apl = null;
        if($request->has('apl')){
            $apl = User::ofRole('apl')
                ->isActive()
                ->where('id', '=', $request->apl)
                ->first();
        }else{
            return back()->withInput()
                ->with('error','Vous devez choisir un apl.');
        }
        
        // No APL selected
        if(!$apl){
    	   return back()->withInput()
               ->with('error','Vous devez choisir un apl.');
        }
        
        // Update APL
        Auth::user()->apl_id = $apl->id;
        Auth::user()->apl_ends_at = \Carbon\Carbon::now()->addDays(option('payment.apl_ends_at', 180));
        Auth::user()->save();
        
        try{
            Auth::user()->notify(new AplChanged(Auth::user(), false));
        }catch(\Exception $e){}
        
        try{
            $apl->notify(new AplChanged(Auth::user(), true));
        }catch(\Exception $e){}
        
    	return back()
            ->with('success', 'Apl modifié!');
    }


}
