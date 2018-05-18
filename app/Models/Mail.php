<?php

namespace App\Models;

use Auth;

class Mail extends BaseModel
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mails';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject', 'content', 'receiver_id', 'sender_id',
    ];
    
    /**
     * Create a new model instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->sender_id = (Auth::check()?Auth::user()->id:0);
    }
    
    /**
     * Excerpt
     *
     * @param int $length
     * @return String
     */
    public function excerpt($length = 100)
    {
        return substr($this->content, 0, $length);
    }
    
    /**
     * Get the sender associated with the mail.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }
    
    /**
     * Get the receiver associated with the mail.
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }
}
