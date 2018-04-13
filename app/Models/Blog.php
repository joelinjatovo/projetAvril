<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

}
