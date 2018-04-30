@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <div id="page-content" class="page-content">
        <section>
            <div class="page-header">
                <h3>@lang('app.info_site')</h3>
            </div>
            @include('includes.alerts')
            <div class="row-fluid margin-bottom40">
                <div class="span7 well well-nice">
                    <fieldset>
                        <legend>Localisation MAP</legend>
                        <div id="map" style="width:100%;height:400px"></div>
                        <!-- MAP -->
                          <script>
                          function myMap() {
                            var mapCanvas = document.getElementById("map");
                            var myCenter = new google.maps.LatLng({{$item->get_meta("latitude")?$item->get_meta("latitude")->value:''}},{{$item->get_meta('longitude')?$item->get_meta('longitude')->value:''}});
                            var mapOptions = {center: myCenter, zoom: 5};
                            var map = new google.maps.Map(mapCanvas,mapOptions);
                            var marker = new google.maps.Marker({
                              position: myCenter,
                              animation: google.maps.Animation.BOUNCE
                            });
                            marker.setMap(map);
                          }
                          </script>
                    </fieldset>
                </div>

                <div class="span5">
                    <form method="post" action="{{route('config.site.update')}}">
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                      <label for="identifiant">Identifiant</label>
                      <input id="identifiant" class="input-block-level" type="text" name="identifiant" 
                             value="{{old('identifiant')?old('identifiant'):($item->get_meta('identifiant')?$item->get_meta('identifiant')->value:'')}}">
                      <label for="nomSite">Nom du site</label>
                      <input id="nomSite" class="input-block-level" type="text" name="app_name" 
                             value="{{old('app_name')?old('app_name'):($item->get_meta('app_name')?$item->get_meta('app_name')->value:'')}}">
                      <label for="titreSite">Titre du site</label>
                      <input id="titreSite" class="input-block-level" type="text" name="meta_title" 
                             value="{{old('meta_title')?old('meta_title'):($item->get_meta('meta_title')?$item->get_meta('meta_title')->value:'')}}">
                      <label for="app_email">Adressse email</label>
                      <input id="app_email" class="input-block-level" type="text" name="app_email" 
                             value="{{old('app_email')?old('app_email'):($item->get_meta('app_email')?$item->get_meta('app_email')->value:'')}}">
                      <label for="latitude">Latitude</label>
                      <input id="latitude" class="input-block-level" type="text" name="latitude" 
                             value="{{old('latitude')?old('latitude'):($item->get_meta('latitude')?$item->get_meta('latitude')->value:'')}}">
                      <label for="longitude">Longitude</label>
                      <input id="longitude" class="input-block-level" type="text" name="longitude" 
                             value="{{old('longitude')?old('longitude'):($item->get_meta('longitude')?$item->get_meta('longitude')->value:'')}}">
                      <button type="submit" class="btn btn-primary">@lang('app.btn.save')</button>
                      <button type="reset" class="btn btn-default">@lang('app.btn.cancel')</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection