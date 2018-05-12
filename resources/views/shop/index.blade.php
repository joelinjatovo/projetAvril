@extends('layouts.app')

@section('content')
@include('includes.slider')
<div class="container">
    <header class="section-header text-center">
        <div class="container">
            <h3 class="pull-left">@if($category&&$category->id>0) {{$category->title}} @else @lang('app.all_product') @endif</h3>
        </div>
    </header>

    <!-- breadcrumb     -->
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">@lang('app.home')</a></li>
              @if($category&&$category->id>0)
                <li class="breadcrumb-item"><a href="{{route('shop.index')}}">@lang('app.all_product')</a></li>
                <li class="breadcrumb-item active">{{$category->title}}</li>
              @else
                <li class="breadcrumb-item active">@lang('app.all_product')</li>
              @endif
            </ol>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-8 col-md-7">
            <div id="infinite-scroll" class="product-data"> 
                @include('ajax.product.all',['items'=>$items])
            </div>
            <div class="row">
                <div class="ajax-load text-center" style="display:none">
                    <p><img src="{{asset('images/loader.gif')}}">@lang('app.load_more_product')</p>
                </div>  
            </div>
        </div>
        <div class="col-lg-4 col-md-5">
            @include('includes.sidebar')
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
       $('#infinite-scroll').height()) {
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
        url: '<?php echo route('shop.index', ['category'=>$category]); ?>?page='+page,
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
        $(".product-data").append(data.html);
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

