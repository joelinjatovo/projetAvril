@extends('layouts.backend')

@section('subcontent')
<div class="row">
    <form class="form-horizontal" role="form" method="post" action="{{route('shop.add', $item)}}">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <fieldset>
            <legend>@lang('app.select_apl')</legend>
            <div class="row">
                <div class="col-sm-9">
                    <div id="map"></div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <select name="apl" class="form-control">
                                @foreach($items as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="checkbox" name="is_default"> @lang('app.choose_as_default_apl')
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button id="submit" type="submit" class="btn btn-primary">@lang('app.btn.select_apl')</button>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</div>
@endsection
@section('script')
<script>
    var _map;
    var _geocoder;
    var _marker;
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
    
        var datas = {!!$data!!};
        for (var i = 0; i < datas.length; i++) {
            placeMarker(datas[i]);
            placeCirle(datas[i]);
        }
    }

    function placeCirle(data) {
        if(data.type == 'apl'){
            var cityCircle = new google.maps.Circle({
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
    
    function placeMarker(data) {
        _marker = new google.maps.Marker({
            position: {lat:parseFloat(data.lat), lng:parseFloat(data.lng)},
            map: _map,
            title: data.title,
            icon: icons[data.type].icon,
        });
        
        if(data.type == 'apl'){
            google.maps.event.addListener(_marker, 'click', function() {
                _inputApl.value = data.id;
                _titleApl.innerHTML = data.title;
                _contentApl.innerHTML = data.content;
            });
        }
    }

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtRuDbjjrHacZ6EqZySofNueLBLkrNxwI&callback=initMap"></script>
@endsection
