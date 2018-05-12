@extends('layouts.app')

@section('content')
<div id="property-single">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7">
                @if(count($item->images))
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                      <li data-target="#myCarousel" data-slide-to="1"></li>
                      <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                      <div class="item active">
                        <img src="{{asset('images/Surfers_Paradise.jpg')}}" alt="..." style="width:100%;">
                      </div>
                      <div class="item">
                        <img src="{{asset('images/caroussel-image-1.jpg')}}" alt="..." style="width:100%;">
                      </div>
                      <div class="item">
                        <img src="{{asset('images/caroussel-image-2.jpg')}}" alt="..." style="width:100%;">
                      </div>
                    </div>
                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                      <span class="glyphicon glyphicon-chevron-left"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                      <span class="glyphicon glyphicon-chevron-right"></span>
                      <span class="sr-only">Next</span>
                    </a>
                </div>
                @else
                <section class="property-meta-wrapper common">
                    <figure class="feature-image"> 
                        <img data-action="zoom" src="{{$item->imageUrl()}}" alt="{{$item->title}}" style="width:100%;"> 
                    </figure>                     
                </section>  
                @endif
                
                <section class="property-meta-wrapper common">
                    @include('includes.alerts')
                    <div class="row">
                        <div class="col-sm-12">
                          <a href="#" class="btn btn-warning col-sm-6"><i class="fa fa-envelope-open-o"></i> @lang('app.btn.contact_admin')</a>
                          <a href="#" class="btn btn-success col-sm-6"><i class="fa fa-envelope-open-o"></i> @lang('app.btn.contact_apl')</a>
                        </div>
                    </div>
                    <div class="row">
                        <a href="{{route('shop.select.apl', ['product'=>$item])}}" class="btn btn-warning col-sm-6"><i class="fa fa-envelope-open-o"></i>@lang('app.select_apl')</a>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                          <a href="{{route('label.store', ['product'=>$item,'type'=>'saved'])}}" class="btn btn-info col-sm-6"><i class="fa fa-floppy-o" aria-hidden="true"></i> @lang('app.btn.pin')</a>
                          <a href="{{route('label.store', ['product'=>$item,'type'=>'starred'])}}" class="btn btn-info col-sm-6"><i class="fa fa-floppy-o" aria-hidden="true"></i>  @lang('app.btn.star')</a>
                        </div>
                    </div>
                </section>
                
                <section class="property-meta-wrapper common">
                    <h3 class="entry-title">@lang('app.detail')</h3>
                    <div class="property-single-meta">
                        <ul class="clearfix">
                            <li><span>@lang('app.reference'):</span> {{$item->reference}}</li>
                            <li><span>Publication du</span> {{$item->created_at->diffForHumans()}}</li>
                            <li><span>@lang('app.price'):</span>{{$item->price}}</li>
                            @if($location)
                            <li><span>@lang('app.product_location'):</span> {{$location?$location->formatted:'Localisation inconnue'}}</li>
                            @endif
                            
                            <li><span>@lang('app.area'):</span> {{$item->area}}</li>
                            <li><span>@lang('app.carport_spaces'):</span> {{$item->carport_spaces}}</li>
                            <li><span>@lang('app.garage_spaces'):</span> {{$item->garage_spaces}}</li>
                            <li><span>@lang('app.off_street_spaces'):</span> {{$item->off_street_spaces}}</li>
                            <li><span>@lang('app.bathrooms'):</span> {{$item->bathrooms}}</li>
                            <li><span>@lang('app.bedrooms'):</span> {{$item->bedrooms}}</li>
                            <li><span>@lang('app.ensuite'):</span> {{$item->ensuite}}</li>
                            <li><span>@lang('app.land_area'):</span> {{$item->land_area}}</li>
                            <li><span>@lang('app.floor_area'):</span> {{$item->floor_area}}</li>
                            <li><span>@lang('app.number_of_floors'):</span> {{$item->number_of_floors}}</li>
                        </ul>
                    </div>
                </section>
                
                <section class="property-contents common">
                    <h3 class="entry-title">@lang('app.description')</h3>
                    <p>{{$item->content}}</p>
                </section>
                
                <section class="property-nearby-places common">
                    <h4 class="entry-title">@lang('app.product_location')</h4>
                    <div id="map"></div>
                </section>
            </div>
            <div class="col-lg-4 col-md-5">
                @include('product.sidebar')
            </div>
        </div>
    </div>

    <div id="blog-listing" class="grid-style">
        <section id="property-listing">
            <header class="section-header text-center">
                <div class="container">
                    <h2 class="pull-left">@lang('app.latest_product')</h2>
                </div>
            </header>

            <div class="container section-layout">
                <div class="row">
                    <!-- start section products -->
                    @foreach($products as $product)
                    <div class="col-lg-4 col-sm-6 layout-item-wrap">
                        @include('product.single', ['item'=>$product])
                    </div>
                    @endforeach
                    <!-- end section products -->
                </div>
            </div>
        </section>
    </div>
@endsection
    
@section('script')
<script>
    var _map;
    var _geocoder;
    var _marker;
    var _circle;
    var _lat = {{$location?$location->latitude:-25.647467468105795}};
    var _long = {{$location?$location->longitude:146.89921517372136}};
    var _btnSubmit = document.getElementById("submit");
    var _inputApl = document.getElementById("apl");
    var _contentApl = document.getElementById("apl-content");
    var _titleApl = document.getElementById("apl-title");
    
    var iconBase = "{{url('')}}";
    var icons = {
      user: {
        icon: iconBase + '/images/map/user.png'
      },
      member: {
        icon: iconBase + '/images/map/member.png'
      },
      apl: {
        icon: iconBase + '/images/map/apl.png'
      },
      afa: {
        icon: iconBase + '/images/map/afa.png'
      },
      product: {
        icon: iconBase + '/images/map/product.png'
      }
    };
    
    var data = {!!$data!!};
    
    function initMap() {
        
        _map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: _lat, lng:  _long},
            zoom: 16
        });
        
        _marker = new google.maps.Marker({
          position: {lat: _lat, lng: _long},
          icon: icons['product'].icon,
          map: _map,
          title: data.title
        });

        _marker.addListener('dragend', function() {
             var lat = _marker.getPosition().lat();
             var lng = _marker.getPosition().lng();
        });
        
        _circle = new google.maps.Circle({
          strokeColor: '#358bbc',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#358bbc',
          fillOpacity: 0.35,
          map: _map,
          center: {lat:parseFloat(data.lat), lng:parseFloat(data.lng)},
          radius: data.area
        });
    
    }

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtRuDbjjrHacZ6EqZySofNueLBLkrNxwI&callback=initMap"></script>
@endsection