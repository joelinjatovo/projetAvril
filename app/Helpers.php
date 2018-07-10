<?php

/**
* Alias to acces to storage image path
* @param String $path : Local storage path
*/
if( ! function_exists('storage'))
{
	function storage($path)
	{
		return asset('uploads/'.$path) ;
	}
}

/**
* Alias to acces to storage thumbnail image path
* @param String $path : Local storage path
*/
if( ! function_exists('thumbnail'))
{
	function thumbnail($path)
	{
        $file = public_path('uploads/'.$path);
        if (!File::exists($file)) {
            return asset('uploads/'.$path);
        }
        
        $filename = str_replace('\\', '/', $path);
        $pos = strrpos($filename, '/');
        $filename = false === $pos ? $filename : substr($filename, $pos + 1);
        
        $thumbnail = public_path('uploads/app/thumb_'.$filename);
        if (!File::exists($thumbnail)) {
            InterventionImage::make($file)->resize(320,240)->save($thumbnail);
        }
        
		return asset('uploads/app/thumb_'.$filename) ;
	}
}

/**
* Alias to acces to storage thumbnail image path
* @param String $path : Local storage path
*/
if( ! function_exists('option'))
{
	function option($keys, $default=null)
	{
		$keys = explode('.', $keys);
        if(count($keys)==2){
            $group = $keys[0];
            $key = $keys[1];
            
            $model = App\Models\Config::where('name', $group)
                ->get()
                ->first();
            if(!$model) return $default;
            
            $meta = $model->get_meta($key);
            if($meta) return $meta->value;
        }
        return $default;
	}
}

if( ! function_exists('app_name'))
{
	function app_name($default=null)
	{
        $default = config('app.name', $default);
        $default = option('site.meta_title', $default);
        return $default;
	}
}

/**
* creer le lien css plugin vers le frontEnd en ligne  
* @param $url_css string : lien du css/plugin en local
* format : plugins/slick-nav/slicknav
*/
if( ! function_exists('plugin_css'))
{
	function plugin_css($plugin_css)
	{
		return '<link href="'. asset($plugin_css .'.css').'" rel="stylesheet">';
	}
}

/**
* Generate slug
*
* @param String $text
* @return String $slug
*/
if( ! function_exists('generateSlug') )
{
    function generateSlug($text)
    {
        return str_replace(' ', '-', strtolower($text));
    }
}
