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
                @include('includes.alerts')
                <form class="contact-form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <p class="form-author common form-group {{ $errors->has('email') ? ' has-error' : '' }}"> 
                        <input name="email" type="email" placeholder="Votre email *" aria-required="true" required="required" value="{{ old('email') }}" autofocus>
                    </p>
                    <p class="form-author common form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                         <input name="password"  type="password" placeholder="Votre mot de passe *" aria-required="true" required="required">
                    </p>
                    <p><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me</p>
                    <p>Vous avez un compte ?<a href="{{ route('register',['role'=>'member']) }}"> Inscrivez-vous </a></p>
                    <p>
                        <a href="{{ route('password.request') }}">Forgot Your Password?</a>
                    </p>
                    <p class="form-submit">
                        <button type="submit" class="pull-right btn btn-default btn-lg" data-hover="Connexion">Connexion</button>
                        <span id="ajax-loader"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i><span class="sr-only">Loading...</span></span>
                    </p>
                    <div id="error-container"></div>
                    <div id="message-container"></div>
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