<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use AstritZeqiri\Metadata\Traits\HasManyMetaDataTrait;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable;
    use Billable;
    use HasManyMetaDataTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image_id', 'location_id', 'status', 'type', 'role', 
        'activation_code', 
        'use_default_password',
        'trial_ends_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be a date
     *
     * @var array
     */
    protected $dates = ['apl_ends_at', 'trial_ends_at', 'subscription_ends_at'];
    
    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $events = [
        //'saved' => UserSaved::class,
        //'deleted' => UserDeleted::class,
    ];
    
    /**
     * Route notifications for the mail channel.
     *
     * @return string
     */
    public function routeNotificationForMail()
    {
        return 'joelinjatovo@gmail.com';
    }
    
    /**
     * Scope a query to only include users of a given $role.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $role
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfRole($query, $role)
    {
        return $query->where('role', $role);
    }
    
    /**
     * Scope a query to only include users of a given $type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
    
    /**
     * Scope a query to only include users of a given $status.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfStatus($query, $status)
    {
        return $query->where('status', $status);
    }
    
    /**
     * Scope a query to only include users is active
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsActive($query)
    {
        return $query->where('status', 'active');
    }
    
    /**
     * Scope a query to only include users has Location
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasLocation($query)
    {
        return $query->where('location_id', '>', '0');
    }
    
    /**
     * Is current user can contact $user
     *
     * @return Boolean
     */
    public function canContact(User $user)
    {
       if($this->isAdmin())
           return true;
        
        if(!$user->active())
            return false;
        
        
        if($this->hasRole('afa')){
            return !$user->hasRole('member');
        }
        
        if($this->hasRole('seller')){
            return !$user->hasRole('member');
        }
        
        
        if($this->hasRole('member')){
            if($user->hasRole('apl')){
                return $this->apl && ($this->apl->id == $user->id);
            }
            
            return $user->hasRole('admin');
        }
        
        if($this->hasRole('apl')){
            if($user->hasRole('member')){
                return $user->apl && ($user->apl->id == $this->id);
            }
            
            return true;
        }
    }
    
    /**
     * Is user active
     *
     * @return Boolean
     */
    public function active()
    {
      return ($this->status == 'active');
    }
    
    /**
     * Is user online
     *
     * @return Boolean
     */
    public function isOnline()
    {
      return $this->sessions()->activity()->exists();
    }
    
    /**
     * Is user admin
     *
     * @return Boolean
     */
    public function isAdmin()
    {
      return $this->hasRole('admin');
    }
    
    /**
     * A user is admin || AFA || APL || member
     *
     * @return Boolean
     */
    public function hasRole($role)
    {
      return ($this->role == $role);
    }
    
    /**
     * A user is person
     *
     * @return Boolean
     */
    public function isPerson()
    {
      return $this->hasRole('member')&&($this->type=='person');
    }
    
    /**
     * A user is member and has apl
     *
     * @return Boolean
     */
    public function hasApl()
    {
      return $this->hasRole('member')
              &&$this->apl
              &&(!empty($this->apl_ends_at))
              &&($this->apl_ends_at>=\Carbon\Carbon::now());
    }
    
    /**
     * Get Url of Attached Image OR Default Image
     *
     * @param Boolean $thumb
     * @return String
     */
    public function imageUrl($thumb=false)
    {
        // Image is setted
        if($this->image){
            if($thumb) return thumbnail($this->image->filepath);
            return storage($this->image->filepath);
        } 
        return asset('images/avatar.png');
    }
    
    /**
     * A user can have one image
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image()
    {
      return $this->hasOne(Image::class, 'id', 'image_id');
    }
    
    /**
     * A user can have one parent
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function author()
    {
      return $this->hasOne(User::class, 'id', 'author_id');
    }
    
    /**
     * A user can have one default APL
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function apl()
    {
      return $this->hasOne(User::class, 'id', 'apl_id');
    }
    
    /**
     * A user can have one location
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function location()
    {
      return $this->hasOne(Localisation::class, 'id', 'location_id');
    }
    
    /**
     * A user can have many session
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sessions()
    {
      return $this->hasMany(Session::class, 'user_id', 'id');
    }
    
    /**
     * A user can have many observation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function observations()
    {
      return $this->hasMany(Observation::class, 'user_id', 'id');
    }
    
    /**
     * A user can have many messages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
      return $this->hasMany(Message::class, 'user_id', 'id');
    }
    
    /**
     * An admin user can have many blogs
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blogs()
    {
      return $this->hasMany(Blog::class, 'author_id', 'id');
    }
    
    
    /**
     * A user can have many comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
      return $this->hasMany(Comment::class, 'author_id', 'id');
    }
    
    /**
     * An admin can have many products
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function adminProducts()
    {
      return $this->hasMany(Product::class, 'author_id', 'id');
    }
    
    /**
     * A seller can have many products to sell
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
      return $this->hasMany(Product::class, 'seller_id', 'id');
    }
    
    /**
     * An APL can have many clients
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customers()
    {
      return $this->hasMany(User::class, 'apl_id', 'id');
    }
    
    /**
     * An many user can have many products from labels table
     *
     * @return \Illuminate\Database\Eloquent\Relations\ManyToMany
     */
    public function pins()
    {
      return $this->belongsToMany(Product::class, 'labels', 'author_id', 'product_id')
          ->wherePivot('label', 'saved');
    }
    
    /**
     * An many user can have many products from labels table
     *
     * @return \Illuminate\Database\Eloquent\Relations\ManyToMany
     */
    public function favorites()
    {
      return $this->belongsToMany(Product::class, 'labels', 'author_id', 'product_id')
          ->wherePivot('label', 'starred');
    }
    
    /**
     * An Client can have many orders
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        if($this->hasRole('member')) return $this->hasMany(Sale::class, 'author_id', 'id');
        if($this->hasRole('apl'))    return $this->hasMany(Sale::class, 'apl_id', 'id');
        if($this->hasRole('afa'))    return $this->hasMany(Sale::class, 'afa_id', 'id');
        return null;
    }
    
    /**
     * An Client can have many searches
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function searches()
    {
      return $this->hasMany(Search::class, 'author_id', 'id');
    }
    
    /**
     * An many afa/apl can have many products from sales table
     *
     * @return \Illuminate\Database\Eloquent\Relations\ManyToMany
     */
    public function sales()
    {
        if($this->hasRole('afa')){
            return $this->belongsToMany(Product::class, 'sales', 'afa_id', 'product_id');
        }
        // else APL
        return $this->belongsToMany(Product::class, 'sales', 'apl_id', 'product_id');
    }
    
    /**
     * An many clients can buy many products from sales table
     *
     * @return \Illuminate\Database\Eloquent\Relations\ManyToMany
     */
    public function purchases()
    {
      return $this->belongsToMany(Product::class, 'sales', 'author_id', 'product_id');
    }
    
    /**
     * An user can have many mails with mails_users pivot table
     *
     * @return \Illuminate\Database\Eloquent\Relations\ManyToMany
     */
    public function mails()
    {
      return $this->belongsToMany(Mail::class, 'mails_users', 'user_id', 'mail_id');
    }
    
    /*
    * Alias to get_meta()->value
    *
    */
    public function meta($key, $default = '')
    {
        $meta = $this->get_meta($key);
        if(!$meta) return $default;

        return $meta->value;
        
    }
    
    /*
    * Handle request to update_meta
    *
    * @param \Illuminate\Http\Request $request
    */
    public function handles(\Illuminate\Http\Request $request)
    {
        $user = $this;
        $role = $request->input('role');
        switch($this->role){
            case 'admin':
                if($value = $request->input('first_name'))
                    $user->update_meta("first_name", $value);
                if($value = $request->input('last_name'))
                    $user->update_meta("last_name", $value);
                break;
            case 'member':
                $type=$request->input('type');
                if($type=='person'){
                    // Update MetaData
                    if($value = $request->input('first_name'))
                        $user->update_meta("first_name", $value);
                    if($value = $request->input('last_name'))
                        $user->update_meta("last_name", $value);
                }else{
                    // Update MetaData
                    if($value = $request->input('orga_name'))
                        $user->update_meta("orga_name", $value);
                    if($value = $request->input('orga_presentation'))
                        $user->update_meta("orga_presentation", $value);
                    if($value = $request->input('prefixPhone'))
                        $user->update_meta("prefixPhone", $value);
                    if($value = $request->input('phone'))
                        $user->update_meta("phone", $value);
                }
                break;
            case 'afa':
                // Update MetaData
                if($value = $request->input('orga_name'))
                    $user->update_meta("orga_name", $value);
                if($value = $request->input('orga_presentation'))
                    $user->update_meta("orga_presentation", $value);
                if($value = $request->input('orga_email'))
                    $user->update_meta("orga_email", $value);
                if($value = $request->input('orga_phone'))
                    $user->update_meta("orga_phone", $value);
                if($value = $request->input('orga_website'))
                    $user->update_meta("orga_website", $value);
                if($value = $request->input('orga_operation_state'))
                    $user->update_meta("orga_operation_state", $value);
                if($value = $request->input('orga_operation_range'))
                    $user->update_meta("orga_operation_range", $value);

                // Create Contact MetaData
                if($value = $request->input('contact_name'))
                    $user->update_meta("contact_name", $value);
                if($value = $request->input('contact_email'))
                    $user->update_meta("contact_email", $value);
                if($value = $request->input('contact_phone'))
                    $user->update_meta("contact_phone", $value);

                // CRM Prodvider data
                if($value = $request->input('crm_name'))
                    $user->update_meta("crm_name", $value);
                if($value = $request->input('crm_email'))
                    $user->update_meta("crm_email", $value);
                break;
            case 'apl':
                // Update MetaData
                if($value = $request->input('orga_name'))
                    $user->update_meta("orga_name", $value);
                if($value = $request->input('orga_presentation'))
                    $user->update_meta("orga_presentation", $value);
                if($value = $request->input('orga_email'))
                    $user->update_meta("orga_email", $value);
                if($value = $request->input('orga_phone'))
                    $user->update_meta("orga_phone", $value);
                if($value = $request->input('orga_website'))
                    $user->update_meta("orga_website", $value);
                if($value = $request->input('orga_operation_range'))
                    $user->update_meta("orga_operation_range", $value);

                // Create Contact MetaData
                if($value = $request->input('contact_name'))
                    $user->update_meta("contact_name", $value);
                if($value = $request->input('contact_email'))
                    $user->update_meta("contact_email", $value);
                if($value = $request->input('contact_phone'))
                    $user->update_meta("contact_phone", $value);

                // Bank data
                if($value = $request->input('bank_iban'))
                    $user->update_meta("bank_iban", $value);
                if($value = $request->input('bank_bic'))
                    $user->update_meta("bank_bic", $value);
                break;
            case 'seller':
                // Create Organisation MetaData
                if($value = $request->input('orga_name'))
                    $user->update_meta("orga_name", $value);
                if($value = $request->input('orga_presentation'))
                    $user->update_meta("orga_presentation", $value);
                if($value = $request->input('orga_email'))
                    $user->update_meta("orga_email", $value);
                if($value = $request->input('orga_phone'))
                    $user->update_meta("orga_phone", $value);
                if($value = $request->input('orga_website'))
                    $user->update_meta("orga_website", $value);

                // Create Contact MetaData
                if($value = $request->input('contact_name'))
                    $user->update_meta("contact_name", $value);
                if($value = $request->input('contact_email'))
                    $user->update_meta("contact_email", $value);
                if($value = $request->input('contact_phone'))
                    $user->update_meta("contact_phone", $value);

                // CRM Prodvider data
                if($value = $request->input('crm_name'))
                    $user->update_meta("crm_name", $value);
                if($value = $request->input('crm_email'))
                    $user->update_meta("crm_email", $value);
                break;
        }

        // Common datas
        if($value = $request->input('newsletter')) 
            $user->update_meta("newsletter", $value);
        if($value = $request->input('allow_sharing')) 
            $user->update_meta("allow_sharing", $value);
    }
    
}
