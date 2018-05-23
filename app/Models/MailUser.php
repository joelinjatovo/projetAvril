<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailUser extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mails_users';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'mail_id', 'is_sent', 'read'];
    
    /**
     * Create a new model instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
