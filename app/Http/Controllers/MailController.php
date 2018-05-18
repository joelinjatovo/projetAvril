<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;

use App\Models\User;
use App\Models\Mail;

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

    public function sendMail(Request $request, User $user = null){
        // Validate request
        $datas = $request->all();
        $validator = Validator::make($datas,[
            'subject' => 'required|max:100',
            'content' => 'required|max:1000'
        ]);

        $current = Auth::user();

        if(!$user||$user->id==0){
            $user = User::ofRole('admin')
                    ->isActive()
                    ->first();
        }
        
        if(!$user){
            return back()->with('error', 'No admin');
        }

        $item = new Mail();
        $item->subject = $request->subject;
        $item->content = $request->content;
        $item->receiver_id = $user->id;
        $item->save();

        $data = array('name'=>"Virat Gandhi");

        try{
            \Mail::send('mail', $data, function($message) use($item) {
                $message->to($item->receiver->email, $item->receiver->name)
                        ->subject($item->subject)
                        ->from($item->sender->email, $item->sender->name);
            });
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Message envoyé avec succes.');
    }

    /**
     * Show a category
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\Category $category
     * @return Illuminate\Http\Response
     */
    public function show(Request $request, Mail $mail)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        return view('admin.mail.index')
                ->with('item', $mail->load('sender')->load('receiver')); 
    }

    /**
     * Show all conversation in admin panel
     *
     * @param  Request $request
     * @return Response
     */
    public function all(Request $request, $filter='all')
    {
      $items = Mail::orderBy('created_at', 'desc')
          ->paginate($this->pageSize);
      return view('admin.mail.all')
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
