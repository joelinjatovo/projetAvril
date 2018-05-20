@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <!-- // page head -->
    <div id="page-content" class="page-content tab-content overflow-y">
        <div id="TabTop1" class="tab-pane padding-bottom30 active fade in">
            <div class="page-header">
                <h3>Profil de l'admin</h3>
            </div>
            <div class="row-fluid">
                <div class="grider">
                    <div class="widget widget-simple">
                        @include('includes.alerts')
                        <div class="widget-content">
                            <div class="widget-body">
                                
        <fieldset>
            <legend>Login Information</legend>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-4">
                        <section class="widget">
                            <img src="{{$item->imageUrl(false)}}" alt="{{$item->name}}"  width="100%">
                        </section>
                    </div>
                    <div class="col-sm-8">
                        <p><strong>@lang('app.form.login')</strong>: {{$item->name}}</p>
                        <p><strong>@lang('app.form.email')</strong>: {{$item->email}}</p>
                        <p><strong>@lang('app.form.first_name')</strong>: {{$item->get_meta('first_name')?$item->get_meta('first_name')->value:''}}</p>
                        <p><strong>@lang('app.form.last_name')</strong>: {{$item->get_meta('last_name')?$item->get_meta('last_name')->value:''}}</p>
                        <p><strong>@lang('app.form.language')</strong>: {{$item->language=='en'?'Anglais':'Français'}}</p>
                        <div>
                            <div class="form-group">
                                <a href="{{route('profile.edit')}}" class="btn btn-default">Modifier Profile</a>
                                <a href="{{route('avatar.edit')}}"  class="btn btn-warning">Modifier Avatar</a>
                                <a href="{{route('password.edit')}}"  class="btn btn-success">Modifier Mot de passe</a>
                                <a href="{{route('location.edit')}}" class="btn btn-info">Modifier Localisation</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
                            </div>
                        </div>
                    </div>
                    <!-- // Widget -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

