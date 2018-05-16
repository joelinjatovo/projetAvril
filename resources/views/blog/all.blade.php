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
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <header class="section-header text-center"> 
                    <div class="container"> 
                        <h2 class="pull-left">@lang('app.blogs')</h2>
                    </div>                 
                </header>  
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="property-sorting">        
                            <form id="filter-form" method="get" action="">
                                <div  class="pull-left">
                                    <label for="orderBy"> @lang('app.form.filterBy'):   </label>  
                                    <select name="orderBy" id="orderBy" onchange="document.getElementById('filter-form').submit();"> 
                                        <option value="created_at" {{$orderBy=='created_at'?'selected':''}}>@lang('app.pub_date')</option>  
                                        <option value="view_count" {{$orderBy=='view_count'?'selected':''}}>@lang('app.most_view')</option>
                                    </select>
                                </div>
                                <div  class="pull-left">
                                    <label for="order"> @lang('app.form.order'):   </label>  
                                    <select name="order" id="order" onchange="document.getElementById('filter-form').submit();"> 
                                        <option value="asc" {{$order=='asc'?'selected':''}}>@lang('app.form.asc')</option> 
                                        <option value="desc" {{$order=='desc'?'selected':''}}>@lang('app.form.desc')</option> 
                                    </select>
                                </div>
                                <div  class="pull-right">
                                    <p class="layout-view"> Vue:<i class="fa fa-th-large selected" data-layout="6"></i> <i class="fa fa-list-ul" data-layout="12"></i> </p> 
                                </div>
                            </form>
                        </div>           
                    </div>
                </div>

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
        url: "{!!route("blog.all", ["filter"=>$filter, "order"=>$order, "orderBy"=>$orderBy])!!}&page="+page,
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

