@extends('layouts.lte')

@section('content')
<form method="post" action="{{route('config.site.update')}}">
    {{csrf_field()}}
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Referencement</h3>
                  <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body">
                    <!-- title input -->
                    <div class="form-group">
                      <label>@lang('app.admin.meta_title')</label>
                      <input name="meta_title" type="text" class="form-control" value="{{old('meta_title',$item->meta('meta_title', ''))}}">
                    </div>
                    <!-- meta_desc -->
                    <div class="form-group">
                      <label>@lang('app.admin.meta_desc')</label>
                      <textarea name="meta_desc" class="form-control" rows="3" placeholder="@lang('app.admin.meta_desc.desc')">{!!old('meta_desc',$item->meta('meta_desc', ''))!!}</textarea>
                    </div>
                    <!-- meta_keywords -->
                    <div class="form-group">
                      <label>@lang('app.admin.meta_keywords')</label>
                      <textarea name="meta_keywords" class="form-control" rows="3" placeholder="@lang('app.admin.meta_keywords.desc')">{!!old('meta_keywords',$item->meta('meta_keywords', ''))!!}</textarea>
                    </div>
                </div>
                <!-- /.box-body -->
           </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Administrateur du site</h3>
                  <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body">
                    <!-- form-control input -->
                    <div class="form-group">
                        <label>@lang('app.select_admin')</label>
                        <select name="admin" class="select2 form-control">
                            <option value="0">@lang('app.select_admin')</option>
                            @foreach($admins as $admin)
                            <option value="{{$admin->id}}" {{old('admin', 
                                    $item->get_meta('admin')?$item->get_meta('admin')->value:0)==$admin->id?'selected':0}}>{{$admin->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- admin_name input -->
                    <div class="form-group">
                      <label>@lang('app.admin.admin_name')</label>
                      <input name="admin_name" type="text" class="form-control" value="{{old('admin_name',$item->meta('admin_name', ''))}}">
                    </div>
                    <!-- admin_email input -->
                    <div class="form-group">
                      <label>@lang('app.admin.admin_email')</label>
                      <input name="admin_email" type="email" class="form-control" value="{{old('admin_email',$item->meta('admin_email', ''))}}">
                    </div>
                    <!-- admin_phone input -->
                    <div class="form-group">
                      <label>@lang('app.admin.admin_phone')</label>
                      <input name="admin_phone" type="text" class="form-control" value="{{old('admin_phone',$item->meta('admin_phone', ''))}}">
                    </div>
                </div>
                <!-- /.box-body -->
           </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Localisation du site</h3>
                  <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body">
                    <!-- latitude input -->
                    <div class="col-md-6">
                        <div class="form-group">
                          <label>@lang('app.latitude')</label>
                          <input id="latitude" name="latitude" type="text" class="form-control" value="{{old('latitude',$item->meta('latitude', ''))}}">
                        </div>
                    </div>
                    <!-- longitude input -->
                    <div class="col-md-6">
                        <div class="form-group">
                          <label>@lang('app.longitude')</label>
                          <input id="longitude" name="longitude" type="text" class="form-control" value="{{old('longitude',$item->meta('longitude', ''))}}">
                        </div>
                    </div>
                   <div class="col-md-12">
                        <div id="map" style="width:100%; height: 400px;"></div>
                   </div>
                </div>
                <!-- /.box-body -->
           </div>
       </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
              <button type="submit" class="btn btn-info" name="method" value="draft"><i class="fa fa-database"></i> @lang('app.btn.save')</button>
          </div>
          <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> @lang('app.btn.discard')</button>
        </div>
    </div>
</form>
@endsection

@section('script')
@parent
<script>
    var _map;
    var _marker;
    var _lat = -25.647467468105795;
    var _long = 146.89921517372136;
    var _longInput = document.getElementById("longitude");
    var _latInput = document.getElementById("latitude");
    
    
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
        });

        _marker.addListener('dragend', function() {
             var lat = _latInput.value = _marker.getPosition().lat();
             var lng = _longInput.value = _marker.getPosition().lng();
        });
        
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
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCXJRoVA2VTBXx5Vidrdop_1pqKKguDPrY&callback=initMap"></script>
@endsection