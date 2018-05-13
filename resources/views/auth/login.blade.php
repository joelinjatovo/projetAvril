@extends('layouts.app')

@section('style')
<style>
.modal {
    display: none;
    overflow: scroll;
    position: fixed;
    top: 0px;
}
</style>
@endsection

@section('content')
<div id="contact-page" class="contact-page-var-two" style="margin-top: 160px;">
    <div class="container">
        <h3 class="entry-title">@lang('app.connexion')</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="contact-form-wrapper">
                    <div class="contents">
                        <p>{!!$item->content!!}</p>
                    </div>
                    @foreach($item->childs as $child)
                    <div class="contact-page-contents clearfix">
                        {!!$child->content!!}
                    </div>
                    @endforeach

                </div>
            </div>
            <div class="col-md-6">
                @include('includes.alerts')
                <form class="contact-form" method="POST" action="{{route('login')}}">
                    {{ csrf_field() }}
                    <p class="form-email common form-group {{ $errors->has('email') ? ' has-error' : '' }}"> 
                        <input name="email" type="email" placeholder="Votre email *" aria-required="true" required="required" value="{{ old('email') }}" autofocus>
                    </p>
                    <p class="form-author common form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                         <input name="password"  type="password" placeholder="Votre mot de passe *" aria-required="true" required="required">
                    </p>
                    <p><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('app.form.login.remember')</p>
                    <p>@lang('app.form.login.have_not_account') <a href="{{ route('register',['role'=>'member']) }}"> @lang('app.form.login.register') </a></p>
                        <a href="{{ route('password.request')}}" class="pull-right">@lang('app.form.login.forgot')</a>
                    </p>
                    <p class="form-submit">
                        <button type="submit" class="pull-right btn btn-default btn-lg" data-hover="Connexion">@lang('app.btn.login')</button>
                    </p>
                </form>
            </div>
        </div>
    </div>
    <div id="map-canvas"></div>
</div>
@endsection

@section('script')
<script>
    var _map;
    var _marker;
    var _lat = {{isset($latitude)?floatval($latitude):-25.647467468105795}};
    var _long = {{isset($longitude)?floatval($longitude):146.89921517372136}};
    function initMap() {
        _map = new google.maps.Map(document.getElementById('map-canvas'), {
            center: {lat: _lat, lng:  _long},
            zoom: 2
        });
        _marker = new google.maps.Marker({
          position: {lat: _lat, lng: _long},
          map: _map
        });
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtRuDbjjrHacZ6EqZySofNueLBLkrNxwI&callback=initMap"></script>
</script>
@endsection