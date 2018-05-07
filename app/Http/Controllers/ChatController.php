<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
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
          $user = Auth::user();

          $message = ChatMessage::create([
            'message' => $request->input('message'),
            'user_from' => \Auth::user()->id,
            'user_to' => $user->id,
          ]);

          return response()->json(['status' => 'Message Sent!', 'content'=>$message->message]);
        }
        $items = ChatMessage::all();
        return view('chat.chat')
          ->with('items', $items)
          ->with('from',\Auth::user())
          ->with('to',$user);
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
}
