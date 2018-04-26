@extends('layouts.app')

@section('content')
<div class="main-slider-wrapper clearfix content corps">
    @include('includes.breadcrumb')
</div>

<div class="container">
    <div class="row"> 
        <div class="col-sm-8"> 
            <article class="blog-post single-post"> 
                <figure class="feature-image"> 
                    <img data-action="zoom" src="{{$item->imageUrl()}}" alt="{{$item->title}}" style="width:100%;"> 
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
</div> 


@endsection
