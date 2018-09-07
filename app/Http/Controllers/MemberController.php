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
     * Liste des commandes en attente
     *
     * @return \Illuminate\Http\Response
     */
    public function carts()
    {
        $items = Auth::user()->orders()
            ->where('status', 'pinged')
            ->paginate($this->pageSize);
        
        return view('member.cart.all')
            ->with('title', __('member.carts'))
            ->with('items', $items);
    }

    /**
     * Liste des commandes en cours d'achat effectue par le client
     *
     * @return \Illuminate\Http\Response
     */
    public function orders()
    {
        $items = Auth::user()->orders()
            ->where('status', 'ordered')
            ->paginate($this->pageSize);
        
        return view('member.cart.all')
            ->with('title', __('member.orders'))
            ->with('items', $items);
    }

    /**
     * Liste des achats effectues par le client
     *
     * @return \Illuminate\Http\Response
     */
    public function purchases()
    {
        $items = Auth::user()->orders()
            ->where('status', 'paid')
            ->paginate($this->pageSize);
        
        return view('member.cart.all')
            ->with('title', __('member.purchases'))
            ->with('items', $items);
    }

    /**
    * Contact APL
    */
    public function contact(Request $request){
        $action = route('member.contact');
        
        if(!Auth::user()->apl){
            return redirect()->route('member.select.apl')
                ->with('error', 'Vous devez choisir un APL d\'abord.');
        }
        
        return view('member.contact')
            ->with('action', $action)
            ->with('title', __('app.contact_apl'));
    }

    public function sendMail(Request $request)
    {
        if(!Auth::user()->apl){
            return redirect()->route('member.select.apl')
                ->with('error', 'Vous devez choisir un APL d\'abord.');
        }

        // Validate request
        $datas = $request->all();
        $validator = Validator::make($datas,[
            'subject' => 'required|max:100',
            'content' => 'required|max:1000',
            //'files.*' => 'mimes:jpeg,jpg,png,gif,svg|max:2048',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        $current = Auth::user();
        $receiver = $current->apl;
        if(!$receiver||!$receiver->active()){
            return back()->with('error', 'Une erreur est survenue.');
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
        }catch(\Exception $e){}
        
        $files = $request->file('files');
        if(!$files){
            $files = [];
        }
        
        $to = $receiver->email;
        $toName = $receiver->name;
        
        try{
            \Mail::to($to, $toName)->send(new \App\Mail\Email($item, $mailItem, $files));
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
        
        if(!$request->input('confirm')){
            return back()->withInput()
               ->with('error','Vous devez accepter les termes et les conditions.');
        }
        
        // Update APL
        Auth::user()->apl_id = $apl->id;
        Auth::user()->apl_ends_at = \Carbon\Carbon::now()->addDays(option('payment.apl_ends_at', 180));
        Auth::user()->save();
        
        try{
            Auth::user()->notify(new AplChanged(Auth::user(), $apl));
        }catch(\Exception $e){}
        
        try{
            $apl->notify(new AplChanged($apl, Auth::user()));
        }catch(\Exception $e){}
        
    	return back()
            ->with('success', 'Apl modifié!');
    }


}
