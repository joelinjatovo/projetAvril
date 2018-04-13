<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;    

class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the blog page by slug.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        return view('blog.index');
    }

    /**
     * Show the list of blog.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        return view('blog.all');
    }

    /**
     * Show the list of blog as grid.
     *
     */
    public function allAdmin()
    {
        $items = Blog::all();
        foreach($items as $item)
        {
            $item->slug = Blog::slugBlog($item->title,$item->id);
            $item->contenu = Blog::trunque($item->content,70);
        }
        return view('blog.admin.all',compact('items')); 
    }

    /**
     * Show the list of blog as table.   
     *
     * @return \Illuminate\Http\Response
    */
    public function listAdmin()
    {
       $items = Blog::all();
        return view('blog.admin.list',compact('items'));
    }
    
    public function add(Request $request)
    {
        $item = new Blog();
        $action = 'blog.add';
        return view('blog.admin.update', compact('item'));
    }
    
    
    /**
    * Function View update Un Blog 
    * @param string Slug du produit
    * @return Object Collection Blog 
    */
    public function edit(Request $request, $id)
    {
        $item = Blog::findOrFail($id);
        $action = 'blog.add';
        return view('blog.admin.update', compact('item'));
    }
    
    /**
    * Function View update Un Blog 
    * @param string Slug du produit
    * @return Object Collection Blog 
    */
    public function update(Request $request, $id)
    {
        //get Request::all() && get blog with Query
        $blog_updated = $request->input();//array

        $last_blogObj = Blog::find($request->input('article'))->firstOrFail();//Object
        $last_blog = json_decode(json_encode($last_blogObj),true);//array
        //parcourir tableau et comparer avec Request::post()
        unset($blog_updated['_token'] , $blog_updated['_wysihtml5_mode'],$blog_updated['article']);
        //verifier si une image a été uploadé
        if($request->file('file'))
        {
            $this->validate($request, ['file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048']);
            $image = $request->file('file');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');

            //redimensionner Image
            $image_resize = Resize::make($image->getRealPath());              
            $resultat = $image_resize->resize(1600, 1000);
            $path = $destinationPath . '/' . $input['imagename'];
            $image_resize->save($path);
            //enregistrement image dans destinationPath
            //$image->move($destinationPath, $input['imagename']); 

            //supprimer ancienne image
            $image_blog = Image::where('blog_id',$request->input('article'))->first(['urlimage1']);
            unlink( public_path() . '/images/' . $image_blog->urlimage1 );
            //insertion image 
            Image::where('blog_id',$request->input('article'))->update(['urlimage1' => $input['imagename']]);
        }

        //renommer les keys
        $blog_updated = [
            'titre' => $blog_updated['blog_titre'],
            'contenu' => $blog_updated['blog_paragraphe'],
            'tag' => $blog_updated['metaArticleKeywords']
        ];

        $modification = array_diff($blog_updated,$last_blog);
        

       //if $modification NOT NULL : require update
        if(!empty($modification))
        {  
            foreach ($modification as $key => $value) 
            {
               Blog::where('id',$last_blog['id'])->update([$key => $value]);
            }
            //message flash
            return back()->with('success',"La modification a été enregistrée");
        }
        else
        {
         //if Request::post() FALSE
                // message flash 'Aucun modifiacation'
           return back()->with('success',"Aucune modification n'a été effectuée");
        }

    }
    
    
    /**
    * Soft Delete Blog Item by Id
    *
    * @param Object Request
    *
    * @return null 
    */
    public function softDelete(Request $request, $id)
    {
        $delete = Blog::find($id);
        $delete->state = 1;
        $delete->save();
        return back()->with('success',"L'article a été archivé avec succés");
    }
    
    /**
    * Resotre Blog Item by Id
    *
    * @param Object Request
    *
    * @return null 
    */
    public function restore(Request $request, $id)
    {
        $delete = Blog::find($id);
        $delete->state = 1;
        $delete->save();
        return back()->with('success',"L'article a été restoré avec succés");
    }
    
    
    /**
    * Soft Delete Blog Item by Id
    *
    * @param Object Request
    *
    * @return null 
    */
    public function delete(Request $request, $id)
    {
        $delete = Blog::find($id);
        $delete->delete();
        return back()->with('success',"L'article a été supprimé avec succés");
    }
}
