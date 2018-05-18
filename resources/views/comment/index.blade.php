
<article class="clearfix"> 
    <a class="author-img" href="#"> 
        <img src="{{$item->author->imageUrl()}}" alt="Author">
    </a>                                     
    <div class="comment-detail-wrap"> 
        <div class="comment-meta clearfix"> 
            <h5 class="author"> <cite class="fn"> <cite class="fn"> <a href="#" rel="external nofollow" class="url">{{$comment->author->name}}</a> </cite> </cite> </h5> 
            <time datetime="2013-08-01T19:22:45+00:00"> 
                {{$comment->created_at->diffForHumans()}}
            </time>                                             
        </div>                                         
        <div class="comment-body"> 
            <p>{{$comment->content}}</p> 
        </div>                                         
    </div>
</article>   