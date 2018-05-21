@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <div id="page-content" class="page-content">
        <section>
            <div class="page-header">
                <h3>@lang('app.info_site')</h3>
            </div>
            @include('includes.alerts')
            <form method="post" action="{{route('config.site.update')}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row-fluid margin-bottom40">
                    <div class="span12 well well-nice">
                      <label for="titreSite">Titre du site</label>
                      <input id="titreSite" class="input-block-level" type="text" name="meta_title" 
                             value="{{old('meta_title')?old('meta_title'):($item->get_meta('meta_title')?$item->get_meta('meta_title')->value:'')}}">
                      <label for="titreDesc">Meta Description du site</label>
                      <textarea id="titreDesc" class="input-block-level" type="text" name="meta_desc" row="10">{{old('meta_desc')?old('meta_desc'):($item->get_meta('meta_desc')?$item->get_meta('meta_desc')->value:'')}}</textarea>
                      <label for="titreKeywords">Mots cles</label>
                      <textarea id="titreKeywords" class="input-block-level" type="text" name="meta_keywords" >{{old('meta_keywords')?old('meta_keywords'):($item->get_meta('meta_keywords')?$item->get_meta('meta_keywords')->value:'')}}</textarea>
                        <hr>
                      <label for="admin_name">Admin Name</label>
                      <input id="admin_name" class="input-block-level" type="text" name="admin_name" 
                             value="{{old('admin_name')?old('admin_name'):($item->get_meta('admin_name')?$item->get_meta('admin_name')->value:'')}}">
                      <label for="admin_email">Admin Email</label>
                      <input id="admin_email" class="input-block-level" type="text" name="admin_email" 
                             value="{{old('admin_email')?old('admin_email'):($item->get_meta('admin_email')?$item->get_meta('admin_email')->value:'')}}">
                      <label for="admin_phone">Admin Phone</label>
                      <input id="admin_phone" class="input-block-level" type="text" name="admin_phone" 
                             value="{{old('admin_phone')?old('admin_phone'):($item->get_meta('admin_phone')?$item->get_meta('admin_phone')->value:'')}}">
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12 well well-nice">
                        <div class="span6">
                            <label for="latitude">Latitude</label>
                            <input id="latitude" class="input-block-level" type="text" name="latitude" 
                             value="{{old('latitude')?old('latitude'):($item->get_meta('latitude')?$item->get_meta('latitude')->value:'')}}">
                        </div>
                        <div class="span6">
                            <label for="longitude">Longitude</label>
                            <input id="longitude" class="input-block-level" type="text" name="longitude" 
                             value="{{old('longitude')?old('longitude'):($item->get_meta('longitude')?$item->get_meta('longitude')->value:'')}}">
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12 well well-nice">
                        <div id="map" style="width:100%;"></div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">@lang('app.btn.save')</button>
                <button type="reset" class="btn btn-default">@lang('app.btn.cancel')</button>
            </form>
        </section>
    </div>
</div>

@endsection