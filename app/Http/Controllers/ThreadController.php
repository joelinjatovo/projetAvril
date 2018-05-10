<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Events\ThreadCreated;
use App\Models\Thread;

class ThreadController extends Controller
{
    public function store(Request $request)
    {
        $thread = Thread::create([
            'user_two' => $request->user_id,
            'user_one' => auth()->user()->id,
            'status' => 1,
        ]);

        broadcast(new ThreadCreated($thread))->toOthers();

        return $thread;
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
      $items = Thread::orderBy('created_at', 'desc')->get();
      return view('admin.chat.all')
          ->with('items', $items);
    }
}
