<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin{{isset($title)?' - '.$title:''}} - {{app_name()}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

 <!-- CSRF Token -->
 <meta name="csrf-token" content="{{ csrf_token() }}">
  
@section('style')
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('lte/plugins/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Bootstrap FileUpload -->
  <link rel="stylesheet" href="{{asset('lte/plugins/bootstrap-fileupload/css/bootstrap-fileupload.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('lte/plugins/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('lte/plugins/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('lte/css/styles.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('lte/css/skins/_all-skins.min.css')}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset('lte/plugins/morris.js/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('lte/plugins/jvectormap/jquery-jvectormap-2.0.3.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{asset('lte/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('lte/plugins/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

@show
 
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

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
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> 
    </svg>
</div>
<div class="wrapper">

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
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

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
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
      @endif
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{Request::is('admin')?'active':''}}">
            <a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>
        <li class="{{Request::is('admin/page*')?'active':''}} treeview">
          <a href="#">
            <i class="fa fa-globe"></i> <span>@lang('app.admin.pages')</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a class="{{Request::is('admin/page')?'active':''}}" href="{{route('admin.page.create')}}"><i class="fa fa-plus"></i>@lang('app.admin.page.add')</a></li>
            <li><a class="{{Request::is('admin/pages')?'active':''}}" href="{{route('admin.page.list', ['type'=>'page'])}}"><i class="fa fa-globe"></i>@lang('app.admin.page.list')</a></li>
            <li><a class="{{Request::is('admin/pubs')?'active':''}}"  href="{{route('admin.page.list', ['type'=>'pub'])}}"><i class="fa fa-columns"></i>@lang('app.admin.pub.list')</a></li>
            <li><a class="{{Request::is('admin/page/order')?'active':''}}" href="{{route('admin.page.order')}}"><i class="fa fa-list"></i>@lang('app.admin.page.order')</a></li>
          </ul>
        </li>
        <li class="{{Request::is('admin/blog*')?'active':''}} treeview">
          <a href="#">
            <i class="fa fa-cubes"></i> <span>@lang('app.admin.blogs')</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a class="{{Request::is('admin/blog')?'active':''}}" href="{{route('admin.blog.create')}}"><i class="fa fa-plus"></i>@lang('app.admin.blog.add')</a></li>
            <li><a class="{{Request::is('admin/blogs')?'active':''}}" href="{{route('admin.blog.list')}}"><i class="fa fa-circle-o"></i>@lang('app.admin.blog.list')</a></li>
            <li><a class="{{Request::is('admin/blogs/published')?'active':''}}" href="{{route('admin.blog.list', ['filter'=>'published'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.blog.publish')</a></li>
            <li><a class="{{Request::is('admin/blogs/pinged')?'active':''}}" href="{{route('admin.blog.list', ['filter'=>'pinged'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.blog.ping')</a></li>
            <li><a class="{{Request::is('admin/blogs/archived')?'active':''}}" href="{{route('admin.blog.list', ['filter'=>'archived'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.blog.archive')</a></li>
            <li><a class="{{Request::is('admin/blogs/trashed')?'active':''}}" href="{{route('admin.blog.list', ['filter'=>'trashed'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.blog.trash')</a></li>
          </ul>
        </li>
        <li class="{{Request::is('admin/categories/blog')?'active':''}}">
          <a href="{{route('admin.category.list', ['type'=>'blog'])}}">
            <i class="fa fa-th"></i> <span>@lang('app.admin.categories')</span>
          </a>
        </li>
        <li class="header text-aqua">SHOP</li>
        <li class="{{Request::is('admin/user*')?'active':''}} treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Utilisateurs</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a class="{{Request::is('admin/users')?'active':''}}" href="{{route('admin.user.list')}}"><i class="fa fa-circle-o"></i>Tous</a></li>
            <li><a class="{{Request::is('admin/users/admin')?'active':''}}" href="{{route('admin.user.list', ['filter'=>'admin'])}}"><i class="fa fa-circle-o"></i> Admin</a></li>
            <li><a class="{{Request::is('admin/users/seller')?'active':''}}" href="{{route('admin.user.list', ['filter'=>'seller'])}}"><i class="fa fa-circle-o"></i> Vendeurs</a></li>
            <li><a class="{{Request::is('admin/users/afa')?'active':''}}" href="{{route('admin.user.list', ['filter'=>'afa'])}}"><i class="fa fa-circle-o"></i> AFA</a></li>
            <li><a class="{{Request::is('admin/users/apl')?'active':''}}" href="{{route('admin.user.list', ['filter'=>'apl'])}}"><i class="fa fa-circle-o"></i> APL</a></li>
            <li><a class="{{Request::is('admin/users/member')?'active':''}}" href="{{route('admin.user.list', ['filter'=>'member'])}}"><i class="fa fa-circle-o"></i>Membres</a></li>
          </ul>
        </li>
        <li class="{{Request::is('admin/product*')?'active':''}} treeview">
          <a href="#">
            <i class="fa fa-shopping-cart"></i> <span>Produits</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a class="{{Request::is('admin/products')?'active':''}}" href="{{route('admin.product.list')}}"><i class="fa fa-circle-o"></i>@lang('app.admin.product.list')</a></li>
            <li><a class="{{Request::is('admin/products/pinged')?'active':''}}" href="{{route('admin.product.list', ['filter'=>'pinged'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.product.ping')</a></li>
            <li><a class="{{Request::is('admin/products/published')?'active':''}}" href="{{route('admin.product.list', ['filter'=>'published'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.product.publish')</a></li>
            <li><a class="{{Request::is('admin/products/ordered')?'active':''}}" href="{{route('admin.product.list', ['filter'=>'ordered'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.product.ordered')</a></li>
            <li><a class="{{Request::is('admin/products/paid')?'active':''}}" href="{{route('admin.product.list', ['filter'=>'paid'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.product.paid')</a></li>
            <li><a class="{{Request::is('admin/products/archived')?'active':''}}" href="{{route('admin.product.list', ['filter'=>'archived'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.product.archive')</a></li>
          </ul>
        </li>
        <li class="{{Request::is('admin/categories/product')?'active':''}}">
          <a href="{{route('admin.category.list', ['type'=>'product'])}}">
            <i class="fa fa-th"></i> <span>@lang('app.admin.categories')</span>
          </a>
        </li>
        <li class="{{Request::is('admin/order*')?'active':''}} treeview">
          <a href="#">
            <i class="fa fa-shopping-bag"></i> <span>@lang('app.admin.orders')</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a class="{{Request::is('admin/orders')?'active':''}}" href="{{route('admin.order.list')}}"><i class="fa fa-circle-o"></i>@lang('app.admin.order.list')</a></li>
            <li><a class="{{Request::is('admin/orders/pinged')?'active':''}}" href="{{route('admin.order.list', ['filter'=>'pinged'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.order.pinged')</a></li>
            <li><a class="{{Request::is('admin/orders/ordered')?'active':''}}" href="{{route('admin.order.list', ['filter'=>'ordered'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.order.ordered')</a></li>
            <li><a class="{{Request::is('admin/orders/afa-not-received')?'active':''}}" href="{{route('admin.order.list', ['filter'=>'afa-not-received'])}}"><i class="fa fa-circle-o"></i>@lang('admin.commissions.not-received')</a></li>
            <li><a class="{{Request::is('admin/orders/afa-received')?'active':''}}" href="{{route('admin.order.list', ['filter'=>'afa-received'])}}"><i class="fa fa-circle-o"></i>@lang('admin.commissions.received')</a></li>
            <li><a class="{{Request::is('admin/orders/apl-not-paid')?'active':''}}" href="{{route('admin.order.list', ['filter'=>'apl-not-paid'])}}"><i class="fa fa-circle-o"></i>@lang('admin.commissions.not-paid')</a></li>
            <li><a class="{{Request::is('admin/orders/apl-paid')?'active':''}}" href="{{route('admin.order.list', ['filter'=>'apl-paid'])}}"><i class="fa fa-circle-o"></i>@lang('admin.commissions.paid')</a></li>
            <li><a class="{{Request::is('admin/orders/paid')?'active':''}}" href="{{route('admin.order.list', ['filter'=>'paid'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.order.paid')</a></li>
            <li><a class="{{Request::is('admin/orders/cancelled')?'active':''}}" href="{{route('admin.order.list', ['filter'=>'cancelled'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.order.cancelled')</a></li>
          </ul>
        </li>
        <li class="header">LOCALISATIONS</li>
        <li class="{{Request::is('admin/postalcode*')?'active':''}}">
          <a href="{{route('admin.postalcode.list')}}">
            <i class="fa fa-map-marker"></i> <span>@lang('app.admin.postalcodes')</span>
          </a>
        </li>
        <li class="{{Request::is('admin/state*')?'active':''}}">
          <a href="{{route('admin.state.list')}}">
            <i class="fa fa-map-signs"></i> <span>@lang('app.admin.states')</span>
          </a>
        </li>
        <li class="header">SYSTEMS</li>
        <li class="{{Request::is('admin/badword*')?'active':''}}">
          <a href="{{route('admin.badword.list')}}">
            <i class="fa fa-leaf"></i> <span>@lang('app.admin.badwords')</span>
          </a>
        </li>
        <li class="{{Request::is('admin/plan*')?'active':''}}">
          <a href="{{route('admin.plan.list')}}">
            <i class="fa fa-bank"></i> <span>@lang('app.admin.plans')</span>
          </a>
        </li>
        <li class="header text-red">CONFIGS</li>
        <li class="{{Request::is('admin/config/site')?'active':''}}">
          <a href="{{route('config.site')}}">
            <i class="fa fa-desktop text-aqua"></i> <span>@lang('app.config.site')</span>
          </a>
        <li class="{{Request::is('admin/config/login')?'active':''}}">
          <a href="{{route('config.login')}}">
            <i class="fa fa-lock text-aqua"></i> <span>@lang('app.config.login')</span>
          </a>
        </li>
        <li class="{{Request::is('admin/config/social')?'active':''}}">
          <a href="{{route('config.social')}}">
            <i class="fa fa-snowflake-o text-aqua"></i> <span>@lang('app.config.social')</span>
          </a>
        </li>
        <li class="{{Request::is('admin/config/payment')?'active':''}}">
          <a href="{{route('config.payment')}}">
            <i class="fa fa-credit-card text-aqua"></i> <span>@lang('app.config.payment')</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{isset($title)?$title:app_name()}}
        <small>{{isset($subtitle)?$subtitle:''}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-home"></i> @lang("app.home")</a></li>
        @if(isset($breadcrumbs))
            <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> @lang("app.dashboard")</a></li>
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
        @else
            <li class="active">@lang("app.dashboard")</li>
        @endif
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    @include('includes.alerts')
    @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    {!!trans('app.copyright', ['year'=>date('Y'), 'app'=>trans('app.app_name')])!!}
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@section('script')
<!-- Application NPN --> 
<script src="{{asset('js/app.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('lte/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap FileUpload 3.3.7 -->
<script src="{{asset('lte/plugins/bootstrap-fileupload/js/bootstrap-fileupload.js')}}"></script>
<!-- Morris.js charts -->
<script src="{{asset('lte/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('lte/plugins/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('lte/plugins/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('lte/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js')}}"></script>
<script src="{{asset('lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('lte/plugins/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('lte/plugins/moment/min/moment.min.js')}}"></script>
<script src="{{asset('lte/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('lte/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('lte/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('lte/plugins/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('lte/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('lte/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('lte/js/demo.js')}}"></script>
<!-- Script -->
<script src="{{asset('lte/js/script.js')}}"></script>
@show
</body>
</html>
