<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;

use App\Models\User;
use App\Models\Mail;
use App\Notifications\NewMail;

class MailController extends Controller
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

    public function contact(Request $request, User $user = null){
        if(!$user||$user->id==0){
            $user = User::ofRole('admin')
                    ->isActive()
                    ->first();
        }

        return view('contact.index')
            ->with('item', $user);
    }

    public function sendMail(Request $request)
    {
        $current = Auth::user();

        // Validate request
        $datas = $request->all();
        $validator = Validator::make($datas,[
            'subject' => 'required|max:100',
            'content' => 'required|max:1000'
        ]);
        
        if($request->has('receiver_id')){
            $receiver = User::find($request->get('receiver_id'));
            $to = $receiver->email;
        }else{
            $receiver = User::ofRole('admin')
                    ->isActive()
                    ->first();
            $to = option('site.admin', $receiver->email);
        }
        
        if(!$receiver){
            return back()->with('error', 'No user selected');
        }

        $item = new Mail();
        $item->subject = $request->subject;
        $item->content = $request->content;
        $item->receiver_id = $receiver->id;
        
        $item->save();
        $receiver->notify(new NewMail($item));

        $data = array('name'=>"Virat Gandhi");

        try{
            \Mail::send('mail', $data, function($message) use($item, $to) {
                $message->to($to)
                        ->subject($item->subject)
                        ->from($item->sender->email, $item->sender->name);
            });
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Message envoyé avec succes.');
    }

    /**
     * Show a mail
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\Mail $mail
     * @return Illuminate\Http\Response
     */
    public function index(Request $request, Mail $mail)
    {
        $this->middleware('auth');
        
        $mail->load('sender')->load('receiver');
        
        if(\Auth::user()->isAdmin()){
            return view('admin.mail.index')
                ->with('item', $mail); 
        }
        
        return view('backend.mail.index')
                ->with('item', $mail); 
    }

    /**
     * Show all conversation in admin panel
     *
     * @param  Request $request
     * @return Response
     */
    public function all(Request $request, $filter='all')
    {
        $user = Auth::user();
        
        $items = Mail::orderBy('created_at', 'desc');
        switch($filter){
            case "inbox":
                $items = $items->where('receiver_id', $user->id);
                break;
            case "outbox":
                $items = $items->where('sender_id', $user->id);
                break;
            case "draft":
                $items = $items->where('receiver_id', $user->id)
                    ->orWhere('sender_id', $user->id);
                break;
            case "all":
                $this->middleware('role:admin');
                break;
        }
        $items = $items->paginate($this->pageSize);
        
        if($user->isAdmin()){
            return view('admin.mail.all')
                ->with('items', $items);
        }
        
        return view('backend.mail.all')
          ->with('items', $items);
    }

    public function basic_email(){
        $data = array('name'=>"Virat Gandhi");
        \Mail::send(['text'=>'mail'], $data, function($message) {
            $message->to('joelinjatovo@gmail.com', 'Tutorials Point')
                ->subject('Laravel Basic Testing Mail');
            $message->from('joelinjatovo@gmail.com','Virat Gandhi');
        });
        echo "Basic Email Sent. Check your inbox.";
    }
    
    public function html_email(){
        $data = array('name'=>"Virat Gandhi");
        \Mail::send('mail', $data, function($message) {
            $message->to('joelinjatovo@gmail.com', 'Tutorials Point')
                ->subject('Laravel HTML Testing Mail');
            $message->from('joelinjatovo@gmail.com','Virat Gandhi');
        });
        echo "HTML Email Sent. Check your inbox.";
    }
    
    public function attachment_email(){
        $data = array('name'=>"Virat Gandhi");
        \Mail::send('mail', $data, function($message) {
            $message->to('joelinjatovo@gmail.com', 'Tutorials Point')
                ->subject('Laravel Testing Mail with Attachment');
            $message->attach('C:\laravelmaster\laravel\public\uploads\image.png');
            $message->attach('C:\laravelmaster\laravel\public\uploads\test.txt');
            $message->from('joelinjatovo@gmail.com','Virat Gandhi');
        });
        echo "Email Sent with attachment. Check your inbox.";
    }
        
}
