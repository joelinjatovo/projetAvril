<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\Thread;
use App\Models\User;

class ChatController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    public function store(Request $request)
    {
        $message = Message::create([
            'message' => $request->message,
            'thread_id' => $request->thread_id,
            'user_id' => auth()->user()->id,
        ]);

        $result = $message->load('user');
        
        broadcast(new MessageSent($message))->toOthers();

        return $result;
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $threads = Thread::all(); //auth()->user()->threads;
        $users = User::where('id', '<>', auth()->user()->id)->get();
        $user = auth()->user();

        return view('chat.thread', ['threads' => $threads, 'users' => $users, 'user' => $user]);
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
            
        $user = \Auth::user();

        $message = Message::create([
            'message' => $request->message,
            'user_id' => $user->id,
            'thread_id' => 0
        ]);


        broadcast(new MessageSent($user, $message))->toOthers();
            

        return ['status' => 'Message Sent!'];
    }
}
