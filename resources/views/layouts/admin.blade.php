<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>Admin{{isset($title)?' - '.$title:''}} - {{ config('app.name', 'IEA') }}</title>

<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="{{asset('images/favicon.png')}}">

<!-- Le styles -->
<link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" >
<link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" type="text/css" >
<link href="{{asset('administrator/css/lib/bootstrap-responsive.css')}}" rel="stylesheet" type="text/css" >
    
<link href="{{asset('administrator/css/boo.css')}}" rel="stylesheet" type="text/css" >
<link href="{{asset('administrator/css/boo-extension.css')}}" rel="stylesheet" type="text/css" >
<link href="{{asset('administrator/css/boo-coloring.css')}}" rel="stylesheet" type="text/css" >
<link href="{{asset('administrator/css/boo-utility.css')}}" rel="stylesheet" type="text/css" >
    
<link href="{{asset('administrator/css/style.css')}}" rel="stylesheet" type="text/css" >
<style type="text/css">
    ul{
        margin: 0;
    }    
</style>
</head>
<body class="sidebar-left ">
<!-- // header-container -->
    
<div id="main-container">
    <div id="header-container">
        <div id="header">
            <div class="navbar navbar-inverse navbar-fixed-top">
              <div class="navbar-inner">
                  <div class="container-fluid">
                      <!-- <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </button> -->
                      <a class="brand" href="{{route('home')}}">
                          <img src="{{asset('administrator/img/logo.png')}}" width="100" height="50">
                      </a>
                      <div class="search-global">
                          <input id="globalSearch" class="search search-query input-medium" type="search">
                          <a class="search-button" href="#"><i class="fontello-icon-search-5"></i></a>
                      </div>
                      @if(Auth::check())
                      <div class="nav-collapse collapse">
                          <ul class="nav user-menu visible-desktop">
                              <li class="dropdown">
                                  <a class="dropdown-toogle btn-glyph fontello-icon-edit tip-bc" href="#" data-toggle="dropdown" title="Messages"><span class="badge badge-important">8</span></a>
                                  <ul>
                                      @foreach(Auth::user()->notifications as $notification)
                                        <li>{{$notification->type}}</li>
                                      @endforeach
                                    <li class="divider"></li>
                                  </ul>
                              </li>
                              <li>
                                  <a class="btn-glyph fontello-icon-mail-1 tip-bc" href="#" title="Emails"></a>
                              </li>
                              <li>
                                  <a class="btn-glyph fontello-icon-lifebuoy tip-bc" href="#" title="Support"><span class="badge badge-important">4</span></a>
                              </li>
                          </ul>
                      </div>
                      @endif
                  </div>
              </div>
            </div>
            <!-- // navbar -->

            <div class="header-drawer">
                <div class="mobile-nav text-center visible-phone"> <a href="javascript:void(0);" class="mobile-btn" data-toggle="collapse" data-target=".sidebar"><i class="aweso-icon-chevron-down"></i> Menu</a> </div>
                <!-- // Resposive navigation -->
                <div class="breadcrumbs-nav hidden-phone">
                    <ul id="breadcrumbs" class="breadcrumb">
                        <li><a href="{{route('admin.dashboard')}}"><i class="fontello-icon-home f12"></i> @lang("app.dashboard")</a></li>
                        @if(isset($breadcrumbs))
                            @if(!is_array($breadcrumbs))
                                <li class="active"> {{$breadcrumbs}}</li>
                            @else
                                @foreach($breadcrumbs as $breadcrumb)
                                    @if(isset($breadcrumb['active'])&&$breadcrumb['active'])
                                        <li class="active"> {{$breadcrumb['label']}}</li>
                                    @else
                                        <li><a href="{{$breadcrumb['route']}}"> {{$breadcrumb['label']}}</a></li>
                                    @endif
                                @endforeach
                            @endif
                        @endif
                    </ul>
                </div>
                <!-- // breadcrumbs -->
            </div>
            <!-- // drawer -->
        </div>
        <!-- // header -->
    </div>
    <!-- // header -->
    
    <div id="main-sidebar" class="sidebar sidebar-inverse">
          @if(Auth::check())
          <div class="sidebar-item" style="margin-top:10px;">
              <div class="media profile">
                  <div class="media-thumb media-left">
                      <a class="img-shadow" href="">
                          <img class="thumb" src="{{Auth::user()->imageUrl()}}" style="width:100%;">
                      </a>
                  </div>
                  <div class="media-body">
                      <h5 class="media-heading">{{Auth::user()->name}}</h5>
                      <p class="data">{{Auth::user()->created_at->diffForHumans()}}</p>
                  </div>
              </div>
          </div>
          @endif
          <ul id="mainSideMenu" class="nav nav-list nav-side accordion">
              <li class="accordion-group">
                <div class="accordion-heading">
                    <a href="{{route('profile')}}" data-parent="" class="accordion-toggle"><i class="fontello-icon-user-4"></i>@lang('app.profile')</a>
                </div>
              </li>
              <li class="accordion-group">
                  <div class="accordion-heading">
                      <a href="#accDashboard" data-parent="#mainSideMenu"  data-toggle="collapse" class="accordion-toggle {{\Request::is('admin/chart*')?'collapsed':''}}"><i class="fontello-icon-chart"></i><i class="chevron fontello-icon-right-open-3"></i>Statistiques</a>
                  </div>
                  <ul class="accordion-content nav nav-list collapse {{\Request::is('admin/chart*')?'in':''}}" id="accDashboard">
                      <li><a href="{{route('admin.chart', ['type'=>'product'])}}"> <i class="fontello-icon-right-dir"></i>@lang('app.products')</a></li>
                      <li><a href="{{route('admin.chart', ['type'=>'user'])}}"> <i class="fontello-icon-right-dir"></i>@lang('app.users')</a></li>
                      <li><a href="{{route('admin.chart', ['type'=>'member'])}}"> <i class="fontello-icon-right-dir"></i>@lang('app.members')</a></li>
                      <li><a href="{{route('admin.chart', ['type'=>'afa'])}}"> <i class="fontello-icon-right-dir"></i>@lang('app.afa')</a></li>
                      <li><a href="{{route('admin.chart', ['type'=>'apl'])}}"> <i class="fontello-icon-right-dir"></i>@lang('app.apl')</a></li>
                      <li><a href="{{route('admin.chart', ['type'=>'seller'])}}"> <i class="fontello-icon-right-dir"></i>@lang('app.seller')</a></li>
                      <li><a href="{{route('admin.chart', ['type'=>'cart'])}}"> <i class="fontello-icon-right-dir"></i>@lang('app.carts')</a></li>
                  </ul>
              </li>
              <li class="accordion-group">
                  <div class="accordion-heading">
                      <a href="#accMembres" data-parent="#mainSideMenu"  data-toggle="collapse" class="accordion-toggle {{\Request::is('admin/user*')?'collapsed':''}}"><i class="fontello-icon-users-1"></i><i class="chevron fontello-icon-right-open-3"></i>Parties Prenantes</a>
                  </div>
                  <ul class="accordion-content nav nav-list collapse {{\Request::is('admin/user*')?'in':''}}" id="accMembres">
                      <li><a href="{{route('admin.user.list')}}"> <i class="fontello-icon-right-dir"></i>Tous</a></li>
                      <li><a href="{{route('admin.user.list', ['filter'=>'admin'])}}"> <i class="fontello-icon-right-dir"></i>Admin</a></li>
                      <li><a href="{{route('admin.user.list', ['filter'=>'seller'])}}"> <i class="fontello-icon-right-dir"></i>Vendeurs</a></li>
                      <li><a href="{{route('admin.user.list', ['filter'=>'afa'])}}"> <i class="fontello-icon-right-dir"></i> AFA</a></li>
                      <li><a href="{{route('admin.user.list', ['filter'=>'apl'])}}"> <i class="fontello-icon-right-dir"></i> APL</a></li>
                      <li><a href="{{route('admin.user.list', ['filter'=>'member'])}}"> <i class="fontello-icon-right-dir"></i>Membres</a></li>
                  </ul>
              </li>
              <li class="accordion-group">
                  <div class="accordion-heading">
                      <a href="#accShop" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle {{\Request::is('admin/shop*')?'collapsed':''}}">
                        <i class="fa fa-shopping-cart"></i>
                        <i class="chevron fontello-icon-right-open-3"></i>@lang('app.shop')</a>
                  </div>
                  <ul class="accordion-content nav nav-list collapse {{\Request::is('admin/shop*')?'in':''}}" id="accShop">
                      <li><a href="{{route('admin.shop')}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.shop')</a></li>
                      <li><a href="{{route('admin.shop', ['filter'=>'pinged'])}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.shop.pinged')</a></li>
                      <li><a href="{{route('admin.shop', ['filter'=>'ordered'])}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.shop.ordered')</a></li>
                      <li><a href="{{route('admin.shop', ['filter'=>'apl-not-paid'])}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.shop.apl-not-paid')</a></li>
                      <li><a href="{{route('admin.shop', ['filter'=>'apl-paid'])}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.shop.apl-paid')</a></li>
                      <li><a href="{{route('admin.shop', ['filter'=>'afa-not-paid'])}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.shop.afa-not-paid')</a></li>
                      <li><a href="{{route('admin.shop', ['filter'=>'afa-paid'])}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.shop.afa-paid')</a></li>
                      <li><a href="{{route('admin.shop', ['filter'=>'paid'])}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.shop.paid')</a></li>
                  </ul>
              </li>
              <li class="accordion-group">
                  <div class="accordion-heading">
                      <a href="#accProducts" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle {{\Request::is('admin/product*')?'collapsed':''}}">
                        <i class="fontello-icon-users-1"></i>
                        <i class="chevron fontello-icon-right-open-3"></i>@lang('app.admin.products')</a>
                  </div>
                  <ul class="accordion-content nav nav-list collapse {{\Request::is('admin/product*')?'in':''}}" id="accProducts">
                      <li><a href="{{route('admin.product.list')}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.product.list')</a></li>
                      <li><a href="{{route('admin.product.list', ['filter'=>'published'])}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.product.publish')</a></li>
                      <li><a href="{{route('admin.product.list', ['filter'=>'paid'])}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.product.paid')</a></li>
                      <li><a href="{{route('admin.product.list', ['filter'=>'ordered'])}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.product.ordered')</a></li>
                      <li><a href="{{route('admin.product.list', ['filter'=>'pinged'])}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.product.ping')</a></li>
                      <li><a href="{{route('admin.product.list', ['filter'=>'archived'])}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.product.archive')</a></li>
                      <li><a href="{{route('admin.product.list', ['filter'=>'trashed'])}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.product.trash')</a></li>
                  </ul>
              </li>
              <li class="accordion-group">
                  <div class="accordion-heading">
                      <a href="#accBlogs" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle {{\Request::is('admin/blog*')?'collapsed':''}}">
                        <i class="fontello-icon-users-1"></i>
                        <i class="chevron fontello-icon-right-open-3"></i>@lang('app.admin.blogs')</a>
                  </div>
                  <ul class="accordion-content nav nav-list collapse {{\Request::is('admin/blog*')?'in':''}}" id="accBlogs">
                      <li><a href="{{route('admin.blog.create')}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.blog.add')</a></li>
                      <li><a href="{{route('admin.blog.list')}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.blog.list')</a></li>
                       <li><a href="{{route('admin.blog.list', ['filter'=>'published'])}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.blog.publish')</a></li>
                       <li><a href="{{route('admin.blog.list', ['filter'=>'pinged'])}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.blog.ping')</a></li>
                       <li><a href="{{route('admin.blog.list', ['filter'=>'archived'])}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.blog.archive')</a></li>
                       <li><a href="{{route('admin.blog.list', ['filter'=>'trashed'])}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.blog.trash')</a></li>
                  </ul>
              </li>
              <li class="accordion-group">
                  <div class="accordion-heading">
                      <a href="#accCategories" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle {{\Request::is('admin/category*')?'collapsed':''}}">
                        <i class="fontello-icon-users-1"></i>
                        <i class="chevron fontello-icon-right-open-3"></i>@lang('app.admin.categories')</a>
                  </div>
                  <ul class="accordion-content nav nav-list collapse {{\Request::is('admin/category*')?'in':''}}" id="accCategories">
                      <li><a href="{{route('admin.category.list')}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.category.list')</a></li>
                      <li><a href="{{route('admin.category.create')}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.category.add')</a></li>
                  </ul>
              </li>
              <li class="accordion-group">
                  <div class="accordion-heading">
                      <a href="#accPubs" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle {{\Request::is('admin/pub*')?'collapsed':''}}">
                        <i class="fontello-icon-users-1"></i>
                        <i class="chevron fontello-icon-right-open-3"></i>@lang('app.admin.pubs')</a>
                  </div>
                  <ul class="accordion-content nav nav-list collapse {{\Request::is('admin/pub*')?'in':''}}" id="accPubs">
                      <li><a href="{{route('admin.pub.list')}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.pub.list')</a></li>
                      <li><a href="{{route('admin.pub.create')}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.pub.add')</a></li>
                  </ul>
              </li>
              <li class="accordion-group">
                  <div class="accordion-heading">
                      <a href="#accPages" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle {{\Request::is('admin/*admin.page*')?'collapsed':''}}">
                        <i class="fa fa-book"></i>
                        <i class="chevron fontello-icon-right-open-3"></i> @lang('app.admin.pages')</a>
                  </div>
                  <ul class="accordion-content nav nav-list collapse {{\Request::is('admin/page*')?'in':''}}" id="accPages">
                      <li><a href="{{route('admin.page.create')}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.page.add')</a></li>
                      <li><a href="{{route('admin.page.list')}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.page.list')</a></li>
                  </ul>
              </li>
              <li class="accordion-group">
                  <div class="accordion-heading">
                      <a href="#accCarts" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle {{\Request::is('admin/cart*')?'collapsed':''}}">
                        <i class="fa fa-shopping-cart"></i>
                        <i class="chevron fontello-icon-right-open-3"></i> @lang('app.admin.carts')</a>
                  </div>
                  <ul class="accordion-content nav nav-list collapse {{\Request::is('admin/cart*')?'in':''}}" id="accCarts">
                      <li><a href="{{route('admin.cart.list')}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.cart.list')</a></li>
                      <li><a href="{{route('admin.cart.list', ['filter'=>'pinged'])}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.cart.pinged')</a></li>
                      <li><a href="{{route('admin.cart.list', ['filter'=>'ordered'])}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.cart.ordered')</a></li>
                      <li><a href="{{route('admin.cart.list', ['filter'=>'paid'])}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.cart.paid')</a></li>
                  </ul>
              </li>
              <li class="accordion-group">
                  <div class="accordion-heading">
                      <a href="#accMails" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle {{\Request::is('*mail*')?'collapsed':''}}">
                        <i class="fa fa-envelope"></i>
                        <i class="chevron fontello-icon-right-open-3"></i> @lang('app.admin.mail.list')</a>
                  </div>
                  <ul class="accordion-content nav nav-list collapse {{\Request::is('*mail*')?'in':''}}" id="accMails">
                      <li><a href="{{route('mail.list')}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.mail.list')</a></li>
                      <li><a href="{{route('mail.list',['filter'=>'inbox'])}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.mail.inbox')</a></li>
                      <li><a href="{{route('mail.list',['filter'=>'outbox'])}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.mail.outbox')</a></li>
                      <li><a href="{{route('mail.list',['filter'=>'draft'])}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.mail.draft')</a></li>
                      <li><a href="{{route('mail.list',['filter'=>'spam'])}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.mail.spam')</a></li>
                      <li><a href="{{route('mail.list',['filter'=>'model'])}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.mail.model')</a></li>
                  </ul>
              </li>
              <li class="accordion-group">
                  <div class="accordion-heading">
                      <a href="#accBadWords" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle {{\Request::is('admin/badword*')?'collapsed':''}}">
                        <i class="fa fa-envelope"></i>
                        <i class="chevron fontello-icon-right-open-3"></i> @lang('app.admin.badword.list')</a>
                  </div>
                  <ul class="accordion-content nav nav-list collapse {{\Request::is('admin/badword*')?'in':''}}" id="accBadWords">
                      <li><a href="{{route('admin.badword.list')}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.badword.list')</a></li>
                      <li><a href="{{route('admin.badword.create')}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.badword.create')</a></li>
                  </ul>
              </li>
              <li class="accordion-group">
                  <div class="accordion-heading">
                      <a href="#accPostalCode" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle {{\Request::is('admin/badword*')?'collapsed':''}}">
                        <i class="fa fa-envelope"></i>
                        <i class="chevron fontello-icon-right-open-3"></i> @lang('app.admin.postalcode.list')</a>
                  </div>
                  <ul class="accordion-content nav nav-list collapse {{\Request::is('admin/postalcode*')?'in':''}}" id="accPostalCode">
                      <li><a href="{{route('admin.postalcode.list')}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.postalcode.list')</a></li>
                      <li><a href="{{route('admin.postalcode.create')}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.postalcode.create')</a></li>
                  </ul>
              </li>
              <li class="accordion-group">
                  <div class="accordion-heading">
                      <a href="#accState" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle {{\Request::is('admin/state*')?'collapsed':''}}">
                        <i class="fa fa-envelope"></i>
                        <i class="chevron fontello-icon-right-open-3"></i> @lang('app.admin.state.list')</a>
                  </div>
                  <ul class="accordion-content nav nav-list collapse {{\Request::is('admin/state*')?'in':''}}" id="accState">
                      <li><a href="{{route('admin.state.list')}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.state.list')</a></li>
                      <li><a href="{{route('admin.state.create')}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.state.create')</a></li>
                  </ul>
              </li>
              <li class="accordion-group">
                  <div class="accordion-heading">
                      <a href="#accReglages" data-parent="#mainSideMenu"  data-toggle="collapse" class="accordion-toggle {{\Request::is('*config*')?'collapsed':''}}">
                        <i class="fontello-icon-tools"></i>
                        <i class="chevron fontello-icon-right-open-3"></i> @lang('app.configs')
                      </a>
                  </div>
                  <ul class="accordion-content nav nav-list collapse {{\Request::is('*config*')?'in':''}}" id="accReglages">
                    <li><a href="{{route('config.site')}}"> <i class="fontello-icon-right-dir"></i>@lang('app.config.site')</a></li>
                    <li><a href="{{route('config.login')}}"> <i class="fontello-icon-right-dir"></i>@lang('app.config.login')</a></li>
                    <li><a href="{{route('config.social')}}"> <i class="fontello-icon-right-dir"></i>@lang('app.config.social')</a></li>
                    <li><a href="{{route('config.payment')}}"> <i class="fontello-icon-right-dir"></i>@lang('app.config.payment')</a></li>
                  </ul>
              </li>
              <li class="accordion-group">
                  <div class="accordion-heading">
                      <a href="{{route('logout')}}" data-parent="#mainSideMenu" class="accordion-toggle"><i class="fontello-icon-left-1"></i> @lang('app.logout')</a>
                  </div>
              </li>
          </ul>
          <div class="sidebar-item"></div>
      </div>
    <!-- // sidebar -->

    @yield('content')
    <!-- // main content -->
