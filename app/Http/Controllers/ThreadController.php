<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Talk\Facades\Talk;
use Auth;

use App\Events\ThreadCreated;
use App\Models\Thread;
use App\Models\User;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request)
    {
        $userId = $request->user_id;
        
        $threadId = Talk::isConversationExists($userId);
        
        if($threadId===false){
            $threadId = Talk::newConversation($userId);
            $thread = Thread::find($threadId);
            
            broadcast(new ThreadCreated($thread))->toOthers();

            return [
                'state' => true,
                'data' => $thread->load('userone', 'usertwo')
            ];
        }
        
        $thread = Thread::find($threadId);
        return [
                'state' => false,
                'data' => $thread->load('userone', 'usertwo')
            ];
    }

    /**
     * Show a category
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\Category $category
     * @return Illuminate\Http\Response
     */
    public function show(Request $request, Thread $thread)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        return view('admin.chat.index')
                ->with('item', $thread->load('messages')); 
    }

    /**
     * Show all conversation in admin panel
     *
     * @param  Request $request
     * @return Response
     */
    public function all(Request $request, $filter='all')
    {
      $items = Thread::orderBy('created_at', 'desc')
          ->paginate($this->pageSize);
      return view('admin.chat.all')
          ->with('items', $items);
    }
}
