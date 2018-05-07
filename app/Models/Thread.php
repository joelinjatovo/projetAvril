<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Eloquent Model to manage ChatMessage
class Thread extends BaseModel
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'threads';
    
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'user_one',
        'user_two',
        'status',
    ];


    /*
     * make a relation between message
     *
     * return collection
     * */
    public function messages()
    {
        return $this->hasMany(ChatMessage::class, 'thread_id')
            ->with('sender');
    }
    
    
    /**
     * Get the sender record associated with the blog.
     */
    public function userone()
    {
        return $this->belongsTo(User::class, 'user_one', 'id');
    }

    
    /**
     * Get the receiver record associated with the blog.
     */
    public function usertwo()
    {
        return $this->belongsTo(User::class, 'user_two', 'id');
    }
    
    
    
    /*
     * check this given user is exists
     *
     * @param   int $id
     * @return  bool
     * */
    public function existsById($id)
    {
        if ($this->find($id)) {
            return true;
        }
        return false;
    }

    /*
     * check this given two users is already make a conversation
     *
     * @param   int $user1
     * @param   int $user2
     * @return  int|bool
     * */
    public function isExistsAmongTwoUsers($user1, $user2)
    {
        $model = Thread::where('user_one', $user1)
            ->where('user_two', $user2);

        if ($model->exists()) {
            return $model->first()->id;
        }

        return false;
    }

    /*
     * check this given user is involved with this given $conversation
     *
     * @param   int $conversationId
     * @param   int $userId
     * @return  bool
     * */
    public function isUserExists($threadId, $userId)
    {
        $exists = Thread::where('id', $threadId)
            ->where(function ($query) use ($userId) {
                $query->where('user_one', $userId)->orWhere('user_two', $userId);
            })
            ->exists();

        return $exists;
    }

    /*
     * retrieve all message thread without soft deleted message with latest one message and
     * sender and receiver user model
     *
     * @param   int $user
     * @param   int $offset
     * @param   int $take
     * @return  collection
     * */
    public function threads($user, $order, $offset, $take)
    {
        $conv = new Thread();
        $conv->authUser = $user;
        $msgThread = $conv->with(['messages' => function ($q) use ($user) {
            return $q->where(function ($q) use ($user) {
                $q->where('user_id', $user)
                        ->where('deleted_from_sender', 0);
            })
                ->orWhere(function ($q) use ($user) {
                    $q->where('user_id', '!=', $user);
                    $q->where('deleted_from_receiver', 0);
                })
            ->latest();
        },'messages.sender', 'userone', 'usertwo'])
            ->where('user_one', $user)
            ->orWhere('user_two', $user)
            ->offset($offset)
            ->take($take)
            ->orderBy('updated_at', $order)
            ->get();

        $threads = [];

        foreach ($msgThread as $thread) {
            $collection = (object) null;
            $conversationWith = ($thread->userone->id == $user) ? $thread->usertwo : $thread->userone;
            $collection->thread = $thread->messages->first();
            $collection->withUser = $conversationWith;
            $threads[] = $collection;
        }

        return collect($threads);
    }

    /*
     * retrieve all message thread with latest one message and sender and receiver user model
     *
     * @param   int $user
     * @param   int $offset
     * @param   int $take
     * @return  collection
     * */
    public function threadsAll($user, $offset, $take)
    {
        $msgThread = Thread::with(['messages' => function ($q) use ($user) {
            return $q->latest();
        }, 'userone', 'usertwo'])
            ->where('user_one', $user)->orWhere('user_two', $user)->offset($offset)->take($take)->get();

        $threads = [];

        foreach ($msgThread as $thread) {
            $conversationWith = ($thread->userone->id == $user) ? $thread->usertwo : $thread->userone;
            $message = $thread->messages->first();
            $message->user = $conversationWith;
            $threads[] = $message;
        }

        return collect($threads);
    }

    /*
     * get all conversations by given conversation id
     *
     * @param   int $conversationId
     * @param   int $userId
     * @param   int $offset
     * @param   int $take
     * @return  collection
     * */
    public function getMessagesById($conversationId, $userId, $offset, $take)
    {
        return Thread::with(['messages' => function ($query) use ($userId, $offset, $take) {
            $query->where(function ($qr) use ($userId) {
                $qr->where('user_id', '=', $userId)
                    ->where('deleted_from_sender', 0);
            })
            ->orWhere(function ($q) use ($userId) {
                $q->where('user_id', '!=', $userId)
                    ->where('deleted_from_receiver', 0);
            });

            $query->offset($offset)->take($take);

        }])->with(['userone', 'usertwo'])->find($conversationId);

    }

    /*
     * get all conversations with soft deleted message by given conversation id
     *
     * @param   int $conversationId
     * @param   int $offset
     * @param   int $take
     * @return  collection
     * */
    public function getMessagesAllById($conversationId, $offset, $take)
    {
        return $this->with(['messages' => function ($q) use ($offset, $take) {
            return $q->offset($offset)
                ->take($take);
        }, 'userone', 'usertwo'])->find($conversationId);
    }

}
