<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Eloquent Model to manage ChatMessage
class ChatMessage extends Model
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
    protected $fillable = ['user_id', 'message'];
}
