<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Cache-control" content="public">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{app_name()}} {{isset($title)?' - '.$title:''}}</title>
<meta name="description" content="{{option('site.meta_desc', 'IEA')}}">
<meta name="keywords" content="{{option('site.meta_keywords', 'IEA, Investir')}}">
    
<!-- favicon and touch icons -->
<link rel="shortcut icon" href="{{asset('images/favicon.png')}}">
    
<!-- App -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
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
<link href="{{asset('css/responsive.css')}}" rel="stylesheet">
    
<!-- Scripts -->
<script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
        
    //This makes the current user's id available in javascript
    @if(!auth()->guest())
        window.Laravel.role = '<?php echo auth()->user()->role; ?>';
        window.Laravel.userId = <?php echo auth()->user()->id; ?>;
    @endif
</script>

<style>
#mute {
  position: absolute;
}
#mute.on {
  opacity: 0.7;
  z-index: 1000;
  background: white;
  height: 100%;
  width: 100%;
}
</style>

@yield('style')
    
@yield('style-stripe')
</head>
<body>
<div id="mute"></div>
<header id="head">
    <div id="site-header-top" class="barreNoir">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="clearfix">
                        <p class="contanct">@lang('app.contact_us_phone', ['phone'=>option('site.admin_phone', '+61 33 333 33')])</p>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="clearfix">
                        @php $socialConfig = \App\Models\Config::social(); @endphp
                        @foreach(\App\Models\Config::socialRules() as $key => $value)
                            @if($metaConfig = $socialConfig->get_meta($key))
                            <div class="language-in-header">
                                <a href="{{$metaConfig->value}}"><i class="{{'fa fa-'.$key}}"></i></a>
                            </div>
                            @endif
                        @endforeach
                        <div class="language-in-header">
                            <i class="fa fa-globe"></i>
                            <label for="language-dropdown">@lang('app.language') :</label>
                            <select name="currency" id="language-dropdown" onChange="location.href=''+this.options[this.selectedIndex].value;">
                                <option value="{{route('localization', ['locale'=>'fr'])}}" @if(App::isLocale('fr')) selected @endif>Fr</option>
                                <option value="{{route('localization', ['locale'=>'en'])}}" @if(App::isLocale('en')) selected @endif>Eng</option>
                            </select>
                        </div>
                        @if(!Auth::check())
                        <div class="currency-in-header">
                            <i class="fa fa-sign-in"></i>
                            <label for="currency-dropdown"> S'inscrire: </label>
                            <select id="currency-dropdown" onChange="location.href=''+this.options[this.selectedIndex].value;">
                                <option value="#">@lang('app.as')</option>
                                <option value="{{route('register', ['role'=>'member'])}}">@lang('app.member')</option>
                                <option value="{{route('register', ['role'=>'seller'])}}">@lang('app.seller')</option>
                                <option value="{{route('register', ['role'=>'afa'])}}">@lang('app.afa')</option>
                                <option value="{{route('register', ['role'=>'apl'])}}">@lang('app.apl')</option>
                            </select>
                        </div>
                        <div class="currency-in-header">
                            <i class="fa fa-mouse-pointer"></i>
                            <label for="currency-dropdown"> <a href="{{route('login')}}">@lang('app.connexion')</a> </label>
                        </div>
                        @else
                        <div class="currency-in-header">
                            <i class="fa fa-user"></i><a href="{{url(Auth::user()->role)}}">{{Auth::user()->name}}</a>
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
                        <li><a href="#">@lang('app.immobilier')</a>
                            <ul>
                                <li><a href="{{route('shop.index', \App\Models\Category::find(1))}}">@lang('app.residentiel')</a></li>
                                <li><a href="{{route('shop.index', \App\Models\Category::find(2))}}">@lang('app.foncier')</a></li>
                            </ul>
                        </li>
                        <li><a href="#">@lang('app.business')</a>
                            <ul>
                                <li><a href="{{route('shop.index', \App\Models\Category::find(3))}}">@lang('app.industrial')</a></li>
                                <li><a href="{{route('shop.index', \App\Models\Category::find(4))}}">@lang('app.commercial')</a></li>
                            </ul>
                        </li>
                        <li><a href="{{route('services')}}">@lang('app.services')</a></li>
                        <li><a href="{{route('blog.all')}}">@lang('app.blog')</a></li>
                        @if(Auth::check())
                        <li>
                            <a href="{{route('profile')}}">@lang('app.account')</a>
                            <ul>
                                <li>
                                    <a href="{{url(Auth::user()->role)}}">@lang('app.dashboard')</a>
                                </li>
                                <li>
                                    <a href="{{route('profile')}}">@lang('app.profile')</a>
                                </li>
                                <li>
                                    <a href="{{route('logout')}}">@lang('app.logout')</a>
                                </li>
                            </ul>
                        </li>
                        
                        <!-- // add this dropdown // -->
                        <li class="dropdown">
                            <a class="dropdown-toggle" id="notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <span class="fa fa-user"></span>
                                <span id="notificationsCount" class="badge badge-info hidden" style="margin-left:-5px; margin-top:-10px; background-color: red;">&nbsp;</span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="notificationsMenu" id="notificationsMenu">
                                <li class="dropdown-header">@lang('app.no_notification')</li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
            <div class="col-md-3 col-sm-4">
                <form method="get" class="navbar-form form-search searchMenu" role="search" action="{{route('shop.index')}}">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name="q" value="{{isset($q)?$q:''}}">
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
@include('includes.alerts')

