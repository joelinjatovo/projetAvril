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
<div class="main-slider-wrapper clearfix content corps">

        <div id="site-banner" class="text-center clearfix">
                <div class="container">
                    <h1 class="title wow slideInLeft">Connexion</h1>
                    <ol class="breadcrumb wow slideInRight">
                        <li><a href="http://localhost/iea">Accueil</a></li>
                        <li class="active">Connexion</li>
                    </ol>
                </div>
            </div>
    </div>

<div id="contact-page" class="contact-page-var-two">
    <div class="container">
        <h3 class="entry-title">Connexion</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="contact-form-wrapper">
                    <div class="contents">
                        <p>Sed perspiciatis unde natus error sit voluptatem accusantium doloremque  laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae.</p>
                    </div>
                    <div class="contact-page-contents clearfix">
                        <div class="row">
                            <div class="col-md-6">
                                <i class="fa fa-map-marker"></i>
                                <div class="contents">
                                    <h6 class="title">Mailing Address</h6>
                                    <address>
                                        95 Amphitheatre Parkway
                                        Mountain View CA,
                                        United States
                                    </address>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <i class="fa fa-phone"></i>
                                <div class="contents">
                                    <h5 class="title">Contact Info</h5>
                                    <ul>
                                        <li>Phone: (123) 45678910</li>
                                        <li>Mail: company@domain.com</li>
                                        <li>Fax: +84 962 216 601</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
    <div id="map-canvas"></div>
</div>
@endsection

@section('script')
<script>
    /*****************************************************
     *Google Maps
     ******************************************************/
    function initializeContactMap()
    {
        var officeLocation = new google.maps.LatLng(-24.841552, 137.33135);
        var contactMapOptions = {
            center: officeLocation,
            zoom: 6,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false
        };
        var contactMap = new google.maps.Map(document.getElementById("map-canvas"), contactMapOptions);
        var contactMarker = new google.maps.Marker({
            position: officeLocation,
            map: contactMap
        });
    }

    window.onload = initializeContactMap();
</script>
@endsection