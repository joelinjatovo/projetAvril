<?php

namespace App\Models;


class Message extends BaseModel
{
    
    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'message',
        'is_seen',
        'deleted_from_sender',
        'deleted_from_receiver',
        'user_id',
        'thread_id'
    ];
    
    /*
     * make a relation between thread model
     *
     * @return collection
     * */
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    
    /**
     * A message belong to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
      return $this->belongsTo(User::class);
    }
    
    
    /*
   * its an alias of user relation
   *
   * @return collection
   * */
    public function sender()
    {
        return $this->user();
    }
}
