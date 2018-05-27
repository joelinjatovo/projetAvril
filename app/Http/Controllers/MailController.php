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
        //
    }

    public function index(Request $request){
        if($request->isMethod('post')){
            // Validate request
            $datas = $request->all();
            $validator = Validator::make($datas,[
                'email'   => 'required|email|max:100',
                'name'    => 'required|max:100',
                'subject' => 'required|max:100',
                'content' => 'required|max:1000'
            ]);
            
            if ($validator->fails()) {
                return back()->withErrors($validator)
                            ->withInput();
            }
            
            try{
                $data = array('name'=>"Virat Gandhi");
                $to = option('site.admin_email', env('ADMIN_MAIL'));
                $to_name = option('site.admin_name', 'admin');
                $name = $request->name;
                $email = $request->email;
                $subject = $request->subject;

                \Mail::send('mail', $data, function($message) use($subject, $email, $name, $to, $to_name) {
                    $message->to($to, $to_name)
                            ->subject($subject)
                            ->from($email, $name);
                });

            }catch(\Exception $e){
                return back()->with('error', $e->getMessage());
            }
            return back()->with('success', 'Message envoyé avec succes.');
        }
        
        $locale = \App::getLocale();
        $content = \App\Models\Config::login()->get_meta_array('content', $locale);
        $address = \App\Models\Config::login()->get_meta_array('address', $locale);
        $contact = \App\Models\Config::login()->get_meta_array('contact', $locale);
        return view('index.contact')
            ->with('title', __('app.send_mail'))
            ->with('content', $content)
            ->with('address', $address)
            ->with('contact', $contact);
    }

    public function read(Request $request, MailUser $mailuser)
    {
        $mailuser->read = 1;
        $mailuser->save();
        
        $path = storage_path('app/public/logo.png');
        if (!File::exists($path)) {
            abort(404);
        }
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }

    public function contact(Request $request, User $user)
    {
        $this->middleware('auth');
        return view('admin.mail.contact')
            ->with('item', $user);
    }

    public function sendMail(Request $request, User $user = null)
    {
        $this->middleware('auth');
        $current = Auth::user();

        // Validate request
        $datas = $request->all();
        $validator = Validator::make($datas,[
            'receiver_id' => 'required',
            'subject' => 'required|max:100',
            'content' => 'required|max:1000'
        ]);
        
        
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        $receiver = User::findOrFail($request->get('receiver_id'));
        $to = $receiver->email;
        
        $item = new Mail();
        $item->subject = $request->subject;
        $item->content = $request->content;
        $item->receiver_id = $receiver->id;
        
        $item->save();

        try{
            $receiver->notify(new NewMail($item));
        }catch(\Exception $e){
            // Do nothing
        }
        
        try{
            $data = array('name'=>"Virat Gandhi");
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
    public function view(Request $request, Mail $mail)
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
        
        $title = __('app.admin.mail.list');
        
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
        
        $record = $request->get('record');
        if(!$record) $record = $this->pageSize;
        
        $q = $request->get('q');
        $q = trim($q);
        if($q){
            $items = $items->where(function($query) use($q){
                return $query->orWhere('subject', 'LIKE', '%'.$q.'%')
                    ->orWhere('content', 'LIKE', '%'.$q.'%');
            });
        }
        
        $receiver = $request->get('receiver');
        $receiver = intval($receiver);
        if($receiver){
            $items = $items->where(function($query) use($receiver){
                return $query->orWhere('receiver_id', $receiver)
                    ->orWhere('sender_id', $receiver);
            });
        }
        
        
        if($user->isAdmin()){
            $view = view('admin.mail.all');
            
            $view->with('users', User::all());
            
        }else{
            $view = view('backend.mail.all');
            
            switch(Auth::user()->role){
                case 'apl':
                    $view->with('users', User::active()->get());
                break;
                case 'afa':
                    $view->with('users', User::active()
                                ->where(function($query){
                                    return $query->where('role', 'admin')
                                        ->orWhere('role', 'apl');
                                })->get());
                break;
                case 'seller':
                    $view->with('users', User::active()
                                ->where(function($query){
                                    return $query->where('role', 'admin')
                                        ->orWhere('role', 'apl');
                                })->get());
                break;
                case 'member':
                    $view->with('users', User::active()
                                ->where(function($query){
                                    return $query->where('role', 'admin')
                                        ->orWhere('role', 'apl');
                                })->get());
                break;
            }
        }
        
        $items = $items->paginate($record);
        
        return $view->with('items', $items)
            ->with('q', $q) 
            ->with('record', $record) 
            ->with('title', $title)
            ->with('receiver', $receiver);
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
