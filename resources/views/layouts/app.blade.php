@extends('index.index')

@section('header')
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Cache-control" content="public">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Investir en Australie</title>
        <!-- Styles -->
        <link href="../../../fonts.googleapis.com/css178b.css?family=Montserrat:400,700|Poppins:400,600" rel="stylesheet">

        <!-- favicon and touch icons -->
        <link rel="shortcut icon" href="{{ link_img('favicon.png') }}">
       <!-- Bootstrap -->
        {!! plugin_css('assets/css/multirange') !!}
        {!! plugin_css('assets/css/owl.carousel') !!}
        {!! plugin_css('assets/css/owl.transitions') !!}
        {!! plugin_css('assets/css/owl.theme') !!}
        {!! plugin_css('plugins/font-awesome/css/font-awesome.min') !!}
        {!! plugin_css('plugins/slick/slick') !!}
        {!! plugin_css('plugins/slick-nav/slicknav') !!}
        {!! plugin_css('plugins/wow/animate') !!}
        {!! helper_css('bootstrap') !!}
        {!! helper_css('theme') !!}
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.9.0/css/bootstrap-slider.min.css" rel="stylesheet" />
        {!! helper_css('head') !!}

        {!! plugin_css('/searchbar/assets/css/style') !!}

        <!-- {!! plugin_css('/searchbar/assets/css/style') !!} -->

        <!-- sylesheet css search-bar -->
        <link rel="stylesheet" href="{{asset('searchbar/assets/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('searchbar/assets/css/fontello.css')}}">
        <link rel="stylesheet" href="{{asset('searchbar/assets/fonts/icon-7-stroke/css/pe-icon-7-stroke.css')}}">
        <link rel="stylesheet" href="{{asset('searchbar/assets/fonts/icon-7-stroke/css/helper.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('searchbar/assets/css/bootstrap-select.min.css')}}">
        <link rel="stylesheet" href="{{asset('searchbar/assets/css/icheck.min_all.css')}}">
        <link rel="stylesheet" href="{{asset('searchbar/assets/css/price-range.css')}}">
        <link rel="stylesheet" href="{{asset('searchbar/assets/css/responsive.css')}}">
        <!-- <link rel="stylesheet" href="{{asset('searchbar/assets/css/style.css')}}"> -->



    </head>
    <body {!! (empty($body)) ? null : $body!!}>
        <div id="page-loader">
            <div class="loaders">
                <img src="{{ link_img('assets/images/loader/3.gif') }}" alt="First Loader">
            </div>
        </div>
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
                                    <select name="currency" id="language-dropdown">
                                        <option value="FRS"> &nbsp; Fr</option>
                                        <option value="ENG"> &nbsp; Eng</option>
                                    </select>
                                </div>
                                 <div class="currency-in-header">
                                    <i class="fa fa-sign-in"></i>
                                    <label for="currency-dropdown"> S'inscrire: </label>
                                    <select name="currency" id="currency-dropdown" onChange="location.href=''+this.options[this.selectedIndex].value;">
                                        <option value="#">En tant que</option>
                                        <option value="{{url('/')}}/inscription-membre">Membre</option>
                                        <option value="{{url('/')}}/seller">vendeur</option>
                                        <option value="{{url('/')}}/AFA">A.F.A</option>
                                        <option value="{{url('/')}}/acceptation-APL">A.P.L</option>
                                    </select>
                                </div>
                                <div class="currency-in-header">
                                    <i class="fa fa-mouse-pointer"></i>
                                    <label for="currency-dropdown"> <a href="{!! route('connexion') !!}">Connexion</a> </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container top-menu" >
                <div class="row">
                    <div class="col-md-3" >
                        <figure id="site-logo" class="logo">
                            <a href="{{url("/")}}">
                                <img src="{{ link_img('assets/images/logo.png') }}" alt="Logo">
                            </a>
                        </figure>
                    </div>
                    <div class="col-md-6 col-sm-7 ">
                        <nav id="site-nav" class="nav navbar-default menuBtn">
                            <ul class="nav navbar-nav ">
                                <li>
                                    <a href="#">IMMOBILIER</a>
                                    <ul>
                                        <li>
                                            <a href="{{url('immobilier/residentiel')}}">Résidentiel</a>
                                        </li>
                                        <li>
                                            <a href="{{url('immobilier/foncier')}}">Foncier</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">BUSINESS</a>
                                    <ul>
                                        <li>
                                            <a href="{{url('business/industriel')}}">Industriel</a>
                                        </li>
                                        <li>
                                            <a href="{{url('business/commercial')}}">Commercial</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{route('front.services')}}">NOS SERVICES</a>
                                </li>
                                <li>
                                    <a href="{{route('blog')}}">BLOG</a>
                                </li>

                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-3 col-sm-4">

                            <form class="navbar-form form-search searchMenu" role="search">
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

