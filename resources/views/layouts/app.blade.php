<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Cache-control" content="public">
    
<title>Investir en Australie</title>
<!-- favicon and touch icons -->
<link rel="shortcut icon" href="{{ link_img('favicon.png') }}">
    
<!-- Bootstrap -->
<link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap-slider.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">

<!-- sylesheet css search-bar -->
<link rel="stylesheet" href="{{asset('css/icheck.min_all.css')}}">
<link rel="stylesheet" href="{{asset('css/price-range.css')}}">
    
<link href="{{asset('css/multirange.css')}}" rel="stylesheet">
<link href="{{asset('css/owl.carousel.css')}}" rel="stylesheet">
<link href="{{asset('css/owl.transitions.css')}}" rel="stylesheet">
<link href="{{asset('css/owl.theme.css')}}" rel="stylesheet">
<link href="{{asset('plugins/slick/slick.css')}}" rel="stylesheet">
<link href="{{asset('plugins/slick-nav/slicknav.css')}}" rel="stylesheet">
<link href="{{asset('plugins/wow/animate.css')}}" rel="stylesheet">
    
<!-- Plugins -->
<link rel="stylesheet" href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/fontello/css/fontello.css')}}">
<link rel="stylesheet" href="{{asset('plugins/icon-7-stroke/css/pe-icon-7-stroke.css')}}">
<link rel="stylesheet" href="{{asset('plugins/icon-7-stroke/css/helper.css')}}" rel="stylesheet">
    
<!-- Styles -->
<link href="{{asset('css/theme.css')}}" rel="stylesheet">
<link href="{{asset('css/head.css')}}" rel="stylesheet">
<link href="{{asset('css/style.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/responsive.css')}}">

@yield('style')

</head>
<body>
<header id="head">
    <div id="site-header-top" class="barreNoir">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="clearfix">
                        <p class="contanct">Appelez-nous: +61 00 000 000</p>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="clearfix">
                        <div class="language-in-header">
                            <a href="{{social('googleplus.value')}}"><i class="{{social('googleplus.font')}}"></i></a>
                        </div>
                        <div class="language-in-header">
                            <a href="{{social('linkedin.value')}}"><i class="{{social('linkedin.font')}}"></i></a>
                        </div>
                        <div class="language-in-header">
                            <a href="{{social('twitter.value')}}"><i class="{{social('twitter.font')}}"></i></a>
                        </div>
                        <div class="language-in-header">
                            <a href="{{social('facebook.value')}}"><i class="{{social('facebook.font')}}"></i></a>
                        </div>
                        <div class="language-in-header">
                            <i class="fa fa-globe"></i>
                            <label for="language-dropdown">Langue :</label>
                            <select name="currency" id="language-dropdown" onChange="location.href=''+this.options[this.selectedIndex].value;">
                                <option value="{{route('localization', ['locale'=>'fr'])}}" @if('fr'==App::getLocale()) {{'selected'}} @endif>Fr</option>
                                <option value="{{route('localization', ['locale'=>'en'])}}" @if('en'==App::getLocale()) {{'selected'}} @endif>Eng</option>
                            </select>
                        </div>
                        @if(!Auth::check())
                        <div class="currency-in-header">
                            <i class="fa fa-sign-in"></i>
                            <label for="currency-dropdown"> S'inscrire: </label>
                            <select name="currency" id="currency-dropdown" onChange="location.href=''+this.options[this.selectedIndex].value;">
                                <option value="#">En tant que</option>
                                <option value="{{route('register', ['role'=>'member'])}}">Membre</option>
                                <option value="{{route('register', ['role'=>'seller'])}}">vendeur</option>
                                <option value="{{route('register', ['role'=>'afa'])}}">A.F.A</option>
                                <option value="{{route('register', ['role'=>'apl'])}}">A.P.L</option>
                            </select>
                        </div>
                        <div class="currency-in-header">
                            <i class="fa fa-mouse-pointer"></i>
                            <label for="currency-dropdown"> <a href="{{route('login')}}">Connexion</a> </label>
                        </div>
                        @else
                        <div class="currency-in-header">
                            <i class="fa fa-user"></i><a href="{{route('admin.dashboard')}}">{{Auth::user()->name}}</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container top-menu" >
        <div class="row">
            <div class="col-md-3" >
                <figure id="site-logo" class="logo">
                    <a href="{{route('home')}}">
                        <img src="{{asset('images/logo.png')}}" alt="Logo">
                    </a>
                </figure>
            </div>
            <div class="col-md-6 col-sm-7 ">
                <nav id="site-nav" class="nav navbar-default menuBtn">
                    <ul class="nav navbar-nav ">
                        <li><a href="#">IMMOBILIER</a>
                            <ul>
                                <li><a href="{{route('product.all')}}">Résidentiel</a></li>
                                <li><a href="{{route('product.all')}}">Foncier</a></li>
                            </ul>
                        </li>
                        <li><a href="#">BUSINESS</a>
                            <ul>
                                <li><a href="{{route('product.all')}}">Industriel</a></li>
                                <li><a href="{{route('product.all')}}">Commercial</a></li>
                            </ul>
                        </li>
                        <li><a href="{{route('services')}}">NOS SERVICES</a></li>
                        <li><a href="{{route('blog.all')}}">BLOG</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-3 col-sm-4">
                <form class="navbar-form form-search searchMenu" role="search" action="{{route('search')}}">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name="q">
                        <div class="input-group-btn">
                            <button class="btn search-btn" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- </nav> -->