@yield('content')

<footer id="footer">
    <div class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <section class="widget about-widget clearfix">
                        <h4 class="title hide">@lang('app.about_us')</h4>
                        <a class="footer-logo" href="{{route('home')}}">
                            <img src="{{asset('images/footer-logo.png')}}" alt="Footer Logo">
                        </a>
                        <ul class="social-icons clearfix">
                            @foreach(\App\Models\Config::socialRules() as $key => $value)
                                @if($metaConfig = $socialConfig->get_meta($key))
                                <li><a target="_blank" href="{{$metaConfig->value}}"><i class="fa fa-{{$key}}"></i></a></li>
                                @endif
                            @endforeach
                        </ul>
                    </section>
                </div>
                <div class="col-md-4 col-sm-6">
                    <section class="widget address-widget clearfix">
                        <h4 class="title">@lang('app.rapid_link')</h4>
                        <ul>
                            <li><a href="{{route('home')}}">@lang('app.home')</a></li>
                            <li><a href="{{route('shop.index')}}">@lang('app.immobilier')</a></li>
                            <li><a href="{{route('shop.index')}}">@lang('app.business')</a></li>
                            <li><a href="{{route('services')}}">@lang('app.services')</a></li>
                            <li><a href="{{route('blog.all')}}">@lang('app.blog')</a></li>
                            <li><a href="{{route('contact')}}">@lang('app.contact')</a></li>
                            @if(Auth::check())
                            <li><a href="{{route('profile')}}">@lang('app.account')</a></li>
                            @endif
                        </ul>
                    </section>
                </div>
                <div class="col-md-4 col-sm-6">
                    <section class="widget address-widget clearfix">
                        <h4 class="title"></h4>
                        <ul>
                            <li><a href="{{route('terms')}}">@lang('app.terms')</a></li>
                            <li><a href="{{route('confidentialities')}}">@lang('app.confidential')</a></li>
                            <li><a href="{{route('help')}}">@lang('app.user_guide')</a></li>
                            <li><a href="{{route('publicities')}}">@lang('app.pubs')</a></li>
                        </ul>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <div class="site-footer-bottom">
        <div class="container text-center">
            <div>
                <p>@lang('app.footer_description')</p>
                <p>{!!trans('app.copyright', ['year'=>date('Y'), 'app'=>trans('app.app_name')])!!}</p>
            </div>
        </div>
    </div>
</footer>
<a href="#top" id="scroll-top"><i class="fa fa-angle-up"></i></a>

@if(!request()->is('login'))
<script src="{{ asset('js/app.js') }}"></script>
@endif

<!-- javascript search-bar -->
<script src="{{asset('js/jquery-1.10.2.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--
-->
    
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
        $("#ex3").slider({
            formatter: function (value) {
                return 'Current value: ' + value;
            }
        });
        $("#ex4").slider({
            formatter: function (value) {
                return 'Current value: ' + value;
            }
        });
    });
</script>
<script>
$('.btn-select-apl').on('click', function(e){
    $('#modal-select-apl').modal('show');
    e.preventDefault();
});
</script>
    
    
@section('script')
@show

@yield('stripe')
@yield('braintree')
</body>
</html>
