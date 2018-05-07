<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Eloquent Model to manage ChatMessage
class ChatMessage extends BaseModel
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'chat_messages';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message',
        'is_seen',
        'deleted_from_sender',
        'deleted_from_receiver',
        'user_id',
        'thread_id',
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

    /*
   * make a relation between user model
   *
   * @return collection
   * */
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
    
    
    public function deleteMessages($threadId)
    {
        $delete = Message::where('thread_id', $threadId)->delete();
        if ($delete) {
            return true;
        }

        return false;
    }

    public function softDeleteMessage($messageId, $authUserId)
    {
        $message = $this->with(['thread' => function ($q) use ($authUserId) {
            $q->where('user_one', $authUserId);
            $q->orWhere('user_two', $authUserId);
        }])->find($messageId);

        if (is_null($message->conversation)) {
            return false;
        }

        if ($message->user_id == $authUserId) {
            $message->deleted_from_sender = 1;
        } else {
            $message->deleted_from_receiver = 1;
        }

        return (boolean) $this->update($message);
        
    }

}
