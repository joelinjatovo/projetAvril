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
                      <label for="latitude">@lang('app.latitude')</label>
                      <input type="text" name="latitude" class="form-control" id="latitude" placeholder="Latitude">
                   </div>
                </div>
                <div class="col-sm-6">
                   <div class="form-group">
                      <label for="longitude">@lang('app.longitude')</label>
                      <input type="text" name="longitude" class="form-control" id="longitude" placeholder="Longitude">
                   </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                      <label for="country">@lang('app.country')</label>
                      <input type="text" name="country" class="form-control" id="country" placeholder="country">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                      <label for="state">@lang('app.area_level_1')</label>
                      <input type="text" name="area_level_1" class="form-control" id="area_level_1" placeholder="state">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                      <label for="region">@lang('app.area_level_2')</label>
                      <input type="text" name="area_level_2" class="form-control" id="area_level_2" placeholder="@lang('app.region')">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                      <label for="locality">@lang('app.locality')</label>
                      <input type="text" name="locality" class="form-control" id="locality" placeholder="@lang('app.locality')">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                      <label for="route">@lang('app.route')</label>
                      <input type="text" name="route" class="form-control" id="route" placeholder="@lang('app.route')">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                      <label for="postalCode">@lang('app.postalCode')</label>
                      <input type="text" name="postalCode" class="form-control" id="postalCode" placeholder="@lang('app.postalCode')">
                    </div>
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
    var _lat = {{$location?floatval($location->latitude):-25.647467468105795}};
    var _long = {{$location?floatval($location->longitude):146.89921517372136}};
    var _longInput = document.getElementById("longitude");
    var _latInput = document.getElementById("latitude");
    
    var _formattedInput = document.getElementById("formatted");
    var _countryInput = document.getElementById("country");
    var _level_1Input = document.getElementById("area_level_1");
    var _level_2Input = document.getElementById("area_level_2");
    var _localityInput = document.getElementById("locality");
    var _routeInput = document.getElementById("route");
    var _postalInput = document.getElementById("postalCode");
    
    
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
             var lat = _latInput.value = event.latLng.lat();
             var lng = _longInput.value = event.latLng.lng();
             placeMarkerAndPanTo(event.latLng);
             loadGeocode(event.latLng);
        });

        _marker.addListener('dragend', function() {
             var lat = _latInput.value = _marker.getPosition().lat();
             var lng = _longInput.value = _marker.getPosition().lng();
             loadGeocode(_marker.getPosition());
        });
        
        _geocoder = new google.maps.Geocoder();
        loadGeocode({lat: _lat, lng: _long});
    }

    function placeMarkerAndPanTo(latLng) {
        _marker.setMap(null);
        _marker = new google.maps.Marker({
            position: latLng,
            draggable:true,
            map: _map
        });
        _map.panTo(latLng);
    }

    function loadGeocode(latLng) {
        _geocoder.geocode({'location': latLng}, function(results, status){
            console.log(results);
            if (status === 'OK') {
                if (results[0]) {
                    _formattedInput.value = results[0].formatted_address;
                    for(var i = 0; i< results[0].address_components.length; i++){
                        var info = results[0].address_components[i];
                        var label = info.long_name;
                        var types = info.types;
                        for(var j = 0; j<types.length; j++){
                            if(types[j]=='country'){
                                _countryInput.value = label;
                                break;
                            }
                            if(types[j]=='administrative_area_level_1'){
                                _level_1Input.value = label;
                                break;
                            }
                            if(types[j]=='administrative_area_level_2'){
                                _level_2Input.value = label;
                                break;
                            }
                            if(types[j]=='route'){
                                _routeInput.value = label;
                                break;
                            }
                            if(types[j]=='locality'){
                                _localityInput.value = label;
                                break;
                            }
                            if(types[j]=='postal_code'){
                                _postalInput.value = label;
                                break;
                            }
                        }
                    }
                } else {
                    window.alert('No results found');
                }
            } else {
              window.alert('Geocoder failed due to: ' + status);
            }
        });
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtRuDbjjrHacZ6EqZySofNueLBLkrNxwI&callback=initMap"></script>
@endsection

