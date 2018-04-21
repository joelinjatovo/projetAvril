@foreach($items as $item)
<div class="layout-item-wrap mix a1 col-md-6">
    <article class="blog-post clearfix layout-item list-tem"> 
        <figure class="feature-image"> 
            <a href="#" class="clearfix zoom">
                <img data-action="zoom" src="{{storage($item->image)}}" alt="{{$item->title}}">
            </a>                                         
            <time class="updated btn btn-warning">{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('d F')}}</time>            
        </figure>                                     
        <div class="post-contents clearfix">
            <h4 class="entry-title"><a href="{{route('blog.index',$item)}}">{{$item->title}}</a></h4> 
            <footer class="post-footer post-meta clearfix"> 
                <span class="author">Posté par <a href="#">{{$item->author->name}}</a></span> 
                <span>Comment <a href="#"> {{count($item->comments)}}</a> </span> 
                <a href="{{route('blog.index',$item)}}" class="more">Continuer la lecture <i class="fa fa-angle-double-right"></i></a> 
            </footer>
        </div>                                     
    </article>
</div>
@endforeach