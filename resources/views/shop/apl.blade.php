@extends('layouts.backend')

@section('subcontent')
<div class="row">
    <form class="form-horizontal" role="form" method="post" action="{{route('location.edit')}}">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <input type="hidden" name="formatted" id="formatted">
        <fieldset>
            <legend>Modification Localisation</legend>
            <div class="row">
                <div class="col-sm-12">
                     <div id="map"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">@lang('app.btn.save')</button>
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
    
    
    function initMap() {
        
        _map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: _lat, lng:  _long},
            zoom: 2
        });
        
        _marker = new google.maps.Marker({
          position: {lat: _lat, lng: _long},
          draggable:true,
          map: _map
        });

        google.maps.event.addListener(_map, 'click', function(event) {
             var lat = event.latLng.lat();
             var lng = event.latLng.lng();
             placeMarkerAndPanTo(event.latLng);
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
        var cityCircle = new google.maps.Circle({
          strokeColor: '#FF0000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#FF0000',
          fillOpacity: 0.35,
          map: _map,
          center: {lat:parseFloat(data.lat), lng:parseFloat(data.lng)},
          radius: data.id * 50 * 1000
        });
    }
    
    function placeMarker(data) {
        _marker = new google.maps.Marker({
            position: {lat:parseFloat(data.lat), lng:parseFloat(data.lng)},
            map: _map,
            title: data.title,
        });
        google.maps.event.addListener(_marker, 'click', function() {
            window.alert(data.id);});
    }

    function placeMarkerAndPanTo(latLng) {
        _marker.setMap(null);
        _marker = new google.maps.Marker({
            position: latLng,
            map: _map
        });
        _map.panTo(latLng);
    }

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtRuDbjjrHacZ6EqZySofNueLBLkrNxwI&callback=initMap"></script>
@endsection