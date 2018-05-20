@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <div id="page-content" class="page-content tab-content overflow-y">
        <div id="TabTop1" class="tab-pane padding-bottom30 active fade in">
            @include('includes.notification')
            <div class="page-header">
                <h3>Profil administrateur</h3>
            </div>
            <div class="row-fluid">
                <div class="grider">
                    <form class="form-horizontal" method="post" action="{{$action}}" enctype="multipart/form-data" data-upload-template-id="template-upload-1" data-download-template-id="template-download-1">
                        {{ csrf_field() }}
                        <div class="widget widget-simple">
                            <div class="widget-header">
                                <h4>@lang('app.form.login')</h4>
                            </div>
                            <div class="widget-content">
                                <div class="widget-body">
                                    <div class="control-group">
                                        <input class="input-block-level" value="{{$item->name}}" placeholder="@lang('app.form.login')" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget widget-simple">
                            <div class="widget-header">
                                <h4>@lang('app.form.email')</h4>
                            </div>
                            <div class="widget-content">
                                <div class="widget-body">
                                    <div class="control-group">
                                        <input class="input-block-level" value="{{$item->email}}" placeholder="@lang('app.form.email')" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget widget-simple">
                            <div class="widget-header">
                                <h4>@lang('app.form.language')</h4>
                            </div>
                            <div class="widget-content">
                                <div class="widget-body">
                                    <div class="control-group">
                                        <select name="language" class="form-control" id="language">
                                            <option value="fr" {{$item->language=='fr'?'selected':''}}>Français</option>
                                            <option value="en" {{$item->language=='en'?'selected':''}}>English</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget widget-simple">
                            <div class="widget-header">
                                <h4>@lang('app.form.first_name')</h4>
                            </div>
                            <div class="widget-content">
                                <div class="widget-body">
                                    <div class="control-group">
                                        <input class="input-block-level" value="{{old('first_name')?old('first_name'):$item->get_meta('first_name')?$item->get_meta('first_name')->value:''}}" name="first_name" placeholder="@lang('app.form.first_name')">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget widget-simple">
                            <div class="widget-header">
                                <h4>@lang('app.form.last_name')</h4>
                            </div>
                            <div class="widget-content">
                                <div class="widget-body">
                                    <div class="control-group">
                                        <input class="input-block-level" value="{{old('last_name')?old('last_namelast_name'):$item->get_meta('last_name')?$item->get_meta('last_name')->value:''}}" name="last_name" placeholder="@lang('app.form.last_name')">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions no-margin-bootom">
                            <button type="submit" class="btn btn-green">Sauvegarder</button>
                            <button class="btn cancel" type="reset">Annuler</button>
                            <a href="javascript:history.back()" class="btn btn-green pull-right" type="submit">Allez au precedent</a>
                        </div> 

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