</div>
<!-- // main-container -->
    
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('administrator/js/lib/jquery-ui.js')}}"></script>

    
<script src="{{asset('administrator/js/lib/jquery.cookie.js')}}"></script>
<script src="{{asset('administrator/js/lib/jquery.mousewheel.js')}}"></script>
<script src="{{asset('administrator/js/lib/jquery.load-image.min.js')}}"></script>

<!-- Plugins Bootstrap -->
<script src="{{asset('administrator/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.min.js')}}"></script>
<script src="{{asset('administrator/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js')}}"></script>
<script src="{{asset('administrator/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js')}}"></script>
<script src="{{asset('administrator/plugins/bootstrap-daterangepicker/js/bootstrap-daterangepicker.js')}}"></script>
<script src="{{asset('administrator/plugins/bootstrap-toggle-button/js/bootstrap-toggle-button.js')}}"></script>
<script src="{{asset('administrator/plugins/bootstrap-fileupload/js/bootstrap-fileupload.js')}}"></script>
<script src="{{asset('administrator/plugins/bootstrap-rowlink/js/bootstrap-rowlink.js')}}"></script>
<script src="{{asset('administrator/plugins/bootstrap-progressbar/js/bootstrap-progressbar.js')}}"></script>
<script src="{{asset('administrator/plugins/bootstrap-select/bootstrap-select.js')}}"></script>
<script src="{{asset('administrator/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js')}}"></script>
<script src="{{asset('administrator/plugins/bootstrap-bootbox/bootbox.min.js')}}"></script>
<script src="{{asset('administrator/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}"></script>
<script src="{{asset('administrator/plugins/bootstrap-modal/js/bootstrap-modal.js')}}"></script>
<script src="{{asset('administrator/plugins/bootstrap-wizard/js/bootstrap-wizard.min.js')}}"></script>
<script src="{{asset('administrator/plugins/bootstrap-wizard-2/js/bwizard-only.min.js')}}"></script>
<script src="{{asset('administrator/plugins/bootstrap-image-gallery/js/bootstrap-image-gallery.min.js')}}"></script>

