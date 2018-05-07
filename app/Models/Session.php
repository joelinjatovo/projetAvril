<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Auth;

use App\Models\User;

class Session extends BaseModel 
{
    /**
     * {@inheritdoc}
     */
    public $table = 'sessions';

    /**
     * {@inheritdoc}
     */
    public $timestamps = false;

    /**
     * Returns the user that belongs to this entry.
     *
     * @return \App\Models\User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns all the users within the given activity.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $limit
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActivity($query, $limit = 10)
    {
        $lastActivity = strtotime(Carbon::now()->subMinutes($limit));

        return $query->where('last_activity', '>=', $lastActivity);
    }

    /**
     * Returns all the guest users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGuests($query)
    {
        return $query->whereNull('user_id');
    }

    /**
     * Returns all the registered users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRegistered($query)
    {
        return $query->whereNotNull('user_id')->with('user');
    }

    /**
     * Updates the session of the current user.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUpdateCurrent($query)
    {
        $user = Auth::check();

        return $query->where('id', Session::getId())->update([
            'user_id' => $user ? $user->id : null
        ]);
    }
}
