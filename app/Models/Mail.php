<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Mail extends BaseModel
{
    use SoftDeletes;
    
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
     * Filter badwords
     *
     * @param int $length
     * @return String
     */
    public function filter()
    {
        $content = $this->content;
        $badwords = BadWord::get();
        foreach($badwords as $badword){
            $content = str_ireplace($badword->content, '*****', $content);
        }
        return $content;
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
    
    /**
     * An user can have many mails with mails_users pivot table
     *
     * @return \Illuminate\Database\Eloquent\Relations\ManyToMany
     */
    public function users()
    {
      return $this->belongsToMany(User::class, 'mails_users', 'mail_id', 'user_id');
    }
}
