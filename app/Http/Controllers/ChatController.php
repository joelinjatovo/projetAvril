<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Session;
use App\Models\ChatMessage;

class ChatController extends Controller
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
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('chat.index');
    }

    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function chat(Request $request, User $user)
    {
        if($request->ajax())
        {
          $message = ChatMessage::create([
            'message' => $request->input('message'),
            'user_from' => \Auth::user()->id,
            'user_to' => $user->id,
          ]);

          return response()->json(['status' => 'Message Sent!', 'content'=>$message->message]);
        }
        $items = ChatMessage::orderBy('created_at', 'desc')
            ->where('user_from', \Auth::user()->id)
            ->orWhere('user_to', \Auth::user()->id)
            ->take(5)->get();
        
        $sessions = Session::activity(10)->get();
        
        return view('chat.chat')
          ->with('sessions', $sessions)
          ->with('items', $items)
          ->with('from', \Auth::user())
          ->with('to', $user);
    }

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages()
    {
      return Message::with('user')->get();
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
      $user = Auth::user();

      $message = $user->messages()->create([
        'message' => $request->input('message')
      ]);

      return ['status' => 'Message Sent!'];
    }

    /**
     * Show all message i admin panel
     *
     * @param  Request $request
     * @return Response
     */
    public function all(Request $request, $filter='all')
    {
      $items = ChatMessage::orderBy('created_at', 'desc')->get();
      return view('admin.chat.all')
          ->with('items', $items);
    }

    /**
    * Delete Message
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\ChatMessage  $chat
    * @return \Illuminate\Http\Response
    */
    public function delete(Request $request,ChatMessage $chat)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $chat->delete();
        return redirect()->route('admin.dashboard')
            ->with('success',"Le message a été supprimé avec succés");
    }
}
