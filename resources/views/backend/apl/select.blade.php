@extends('layouts.backend')

@section('subcontent')
<div class="row">
    
        <fieldset>
            <legend>@lang('app.select_apl')</legend>
            <div class="row">
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="property-sorting">        
                                <form id="filter-form" method="get" action="">
                                    <div  class="pull-left">
                                        <label for="distance"> @lang('app.form.filterBy'):   </label>  
                                        <select name="distance" id="distance" onchange="document.getElementById('filter-form').submit();"> 
                                            @foreach($distances as $dist)
                                            <option value="{{$dist}}" {{$distance===$dist?'selected':''}}>{{$dist}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                            </div>           
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <form class="form-horizontal" role="form" method="post" action="{{$action}}">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <select id="apl"  name="apl" class="form-control">
                                    @foreach($items as $item)
                                    <option 
                                        {{Auth::check()
                                        &&Auth::user()->apl
                                        &&(Auth::user()->apl->id==$item->id)?'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="checkbox" name="is_default" value="1"> @lang('app.choose_as_default_apl')
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button id="submit" type="submit" class="btn btn-primary">@lang('app.btn.select_apl')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </fieldset>
</div>
@endsection
@section('script')
<script>
    var _map;
    var _geocoder;
    var _marker;
    var _lat = {{$location?$location->latitude:-25.647467468105795}};
    var _long = {{$location?$location->longitude:146.89921517372136}};
    var _inputApl = document.getElementById("apl");
    
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
    
    
    var datas = {!!$data!!};
    var selected = {!!$selected!!};
    var circles = [];
    var markers = [];
    
    function initMap() {
        
        _map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: _lat, lng:  _long},
            zoom: 4
        });
        
        _marker = new google.maps.Marker({
          position: {lat: _lat, lng: _long},
          icon: icons['member'].icon,
          map: _map,
          title: "@lang('app.your_location')"
        });

        _marker.addListener('dragend', function() {
             var lat = _marker.getPosition().lat();
             var lng = _marker.getPosition().lng();
        });
    
        for (var i = 0; i < datas.length; i++) {
            placeMarker(datas[i], );
            placeCirle(datas[i]);
        }
        
        if(selected!=null){
            changeCircle(selected);
        }
    }

    function placeCirle(data) {
        if(data.type == 'apl'){
            circles[data.id] = new google.maps.Circle({
              strokeColor: '#e67b19',
              strokeOpacity: 0.8,
              strokeWeight: 2,
              fillColor: '#e67b19',
              fillOpacity: 0.35,
              map: _map,
              center: {lat:parseFloat(data.lat), lng:parseFloat(data.lng)},
              radius: data.id * 50 * 1000
            });
        }
    }

    function changeCircle(data) {
        if(selected!=null){
            circles[selected.id].setOptions({
                        fillColor: '#e67b19',
                        strokeColor: '#e67b19'
                    });
        }
        
        if(data.type == 'apl'){
            circles[data.id].setOptions({
                        fillColor: '#00FF00',
                        strokeColor: '#00FF00'
                    });
            selected = data;
        }
    }
    
    function placeMarker(data) {
        markers[data.id] = new google.maps.Marker({
            position: {lat:parseFloat(data.lat), lng:parseFloat(data.lng)},
            map: _map,
            title: data.title,
            icon: icons[data.type].icon,
        });
        
        if(data.type == 'apl'){
            google.maps.event.addListener(markers[data.id], 'click', function() {
                _inputApl.value = data.id;
                changeCircle(data);
            });
        }
    }
    
    _inputApl.addEventListener('change',function(){
        var id = _inputApl.value;
        for (var i = 0; i < datas.length; i++) {
            if(datas[i].id == id){
                changeCircle(datas[i]);
                break;
            }
        }
    });

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtRuDbjjrHacZ6EqZySofNueLBLkrNxwI&callback=initMap"></script>
@endsection
