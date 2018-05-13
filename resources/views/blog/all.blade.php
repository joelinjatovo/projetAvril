@extends('layouts.app')

@section('style')
<style type="text/css">
    .ajax-load{
        background: #e1e1e1;
        padding: 10px 0px;
        width: 100%;
    }
</style>
@endsection

@section('content')
@component('includes.breadcrumb')
    @lang('app.blogs')
@endcomponent

<div id="blog-listing" class="grid-style"> 
    <header class="section-header text-center"> 
        <div class="container"> 
            <h2 class="pull-left">@lang('app.blogs')</h2>
        </div>                 
    </header>  
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <div id="infinite-scroll" class="row"> 
                    <div id="filter-container" class="blog-data">
                        @include('ajax.blog.all',['items'=>$items])
                    </div> 
                </div>  
                <div class="row">
                    <div class="ajax-load text-center" style="display:none">
                        <p><img src="{{asset('images/loader.gif')}}">@lang('app.load_more_blog')</p>
                    </div>  
                </div> 
            </div>
            <div class="col-lg-4 col-md-4"> 
                @include('includes.sidebar')
            </div>
        </div>             
    </div>             
</div> 
@endsection

@section('script')
<script type="text/javascript">
var page = {{$page}};
var norecord = false;
var load = false;
$(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() >= 
       $('#infinite-scroll').height()+$('#breadcrumb').height()) {
        if(!load){
            if(!norecord){
                page++;
                loadMoreData(page);
            }else{
                $('.ajax-load').show();
            }
        }
    }
});
function loadMoreData(page){
    $.ajax({
        url: '<?php echo route('blog.all', ['filter'=>$filter]); ?>?page='+page,
        type: "get",
        beforeSend: function()
        {
            load = true;
            $('.ajax-load').show();
        }
    }).done(function(data)
    {
        if(data.html == ""){
            norecord = true;
            $('.ajax-load').html("@lang('app.no_more_data')");
            return;
        }
        $('.ajax-load').hide();
        $(".blog-data").append(data.html);
        load = false;
    }).fail(function(jqXHR, ajaxOptions, thrownError)
    {
        page--;
        $('.ajax-load').html("Server not responding....");
        load = false;
    });
}
</script>
@endsection

