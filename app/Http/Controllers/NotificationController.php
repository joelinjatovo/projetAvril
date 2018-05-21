<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
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
     * Show all notification
     *
     * @param  Request $request
     * @return Response
     */
    public function all(Request $request, $filter='all')
    {
        $user = \Auth::user();
        
        return $user->unreadNotifications()
            ->limit(5)
            ->get()
            ->toArray();
        
        switch($filter){
            case 'unread':
                $items = $user->unreadNotifications()
                    ->limit(5)
                    ->get()
                    ->toArray();
                break;
            default:
            case 'all':
                $items = $user->notifications()
                    ->get()
                    ->toArray();
                break;
        }
        return $items;
    }

    /**
     * Mark as read
     *
     * @param  Request $request
     * @return Response
     */
    public function markAsRead(Request $request)
    {
        $user = \Auth::user();
        $user->unreadNotifications->markAsRead();
        return [
            'state'=>1,
        ];
    }
}
