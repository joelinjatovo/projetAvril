<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Talk\Facades\Talk;


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
    public function index()
    {
        $user = auth()->user();
        
        $threads = Thread::with('userone')
            ->with('usertwo')
            ->where('user_one', $user->id)
            ->orWhere('user_two', $user->id)
            ->get();
        
        $users = User::where('id', '<>', auth()->user()->id);
        if($user->role=='member'){
            $users->where('role', '<>', 'seller')
                ->where('role', '<>', 'member')
                ->where('role', '<>', 'afa');
        }
        
        if($user->role=='seller'){
            $users->where('role', '<>', 'member');
        }
        
        $users = $users->get();

        if(\Auth::user()->isAdmin()){
            return view('chat.admin', ['threads' => $threads, 'users' => $users, 'user' => $user]);
        }
        
        return view('chat.thread', ['threads' => $threads, 'users' => $users, 'user' => $user]);
    }
}