@endsection

@section('footer')
   
  <footer id="footer">
            <div class="site-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <section class="widget about-widget clearfix">
                                <h4 class="title hide">About Us</h4>
                                <a class="footer-logo" href="#">
                                    <img src="{{ link_img('assets/images/footer-logo.png') }}" alt="Footer Logo">
                                </a>
                                <ul class="social-icons clearfix">
                                    <li>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-pinterest"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-youtube-play"></i></a>
                                    </li>
                                </ul>
                            </section>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <section class="widget address-widget clearfix">
                                <h4 class="title">acces rapide</h4>
                                <ul>
                                    <li>
                                        <a href="acceuil.php">Accueil</a>
                                    </li>
                                    <li>
                                        <a href="immobilier.php">Immobilier</a>
                                    </li>
                                    <li>
                                        <a href="business.php">Business</a>
                                    </li>
                                    <li>
                                        Nos services
                                    </li>
                                    <li>
                                        <a href="blog.php">Blog</a>
                                    </li>
                                    <li>
                                        Mon compte
                                    </li>
                                </ul>
                            </section>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <section class="widget address-widget clearfix">
                                <h4 class="title"></h4>
                                <ul>
                                    <li>
                                        Termes et conditions
                                    </li>
                                    <li>
                                        Politique de confidentialité
                                    </li>
                                    <li>
                                        Guide de l'investisseur
                                    </li>
                                    <li>
                                        Publicité
                                    </li>
                                    <li>
                                    </li>
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
                        <p> © Copyright "Investir en Australie" 2018 - Tous droits réservés</p>
                    </div>
                </div>
            </div>
        </footer>
        <a href="#top" id="scroll-top"><i class="fa fa-angle-up"></i></a>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        {!! helper_js('/assets/js/jquery.min') !!}
        {!! helper_js('assets/js/jquery.migrate') !!}
        {!! helper_js('assets/js/bootstrap.min') !!}
        {!! helper_js('plugins/slick-nav/jquery.slicknav.min') !!}
        {!! helper_js('plugins/slick/slick.min') !!}
        {!! helper_js('plugins/jquery-ui/jquery-ui.min') !!}
        {!! helper_js('plugins/forms/jquery.form.min') !!}
        {!! helper_js('plugins/forms/jquery.validate.min') !!}
        {!! helper_js('plugins/modernizr/modernizr.custom') !!}
        {!! helper_js('plugins/wow/wow.min') !!}
        {!! helper_js('plugins/zoom/zoom') !!}
        {!! helper_js('plugins/mixitup/mixitup.min') !!}
        <script src="../../../maps.googleapis.com/maps/api/js7809?key=AIzaSyD2MtZynhsvwI2B40juK6SifR_OSyj4aBA&amp;libraries=places"></script>
        {!! helper_js('plugins/whats-nearby/source/WhatsNearby') !!}
        {!! helper_js('assets/js/theme') !!}
        {!! helper_js('assets/js/multirange') !!}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.9.0/bootstrap-slider.js"></script>
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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.9.0/bootstrap-slider.min.js"></script>
        {!! helper_js('assets/js/head') !!}

    </body>
    </html>    
@endsection