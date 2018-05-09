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
}