</header>

<!-- content -->
@yield('content')

<footer id="footer">
    <div class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <section class="widget about-widget clearfix">
                        <h4 class="title hide">About Us</h4>
                        <a class="footer-logo" href="#">
                            <img src="{{asset('images/footer-logo.png')}}" alt="Footer Logo">
                        </a>
                        <ul class="social-icons clearfix">
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                        </ul>
                    </section>
                </div>
                <div class="col-md-4 col-sm-6">
                    <section class="widget address-widget clearfix">
                        <h4 class="title">acces rapide</h4>
                        <ul>
                            <li><a href="{{route('home')}}">Accueil</a></li>
                            <li><a href="{{route('product.all')}}">Immobilier</a></li>
                            <li><a href="{{route('product.all')}}">Business</a></li>
                            <li><a href="{{route('services')}}">Nos services</a></li>
                            <li><a href="{{route('blog.all')}}">Blog</a></li>
                            <li>Mon compte</li>
                        </ul>
                    </section>
                </div>
                <div class="col-md-4 col-sm-6">
                    <section class="widget address-widget clearfix">
                        <h4 class="title"></h4>
                        <ul>
                            <li><a href="{{route('terms')}}">Termes et conditions</a></li>
                            <li><a href="{{route('confidentialities')}}">Politique de confidentialité</a></li>
                            <li><a href="{{route('help')}}">Guide de l'investisseur</a></li>
                            <li><a href="{{route('publicities')}}">Publicité</a></li>
                        </ul>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <div class="site-footer-bottom">
        <div class="container text-center">
            <div>
                <p>INVESTIR EN AUSTRALIE est un e-marketplace.</p>
                <p> © Copyright "Investir en Australie" {{date('Y')}} - Tous droits réservés</p>
            </div>
        </div>
    </div>
</footer>
<a href="#top" id="scroll-top"><i class="fa fa-angle-up"></i></a>

<!-- javascript search-bar -->
<script src="{{asset('js/jquery-1.10.2.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('js/bootstrap-hover-dropdown.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/wow.js')}}"></script>
<script src="{{asset('js/icheck.min.js')}}"></script>
<script src="{{asset('js/price-range.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('plugins/forms/jquery.form.min.js')}}"></script>
<script src="{{asset('plugins/forms/jquery.validate.min.js')}}"></script>
<script src="{{asset('plugins/modernizr/modernizr.custom.js')}}"></script>
<script src="{{asset('plugins/wow/wow.min.js')}}"></script>
<script src="{{asset('plugins/zoom/zoom.js')}}"></script>
<script src="{{asset('plugins/mixitup/mixitup.min.js')}}"></script>
<script src="{{asset('plugins/whats-nearby/source/WhatsNearby.js')}}"></script>
    
<script src="{{asset('js/theme.js')}}"></script>
<script src="{{asset('js/multirange.js')}}"></script>
<script src="{{asset('js/head.js')}}"></script>

<!-- Slider Range -->
<script type='text/javascript'>
    $(document).ready(function () {
        $("#ex2").slider({
            formatter: function (value) {
                return 'Current value: ' + value;
            }
        });
    });
</script>
<!-- Slider Range -->
<script type='text/javascript'>
    $(document).ready(function () {
        $("#ex3").slider({
            formatter: function (value) {
                return 'Current value: ' + value;
            }
        });
    });
</script>
 <!-- Slider Range -->
<script type='text/javascript'>
    $(document).ready(function () {
        $("#ex4").slider({
            formatter: function (value) {
                return 'Current value: ' + value;
            }
        });
    });
</script>
@yield('script')
    
</body>
</html>    