<!-- Plugins Custom - Only example -->
<script src="{{asset('administrator/plugins/pl-extension/google-code-prettify/prettify.js')}}"></script>

<!-- Plugins Custom - System -->
<script src="{{asset('administrator/plugins/pl-system/nicescroll/jquery.nicescroll.min.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-system/xbreadcrumbs/xbreadcrumbs.js')}}"></script>

<!-- Plugins Custom - System info -->
<script src="{{asset('administrator/plugins/pl-system-info/qtip2/dist/jquery.qtip.min.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-system-info/gritter/js/jquery.gritter.min.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-system-info/notyfy/jquery.notyfy.js')}}"></script>

<!-- Plugins Custom - Content -->
<script src="{{asset('administrator/plugins/pl-content/list/js/list.min.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-content/list/plugins/list.paging.min.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-content/jpages/js/jPages.js')}}"></script>

<!-- Plugins Custom - Component -->
<script src="{{asset('administrator/plugins/pl-component/fullcalendar/fullcalendar.min.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-component/rangeslider/jqallrangesliders.min.js')}}"></script>

<!-- Plugins Custom - Form -->
<script src="{{asset('administrator/plugins/pl-form/uniform/jquery.uniform.min.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-form/select2/select2.min.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-form/counter/jquery.counter.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-form/elastic/jquery.elastic.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-form/inputmask/jquery.inputmask.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-form/inputmask/jquery.inputmask.extensions.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-form/validate/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-form/duallistbox/jquery.duallistbox.min.js')}}"></script>

