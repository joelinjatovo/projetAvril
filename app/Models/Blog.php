<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Comment;

// Eloquent Model to manage Blog
class Blog extends Model
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blogs';
    
    
    /** 
    *Fonction Truncage de texte
    * @return texte...
    */
    public static function trunque($str, $nb = 150)
    {
		if (strlen($str) > $nb) 
		{
			$str = substr($str, 0, $nb);
			$position_espace = strrpos($str, " ");
			$texte = substr($str, 0, $position_espace); 
			$str = $str."...";
		}
	    return $str;
	}
    
    /** 
	*Fonction generer un slug personnalisé pour Bloh
	* @param titre
	* @return char Slug
	*/
	public static function slugBlog($titre,$id)
	{
		return "artcl".$id."-".Str::slug($titre);
	}
    
    /**
     * A blog can have many comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
      return $this->hasMany(Comment::class, 'blog_id', 'id');
    }
    
    /**
     * Get the author record associated with the blog.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
