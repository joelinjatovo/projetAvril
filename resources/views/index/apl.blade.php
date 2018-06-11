@extends('layouts.app')

@section('content')
<div class="content corps" style="margin-top: 160px;">
    <div class="container">

        <div class="row">
            <fieldset>
                <legend>@lang('app.list_apl')</legend>
                <div class="row">
                    <div class="col-sm-12">
                        <div id="map" style="height: 400px;"></div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    var _map;
    var _lat = -25.647467468105795;
    var _long = 146.89921517372136;
    
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
    var circles = [];
    var markers = [];
    var infos = [];
    var selected = null;
    
    function initMap() {
        
        _map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: _lat, lng:  _long},
            zoom: 2
        });
    
        for (var i = 0; i < datas.length; i++) {
            placeMarker(datas[i], );
            placeCirle(datas[i]);
            initInfo(datas[i]);
        }
    }

    function initInfo(data) {
        infos[data.id]= new google.maps.InfoWindow({ content: data.html });
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
            title: '<h1>'+data.title+'</h1>',
            icon: icons[data.type].icon,
        });
        
        if(data.type == 'apl'){
            google.maps.event.addListener(markers[data.id], 'click', function() {
                if(selected!=null){
                    infos[selected.id].close();
                }
                infos[data.id].open(_map, markers[data.id]);
                selected = data;
            });
        }
    }

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtRuDbjjrHacZ6EqZySofNueLBLkrNxwI&callback=initMap"></script>
@endsection
