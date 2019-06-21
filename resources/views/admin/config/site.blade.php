@extends('layouts.lte')

@section('style')
@parent
<!-- Nous chargeons les fichiers CDN de Leaflet. Le CSS AVANT le JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
    crossorigin="" />
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>
<script type="text/javascript">
    // On initialise la latitude et la longitude de Paris (centre de la carte)
    var lat = {{old('latitude',$item->meta('latitude', '-25.69'))}};
    var lon = {{old('longitude',$item->meta('longitude', '132.00'))}};
    var macarte = null;
    // Fonction d'initialisation de la carte
    function initMap() {
        // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
        macarte = L.map('map').setView([lat, lon], 4);
        // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
        L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
            // Il est toujours bien de laisser le lien vers la source des données
            attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
            minZoom: 1,
            maxZoom: 50
        }).addTo(macarte);
    }
    window.onload = function(){
        // Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
        initMap(); 
    };
</script>
<style type="text/css">
    #map{ /* la carte DOIT avoir une hauteur sinon elle n'apparaît pas */
        height:400px;
    }
</style>
@endsection

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
                          <input id="latitude" name="latitude" type="text" class="form-control" value="{{old('latitude',$item->meta('latitude', '-25.69'))}}">
                        </div>
                    </div>
                    <!-- longitude input -->
                    <div class="col-md-6">
                        <div class="form-group">
                          <label>@lang('app.longitude')</label>
                          <input id="longitude" name="longitude" type="text" class="form-control" value="{{old('longitude',$item->meta('longitude', '132.00'))}}">
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