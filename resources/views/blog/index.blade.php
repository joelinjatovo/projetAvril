@extends('layouts.app')

@section('content')
@component('includes.breadcrumb')
    @lang('app.blogs')
@endcomponent
<div class="container">
    <div class="row"> 
        <div class="col-sm-8"> 
            <article class="blog-post single-post"> 
                <figure class="feature-image"> 
                    <img data-action="zoom" src="{{$item->imageUrl()}}" alt="{{$item->title}}" style="width:100%;"> 
                </figure>                         
                <div class="post-footer post-meta clearfix">
                    <time class="updated btn btn-warning"><p>{{$item->created_at->diffForHumans()}}</p></time>                             
                    <h4 class="entry-title">{{$item->title}}</h4> 
                    <span class="author">Publié par<a href="#">{{$item->author->name}}</a></span> 
                    <span>Commentaire<a href="#" style="font-size: inherit; background-color: rgb(255, 255, 255);">{{count($item->comments)}}</a></span>
                </div>                         
                <div class="contents clearfix"> 
                    <p>{{$item->content}}</p>                                                          
                </div>                       
            </article>  

            <section id="app"> 
                <div class="row">
                    <div class="col-md-12" style="background:white;">
                        <comment comment-url="{{ $item->id }}"></comment>
                    </div>      
                </div>
            </section>          
        </div>
        <div class="col-lg-4 col-md-4"> 
            @include('includes.sidebar')
        </div>
    </div> 
</div> 
@endsection

@section('script')
<script src="{{ asset('js/app.js') }}"></script>
@endsection