<!-- Plugins Custom - Gallery -->
<script src="{{asset('administrator/plugins/pl-gallery/nailthumb/jquery.nailthumb.1.1.min.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-gallery/nailthumb/showLoading/js/jquery.showLoading.min.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-gallery/wookmark/jquery.imagesloaded.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-gallery/wookmark/jquery.wookmark.min.js')}}"></script>

<!-- Plugins Tables -->
<script src="{{asset('administrator/plugins/pl-table/datatables/media/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-table/datatables/plugin/jquery.dataTables.plugins.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-table/datatables/plugin/jquery.dataTables.columnFilter.js')}}"></script>

<!-- Plugins data visualization -->
<script src="{{asset('administrator/plugins/pl-visualization/sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-visualization/percentageloader/percentageloader.min.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-visualization/knob/knob.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-visualization/flot/jquery.flot.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-visualization/flot/jquery.flot.categories.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-visualization/flot/jquery.flot.grow.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-visualization/flot/jquery.flot.orderBars.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-visualization/flot/jquery.flot.pie.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-visualization/flot/jquery.flot.resize.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-visualization/flot/jquery.flot.selection.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-visualization/flot/jquery.flot.stack.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-visualization/flot/jquery.flot.stackpercent.js')}}"></script>
<script src="{{asset('administrator/plugins/pl-visualization/flot/jquery.flot.time.js')}}"></script>

<!-- main js -->
<script src="{{asset('administrator/js/core.js')}}"></script>
<script src="{{asset('administrator/js/application.js')}}"></script>

<script src="{{asset('administrator/js/demo/demo-jquery.dataTables.js')}}"></script>
<script src="{{asset('administrator/js/demo/demo-wisyhtml5.js')}}"></script>
    
@yield('script')

</body>
</html>
