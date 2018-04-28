<article class="property layout-item clearfix">
     <figure class="feature-image">
         <a href="single.html" class="clearfix zoom">
            <img data-action="zoom" src="{{$item->imageUrl()}}" alt="{{$item->title}}">
         </a>
     </figure>
     <div class="property-contents clearfix">
         <header class="property-header clearfix">
             <div class="pull-left">
                 <h5 class="entry-title"><a href="{{route('blog.index',$item)}}">{{$item->title}}</a></h5>
                 <div class="contents clearfix">
                      {{$item->excerpt()}}
                </div>
             </div>
         </header>                                 
         <div class="post-contents clearfix">
            <footer class="post-footer post-meta clearfix"> 
                <span class="author">Posté par <a href="#">{{$item->author->name}}</a></span> 
                <span>Comment <a href="#"> {{count($item->comments)}}</a> </span><br>
                <a href="{{route('blog.index',$item)}}" class="more pull-right">Continuer la lecture <i class="fa fa-angle-double-right"></i></a> 
            </footer>
         </div>       
     </div>
</article>