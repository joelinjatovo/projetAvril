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
<link href="{{asset('css/bootstrap-slider.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">

<!-- Plugins -->
<link rel="stylesheet" href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/fontello/css/fontello.css')}}">
<link rel="stylesheet" href="{{asset('plugins/icon-7-stroke/css/pe-icon-7-stroke.css')}}">
<link rel="stylesheet" href="{{asset('plugins/icon-7-stroke/css/helper.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('plugins/slick/slick.css')}}">
<link rel="stylesheet" href="{{asset('plugins/slick-nav/slicknav.css')}}">
    
<!-- sylesheet css search-bar -->
<link rel="stylesheet" href="{{asset('css/icheck.min_all.css')}}">
<link rel="stylesheet" href="{{asset('css/price-range.css')}}">
<link href="{{asset('css/multirange.css')}}" rel="stylesheet">
<link href="{{asset('plugins/wow/animate.css')}}" rel="stylesheet">


<!-- Styles -->
<link href="{{asset('css/theme.css')}}" rel="stylesheet">
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

@php $socialConfig = \App\Models\Config::social(); @endphp
<header class="main-header">
    <!-- Logo -->
    <a href="{{route('home')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">{{config("app.short_name")}}</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">{{app_name()}}</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      @if(auth()->check())
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <?php
            $mailQuery = auth()->user()->mails()->wherePivot('read', 0);
            $unreadMail = $mailQuery->count();
            $mails = $mailQuery->take(10)->get();
          ?>
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">{{$unreadMail}}</span>
              <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have {{$unreadMail}} messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                 @foreach($mails as $mail)
                  <li><!-- start message -->
                    <a href="{{route('admin.mail.index', $mail)}}">
                      <div class="pull-left">
                        <img src="{{$mail->sender->imageUrl()}}" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        {{$mail->subject}}
                        <small><i class="fa fa-clock-o"></i> {{$mail->created_at->diffForHumans()}}</small>
                      </h4>
                      <p>{{$mail->content}}</p>
                    </a>
                  </li>
                  <!-- end message -->
                  @endforeach
                </ul>
              </li>
              <li class="footer"><a href="{{route('admin.mail.list',['filter'=>'inbox'])}}">See All Messages</a></li>
            </ul>
          </li>
          
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning" id="notifications-count">{{auth()->user()->unreadNotifications()->count()}}</span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu" id="notifications">
                  @foreach (auth()->user()->unreadNotifications as $notification)
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  @endforeach
                </ul>
              </li>
              <li class="footer"><a href="#">View all notifications</a></li>
            </ul>
          </li>
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{auth()->user()->imageUrl()}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{auth()->user()->fullname()}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{Auth::user()->imageUrl()}}" class="img-circle" alt="User Image">

                <p>
                  {{auth()->user()->fullname()}} - {{auth()->user()->role}}
                  <small>{{auth()->user()->created_at->diffForHumans()}}</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{route('profile')}}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{route('logout')}}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
        </ul>
      </div>
      @endif
    </nav>
</header>
    
<header id="head">
    <div class="container top-menu">
        <div class="row">
            <div class="col-md-3" >
                <figure id="site-logo" class="logo">
                    <a href="{{route('home')}}">
                        <img src="{{asset('images/logo.png')}}" alt="Logo">
                    </a>
                </figure>
            </div>
            <div class="col-md-9 col-sm-12">
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
                    </ul>
                </nav>
            </div>
        </div>
    </div>
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
                            <li><a href="{{route('terms')}}">@lang('app.terms&conditions')</a></li>
                            <li><a href="{{route('confidentialities')}}">@lang('app.confidentials')</a></li>
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

<script src="{{ asset('js/app.js') }}"></script>
    
<script src="{{asset('plugins/slick-nav/jquery.slicknav.min.js')}}"></script>
<script src="{{asset('plugins/slick/slick.min.js')}}"></script>
<script src="{{asset('js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('js/bootstrap-hover-dropdown.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/wow.js')}}"></script>
<script src="{{asset('js/icheck.min.js')}}"></script>
<script src="{{asset('js/price-range.js')}}"></script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('plugins/forms/jquery.form.min.js')}}"></script>
<script src="{{asset('plugins/forms/jquery.validate.min.js')}}"></script>
<script src="{{asset('plugins/modernizr/modernizr.custom.js')}}"></script>
<script src="{{asset('plugins/wow/wow.min.js')}}"></script>
<script src="{{asset('plugins/zoom/zoom.js')}}"></script>
<script src="{{asset('plugins/mixitup/mixitup.min.js')}}"></script>
    
<script src="{{asset('js/multirange.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('js/theme.js')}}"></script>
<script src="{{asset('js/head.js')}}"></script>

<script>
$('.btn-select-apl').on('click', function(e){
    $('#modal-select-apl').modal('show');
    e.preventDefault();
});
</script>
    
@yield('script')
@yield('stripe')
@yield('braintree')
</body>
</html>
