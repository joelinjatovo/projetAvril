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
<div id="breadcrumb" class="main-slider-wrapper clearfix content corps">
    @include('includes.breadcrumb')
</div>     

<div id="blog-listing" class="grid-style"> 
    <header class="section-header text-center"> 
        <div class="container"> 
            <h2 class="pull-left">Blog</h2> 
            <div class="pull-right"> 
                <div class="property-sorting pull-left"> 
                    <label for="property-sort-dropdown"> Trier par:   </label>                             
                    <select name="property-sort-dropdown" id="property-sort-dropdown"> 
                        <option value="croissant">Croissant </option>                                 
                        <option value="décroissant">Décroissant</option>                                 
                    </select>
                </div>                         
                <p class="pull-left layout-view"> Vue: <i class="fa fa-th-large selected" data-layout="6"></i> <i class="fa fa-list-ul" data-layout="12"></i> </p> 
            </div>                     
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
                        <p><img src="{{asset('images/loader.gif')}}">Loading More post</p>
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
            $('.ajax-load').html("No more records found");
            return;
        }
        console.log(data.html);
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

