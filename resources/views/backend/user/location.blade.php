@extends('layouts.backend')

@section('subcontent')
<div class="row">
    <form class="form-horizontal" role="form" method="post" action="{{route('location.edit')}}">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <fieldset>
            <legend>Modification Localisation</legend>
            <div class="col-sm-12">
                <div class="col-sm-8">
                     <div id="map"></div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                       <div class="col-md-12">
                          <div class="form-group">
                              <label for="latitude">Latitude</label>
                              <input type="text" name="latitude" class="form-control" id="latitude" placeholder="Latitude">
                          </div>
                       </div>
                       <div class="col-md-12">
                          <div class="form-group">
                              <label for="longitude">Longitude</label>
                              <input type="text" name="longitude" class="form-control" id="longitude" placeholder="Longitude">
                          </div>
                       </div>
                       <div class="col-md-12">
                          <div class="form-group">
                              <label for="formatted">Formatted</label>
                              <input type="text" name="formatted" class="form-control" id="formatted" placeholder="Formatted">
                          </div>
                       </div>
                       <div class="col-md-12">
                          <div class="form-group">
                              <label for="locality">locality</label>
                              <input type="text" name="locality" class="form-control" id="locality" placeholder="locality">
                          </div>
                       </div>
                       <div class="col-md-12">
                          <div class="form-group">
                              <label for="sublocality">sublocality</label>
                              <input type="text" name="sublocality" class="form-control" id="sublocality" placeholder="sublocality">
                          </div>
                       </div>
                       <div class="col-md-12">
                          <div class="form-group">
                              <label for="street">street</label>
                              <input type="text" name="street" class="form-control" id="street" placeholder="street">
                          </div>
                       </div>
                       <div class="col-md-12">
                          <div class="form-group">
                              <label for="route">route</label>
                              <input type="text" name="route" class="form-control" id="route" placeholder="route">
                          </div>
                       </div>
                       <div class="col-md-12">
                          <div class="form-group">
                              <label for="city">city</label>
                              <input type="text" name="city" class="form-control" id="city" placeholder="city">
                          </div>
                       </div>
                       <div class="col-md-12">
                          <div class="form-group">
                              <label for="country">country</label>
                              <input type="text" name="country" class="form-control" id="country" placeholder="country">
                          </div>
                       </div>
                       <div class="col-md-12">
                          <div class="form-group">
                              <label for="postalCode">postalCode</label>
                              <input type="text" name="postalCode" class="form-control" id="postalCode" placeholder="postalCode">
                          </div>
                       </div>
                       <div class="col-md-12">
                          <div class="form-group">
                              <label for="state">state</label>
                              <input type="text" name="state" class="form-control" id="state" placeholder="state">
                          </div>
                       </div>
                       <div class="col-md-12">
                          <div class="form-group">
                              <label for="region">region</label>
                              <input type="text" name="region" class="form-control" id="region" placeholder="region">
                          </div>
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
    var _clientID = '795362499398-njcj3441irlqjtj9srlphuubf2efqaol.apps.googleusercontent.com';
    var _apiKey = 'AIzaSyCtRuDbjjrHacZ6EqZySofNueLBLkrNxwI';
    var _map;
    var _geocoder;
    var _marker;
    var _lat = -25.647467468105795;
    var _long = 146.89921517372136;
    var _longInput = document.getElementById("longitude");
    var _latInput = document.getElementById("latitude");
    
    var _formattedInput = document.getElementById("formatted");
    var _localityInput = document.getElementById("locality");
    var _sublocalityInput = document.getElementById("sublocality");
    var _streetInput = document.getElementById("street");
    var _routeInput = document.getElementById("route");
    var _cityInput = document.getElementById("city");
    var _regionInput = document.getElementById("region");
    var _stateInput = document.getElementById("state");
    var _countryInput = document.getElementById("country");
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
                            if(types[j]=='street_number'){
                                _streetInput.value = label;
                                break;
                            }
                            if(types[j]=='route'){
                                _routeInput.value = label;
                                break;
                            }
                            if(types[j]=='sublocality'){
                                _sublocalityInput.value = label;
                                break;
                            }
                            if(types[j]=='locality'){
                                _localityInput.value = label;
                                break;
                            }
                            if(types[j]=='country'){
                                _countryInput.value = label;
                                break;
                            }
                            if(types[j]=='postal_code'){
                                _postalInput.value = label;
                                break;
                            }
                            if(types[j]=='administrative_area_level_1'){
                                _stateInput.value = label;
                                break;
                            }
                            if(types[j]=='administrative_area_level_2'){
                                _regionInput.value = label;
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

