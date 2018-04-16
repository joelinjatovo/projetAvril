<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login - {{ config('app.name', 'Investir En Australie') }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="description" content="">
<meta name="author" content="">

<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="{{asset('images/favicon.png')}}">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('ico/apple-touch-icon-144-precomposed.png')}}">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('ico/apple-touch-icon-114-precomposed.png')}}">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('ico/apple-touch-icon-72-precomposed.png')}}">
<link rel="apple-touch-icon-precomposed" href="{{asset('ico/apple-touch-icon-57-precomposed.png')}}">

<!-- Le styles -->
<link href="{{asset('administrator/css/lib/bootstrap-responsive.css')}}" rel="stylesheet">
<link href="{{asset('administrator/css/lib/bootstrap.css')}}" rel="stylesheet">
<link href="{{asset('administrator/css/boo-coloring.css')}}" rel="stylesheet">
<link href="{{asset('administrator/css/boo-extension.css')}}" rel="stylesheet">
<link href="{{asset('administrator/css/boo-utility.css')}}" rel="stylesheet">
<link href="{{asset('administrator/css/boo.css')}}" rel="stylesheet">
<link href="{{asset('administrator/css/style.css')}}" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements --
> -->
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js')}}"></script>
    <script src="{{asset('plugins/selectivizr/selectivizr-min.js')}}"></script>
    <script src="{{asset('plugins/flot/excanvas.min.js')}}"></script>
<![endif]-->
    
</head>

<body class="signin signin-horizontal">
<div class="page-container">
    <div id="header-container">
        <div id="header">
            <div class="navbar-inverse navbar-fixed-top">
                <div class="navbar-inner">
                    <div class="container"> </div>
                </div>
            </div>
            <!-- // navbar -->

            <div class="header-drawer" style="height:3px"> </div>
            <!-- // breadcrumbs -->
        </div>
        <!-- // drawer -->
    </div>
    <!-- // header-container -->

    <div id="main-container">
        <div id="main-content" class="main-content container">
            <div id="page-content" class="page-content">
                <div class="row">
                    <div class="tab-content overflow form-dark">
                        <div class="tab-pane fade in active" id="login">
                            <div class="span5">
                                <h4 class="welcome"> <small><i class="fontello-icon-user-4"></i>Se Connecter</small></h4>
                                <form method="post" action="{{ route('login') }}" name="login_form">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 control-label">Adresse E-Mail </label>

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
                                        <label for="password" class="col-md-4 control-label">Mot de passe</label>

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
                                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Se souvenir de moi
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Connexion
                                            </button>

                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                Mot de passe oublié?
                                            </a>
                                        </div>
                                    </div>
                                    
                                </form>
                                <!-- // form -->
                            </div>
                            
                            <div class="span7">
                                <!-- <h4 class="welcome"><small>Investir en Australie</small></h4> -->
                                <img src="{{asset('images/logo.png')}}">
<p>J'ai créé le site www.investirenaustralie.com pour développer les échanges de la communauté francophone avec l'Australie. Cela concerne donc la France Métropolitaine et ses territoires ultramarins de la Mer Méditerranée et des 3 grands océans, la Belgique, le Luxembourg, la Suisse, Monaco, le Québec, les pays de l'Afrique francophone, etc...</p>
<p>Les constructeurs et promoteurs australiens déposent sur le site leurs produits immobiliers, fonciers, industriels et commerciaux; les Membres de la communauté francophone internationale intéressés par l'Australie parcourent les offres déposées sur le site, contactent les vendeurs, et peuvent initier une procédure d'achat en étant assistés de juristes et financiers australiens francophones.
L'acheteur est donc entouré par une équipe de professionnels francophones auprès desquels ils peuvent obtenir explications et soutien.</p>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <!-- // page content -->

        </div>
        <!-- // main-content -->

    </div>
    <!-- // main-container  -->

</div>
<!-- // page-container -->

<!-- Le javascript -->

</body>
</html>
