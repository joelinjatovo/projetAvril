@extends('layouts.app')

@section('content')
@include('includes.slider')
<div class="container">
    <header class="section-header text-center">
        <div class="container">
            <h3 class="pull-left">Résidentiel - <small> 6 produits enregistrées </small></h3>
            <div class="pull-right">
                <div class="property-sorting pull-left">
                    <label for="property-sort-dropdown"> Nombre de produits à afficher:   </label>
                    <select name="property-sort-dropdown" id="property-sort-dropdown" onchange="showUser(this.value)">
                        <option value="10">10 produits</option>
                        <option value="20">20 produits</option>
                        <option value="50">50 produits</option>
                        <option value="100">100 produits</option>
                    </select>
                </div>
                <p class="pull-left layout-view">
                  Vue:
                  <i class="fa fa-th-large selected" data-layout="6"></i>
                  <i class="fa fa-list-ul" data-layout="12"></i> </p>
            </div>
        </div>
    </header>

    <!-- breadcrumb     -->
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Accueil</a></li>
              <li class="breadcrumb-item active">Résidentiel</li>
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
                    <p><img src="{{asset('images/loader.gif')}}">Loading More Procucts</p>
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
            $('.ajax-load').html("No more records found");
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

