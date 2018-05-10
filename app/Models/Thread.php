<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
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
        return $this->hasMany(Message::class, 'thread_id')
            ->orderBy('created_at', 'desc')
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
    
}
