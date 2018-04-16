@extends('layouts.app')

@section('content')
<div class="main-slider-wrapper clearfix content corps">
    @include('includes.breadcrumb')
</div>

<div class="container">
    <div class="col-sm-8"> 
        <article class="blog-post single-post"> 
            <figure class="feature-image"> 
                <img data-action="zoom" src="{{storage($item->image)}}" alt="{{$item->title}}"> 
            </figure>                         
            <div class="post-footer post-meta clearfix">
                <time class="updated btn btn-warning"><p>{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('d F')}}</p></time>                             
                <h4 class="entry-title">{{$item->title}}</h4> 
                <span class="author">Publié par<a href="#">{{$item->author->name}}</a></span> 
                <span>Commentaire<a href="#" style="font-size: inherit; background-color: rgb(255, 255, 255);">{{count($item->comments)}}</a></span>
            </div>                         
            <div class="contents clearfix"> 
                <p>{{$item->content}}</p>                                                          
            </div>                         
            <footer class="post-footer post-footer-meta clearfix"> 
                <div class="tags pull-left">
                    <span>Tags:</span> 
                    Appartement, Grenier, Villa, Maison
                </div>                             
                <nav class="social-share">
                    <span>Partagé:</span> 
                    <ul class="social-icons clearfix"> 
                        <li>
                            <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                        </li>                                     
                        <li>
                            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                        </li>                                  
                        <li>
                            <a href="#"><i class="fa fa-google"></i></a>
                        </li>                                     
                    </ul>
                </nav>                             
            </footer>                         
        </article>  

        <section id="comments"> 
            <h4 id="comments-title">Commentaires</h4>
            <ol class="commentlist">
                @forelse($item->comments as $comment)
                    <li>@include('comment.index')</li>
                @empty
                    <p>No comments</p>
                @endforelse
            </ol>
            @if(Auth::check())
                @include('comment.form')
            @endif
            <!-- #respond -->                         
        </section>                     
    </div>
    <div class="col-lg-4 col-md-4"> 
        @include('includes.sidebar')
    </div>
    </div> 


@endsection
