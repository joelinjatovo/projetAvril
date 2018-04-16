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

    <title>{{ config('app.name', 'IEA') }} - Admin - @yield('title')</title>
    
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('administrator/assets/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('administrator/assets/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('administrator/assets/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('administrator/assets/ico/apple-touch-icon-57-precomposed.png')}}">

    
    <!-- Le styles -->
    <link href="{{asset('administrator/css/lib/bootstrap.css')}}" rel="stylesheet" type="text/css" >
    <link href="{{asset('administrator/css/lib/bootstrap-responsive.css')}}" rel="stylesheet" type="text/css" >
    <link href="{{asset('administrator/css/boo-extension.css')}}" rel="stylesheet" type="text/css" >
    <link href="{{asset('administrator/css/boo.css')}}" rel="stylesheet" type="text/css" >
    <link href="{{asset('administrator/css/style.css')}}" rel="stylesheet" type="text/css" >
    <link href="{{asset('administrator/css/boo-coloring.css')}}" rel="stylesheet" type="text/css" >
    <link href="{{asset('administrator/css/boo-utility.css')}}" rel="stylesheet" type="text/css" >
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" >
    
    <!-- Le Script -->
    <script src="{{asset('administrator/amcharts/amcharts.js')}}"></script>
    <script src="{{asset('administrator/amcharts/xy.js')}}"></script>
    <script src="{{asset('administrator/amcharts/funnel.js')}}"></script>
    <script src="{{asset('administrator/amcharts/pie.js')}}"></script>
    <script src="{{asset('administrator/amcharts/serial.js')}}"></script>
    <script src="{{asset('administrator/amcharts/graphe.js')}}"></script>
    <script src="{{asset('administrator/amcharts/gantt.js')}}"></script>
    <script src="{{asset('administrator/amcharts/gauge.js')}}"></script>
    <script src="{{asset('administrator/amcharts/radar.js')}}"></script>

</head>
<body class="sidebar-left ">
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
                          <a class="brand" href="#">
                              <img src="{{asset('administrator/img/logo.png')}}" width="100" height="50">
                          </a>
                          <div class="search-global">
                              <input id="globalSearch" class="search search-query input-medium" type="search">
                              <a class="search-button" href="#"><i class="fontello-icon-search-5"></i></a>
                          </div>
                          <div class="nav-collapse collapse">
                              <ul class="nav user-menu visible-desktop">
                                  <li>
                                      <a class="btn-glyph fontello-icon-edit tip-bc" href="#" title="Messages"><span class="badge badge-important">8</span></a>
                                  </li>
                                  <li>
                                      <a class="btn-glyph fontello-icon-mail-1 tip-bc" href="#" title="Emails"></a>
                                  </li>
                                  <li>
                                      <a class="btn-glyph fontello-icon-lifebuoy tip-bc" href="#" title="Support"><span class="badge badge-important">4</span></a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
        <!-- // navbar -->
        
        <div class="header-drawer">
            <div class="mobile-nav text-center visible-phone"> <a href="javascript:void(0);" class="mobile-btn" data-toggle="collapse" data-target=".sidebar"><i class="aweso-icon-chevron-down"></i> @lang("Menu")</a> </div>
            <!-- // Resposive navigation -->
            <div class="breadcrumbs-nav hidden-phone">
                <ul id="breadcrumbs" class="breadcrumb">
                    <li><a href="javascript:void(0);"><i class="fontello-icon-home f12"></i> @lang("Dashboard")</a> <span class="divider">/</span></li>
                    <li class="active"> @lang("Profil administrateur") </li>
                </ul>
            </div>
            <!-- // breadcrumbs -->
        </div>
        <!-- // drawer -->
    </div>
    <!-- // header -->
</div>
<!-- // header-container -->
    
<div id="main-container">
    <div id="main-sidebar" class="sidebar sidebar-inverse">
          @if(Auth::check())
          <div class="sidebar-item">
              <div class="media profile">
                  <div class="media-thumb media-left thumb-bordereb">
                      <a class="img-shadow" href="">
                          <img class="thumb" src="{{asset('administrator/img/administrateur-1520608223.jpeg')}}">
                      </a>
                  </div>
                  <div class="media-body">
                      <h5 class="media-heading">{{Auth::user()->name}}</h5>
                      <p class="data">Dernière modif : </p>
                  </div>
              </div>
          </div>
          @endif
          <ul id="mainSideMenu" class="nav nav-list nav-side">
            <li class="accordion-group">
                <div class="accordion-heading">
                    <a href="" data-parent="" class="accordion-toggle"><i class="fontello-icon-user-4"></i> Mon profil</a>
                </div>
            </li>
              <li class="accordion-group">
                  <div class="accordion-heading">
                      <a href="" data-parent="#mainSideMenu" class="accordion-toggle"><i class="fontello-icon-chart"></i> Statistiques</a>
                  </div>
              </li>
              <li class="accordion-group">
                  <div class="accordion-heading">
                      <a href="#accMembres" data-parent="#mainSideMenu"  data-toggle="collapse" class="accordion-toggle"><i class="fontello-icon-users-1"></i><i class="chevron fontello-icon-right-open-3"></i>Parties Prenantes</a>
                  </div>
                  <ul class="accordion-content nav nav-list collapse" id="accMembres">
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
                      <a href="#accRéglages" data-parent="#mainSideMenu"  data-toggle="collapse" class="accordion-toggle">
                        <i class="fontello-icon-tools"></i>
                        <i class="chevron fontello-icon-right-open-3"></i>@lang('app.configs')
                      </a>
                  </div>
                  <ul class="accordion-content nav nav-list collapse" id="accRéglages">
                    <li>
                        <a href=""> <i class="fontello-icon-right-dir"></i>@lang('app.config.site')</a>
                    </li>
                    <li>
                        <a href=""> <i class="fontello-icon-right-dir"></i>@lang('app.config.social')</a>
                    </li>
                      <li>
                          <a href=""> <i class="fontello-icon-right-dir"></i>@lang('app.config.card')</a>
                      </li>
                      <li>
                        <a href=""> <i class="fontello-icon-right-dir"></i>@lang('app.config.page')</a>
                      </li>
                  </ul>
              </li>
              <li class="accordion-group">
                  <div class="accordion-heading">
                      <a href="" data-parent="#mainSideMenu"  class="accordion-toggle"><i class="fontello-icon-credit-card"></i> Publicités</a>
                  </div>
              </li>
              <li class="accordion-group">
                  <div class="accordion-heading">
                      <a href="#accBlogs" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle">
                        <i class="fontello-icon-users-1"></i>
                        <i class="chevron fontello-icon-right-open-3"></i>@lang('app.admin.blogs')</a>
                  </div>
                  <ul class="accordion-content nav nav-list collapse" id="accBlogs">
                      <li><a href="{{route('admin.blog.list')}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.blog.list')</a></li>
                      <li><a href="{{route('admin.blog.create')}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.blog.add')</a></li>
                       <li><a href="{{route('admin.blog.list', ['filter'=>'archive'])}}"><i class="fontello-icon-right-dir"></i>@lang('app.admin.blog.archive')</a></li>
                  </ul>
              </li>
              <li class="accordion-group">
                  <div class="accordion-heading">
                      <a href="" data-parent="#mainSideMenu"  class="accordion-toggle"><i class="fontello-icon-basket-1"></i> Gestion produits en vente</a>
                  </div>
              </li>
              <li class="accordion-group">
                  <div class="accordion-heading">
                      <a href="" data-parent="#mainSideMenu"  class="accordion-toggle"><i class="fontello-icon-basket-1"></i> Gestion produits vendus</a>
                  </div>
              </li>

              <li class="accordion-group">
                  <div class="accordion-heading">
                      <a href="" data-parent="#mainSideMenu"  class="accordion-toggle"><i class="fontello-icon-mail-1"></i> Gestion des messages préenregistrés</a>
                  </div>
              </li>
              <li class="accordion-group">
                  <div class="accordion-heading">
                      <a href="" data-parent="#mainSideMenu"  class="accordion-toggle"><i class="fontello-icon-mail-alt"></i> Gestion des emails préenregistrés</a>
                  </div>
              </li>


              <li class="accordion-group">
                  <div class="accordion-heading">
                      <a href="" data-parent="#mainSideMenu"  class="accordion-toggle"><i class="fontello-icon-credit-card"></i> Factures</a>
                  </div>
              </li>
              <li class="accordion-group">
                  <div class="accordion-heading">
                      <a href="" data-parent="#mainSideMenu" class="accordion-toggle"><i class="fontello-icon-mail-4"></i> Messages</a>
                  </div>
              </li>
              <li class="accordion-group">
                  <div class="accordion-heading">
                      <a href="gestionDesPagesInformations.html" data-parent="#mainSideMenu" class="accordion-toggle"><i class="fontello-icon-edit"></i> Gestion des pages d'informations</a>
                  </div>
              </li>
              <li class="accordion-group">
                  <div class="accordion-heading">
                      <a href="#" data-parent="#mainSideMenu" class="accordion-toggle"><i class="fontello-icon-left-1"></i>Se deconnecter</a>
                  </div>
              </li>
          </ul>
          <div class="sidebar-item"></div>
      </div>
    <!-- // sidebar -->
</div>
<!-- // main-container -->

@yield('content')
    
<footer id="footer-fix">
    <div id="footer-sidebar" class="footer-sidebar">
        <div class="navbar">
            <div class="btn-toolbar"><a class="btn btn-glyph btn-link" href="javascript:void(0);"><i class="fontello-icon-up-open-1"></i></a></div>
        </div>
    </div>
    <!-- // footer sidebar -->

    <div id="footer-content" class="footer-content">
        <div class="navbar navbar-inverse">
            <div class="navbar-inner">
                <ul class="nav pull-left">
                    <li class="divider-vertical hidden-phone"></li>
                    <li><a id="btnToggleSidebar" class="btn-glyph fontello-icon-resize-full-2 tip hidden-phone" href="javascript:void(0);" title="show hide sidebar"></a></li>
                    <li class="divider-vertical hidden-phone"></li>
                    <li><a id="btnChangeSidebar" class="btn-glyph fontello-icon-login tip hidden-phone" href="javascript:void(0);" title="change sidebar position"></a></li>
                    <li class="divider-vertical"></li>
                    <li><a id="btnChangeSidebarColor" class="btn-glyph fontello-icon-palette tip" href="javascript:void(0);" title="change sidebar color"></a></li>
                    <li class="divider-vertical"></li>
                    <li><a class="btn-glyph fontello-icon-cw" href="javascript:void(0);"></a></li>
                    <li class="divider-vertical"></li>
                    <li><a class="fontello-icon-home-3" href="dashboard-one.html"></a></li>
                    <li class="divider-vertical"></li>
                </ul>
                <ul class="nav pull-right">
                    <li class="divider-vertical"></li>
                    <li><a class="btn-glyph fontello-icon-help-2 tip" href="javascript:void(0);" title="help to page"></a></li>
                    <li class="divider-vertical"></li>
                    <li><a class="btn-glyph fontello-icon-cog-4 tip" href="javascript:void(0);" title="settings app"></a></li>
                    <li class="divider-vertical"></li>
                    <li>
                        <a id="btnLogout" class="btn-glyph fontello-icon-logout-1 tip" title="logout" href="http://localhost/iea/admin/logout"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        </a>

                        <form id="logout-form" action="http://localhost/iea/admin/logout" method="POST" style="display: none;">
                            <input type="hidden" name="_token" value="XekBc13dhl6LPueja3yqXDEHFZnvUbcSAGf36UEz">
                        </form>
                    </li>
                    <li class="divider-vertical"></li>
                    <li><a id="btnScrollup" class="scrollup btn-glyph fontello-icon-up-open-1" href="javascript:void(0);"><span class="hidden-phone">Scroll</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- // footer content -->
    
</footer>
<!-- // footer-fix  -->
    
    <!-- Placed at the end of the document so the pages load faster -->
<script src="{{asset('administrator/js/lib/jquery.js')}}"></script>
<script src="{{asset('administrator/js/lib/jquery-ui.js')}}"></script>
<script src="{{asset('administrator/js/lib/jquery.cookie.js')}}"></script>
<script src="{{asset('administrator/js/lib/jquery.date.js')}}"></script>
<script src="{{asset('administrator/js/lib/jquery.mousewheel.js')}}"></script>
<script src="{{asset('administrator/js/lib/jquery.load-image.min.js')}}"></script>
<script src="{{asset('administrator/js/lib/bootstrap/bootstrap.js')}}"></script>

<!-- Plugins Bootstrap -->
<script src="{{asset('administrator/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.min.js')}}"></script>
<script src="{{asset('administrator/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js')}}"></script>
<script src="{{asset('administrator/plugins/bootstrap-fuelux/all-fuelux.min.js')}}"></script>
<script src="{{asset('administrator/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('administrator/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js')}}"></script>
<script src="{{asset('administrator/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js')}}"></script>
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
<script src="{{asset('administrator/plugins/pl-visualization/easy-pie-chart/jquery.easy-pie-chart.js')}}"></script>
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
<!-- Only This Demo Page -->
<script src="{{asset('administrator/js/demo/demo-jquery.dataTables.js')}}"></script>

<!-- Only This Demo Page -->

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA48VeOmkB_L-TWKjgCknG92lDw21mOLvo&callback=myMap"></script>


<script type="text/javascript">
$(document).ready(function () {
     /* initiate plugin jPage */
     $("ul.holder").jPages({
             containerID: "gallery",
             perPage: 12,
             previous: "previous",
             next: "next",
             callback: function (pages, items) {
                     $("#legend2").html(items.range.start + " - " + items.range.end + " of " + items.count);
             }
     });

     /* on select change */
     $("#showItem").change(function () {
             var newPerPage = parseInt($(this).val());
             $("ul.holder").jPages("destroy").jPages({
                     containerID: "gallery",
                     perPage: newPerPage
             });
     });

     $('#gallery .nailthumb-container.show-loading').nailthumb({
             titleWhen: 'hover',
             animationTime: 3000,
             replaceAnimation: 'fade',
             imageFromWrappingLink: true,
             onStart: function (container) {
                     container.showLoading({
                             'overlayWidth': 30, //null
                             'overlayHeight': 30 //null
                     });
             },
             onFinish: function (container) {
                     container.hideLoading();
             }
     });

     $("#gallery a.edit").click(function () {
             $("#previewImage").html($("<img>").attr("src", this.href));
             return false;

     });

     // Start slideshow button:
     $('#start-slideshow').button().click(function () {
             var options = $(this).data(),
                     modal = $(options.target),
                     data = modal.data('modal');
             if(data) {
                     $.extend(data.options, options);
             }
             else {
                     options = $.extend(modal.data(), options);
             }
             modal.find('.modal-slideshow').find('i')
                     .removeClass('fontello-icon-play')
                     .addClass('fontello-icon-pause');
             modal.modal(options);
     });

     // Toggle fullscreen button:
     $('#toggle-fullscreen').button().click(function () {
             var button = $(this),
                     root = document.documentElement;
             if(!button.hasClass('active')) {
                     $('#modal-gallery').addClass('modal-fullscreen');
                     if(root.webkitRequestFullScreen) {
                             root.webkitRequestFullScreen(
                             window.Element.ALLOW_KEYBOARD_INPUT);
                     }
                     else if(root.mozRequestFullScreen) {
                             root.mozRequestFullScreen();
                     }
             }
             else {
                     $('#modal-gallery').removeClass('modal-fullscreen');
                     (document.webkitCancelFullScreen || document.mozCancelFullScreen || $.noop).apply(document);
             }
     });

     // Only demo form Tag
     var fileTagData = [{
             id: "Storm",
             text: "Storm"
     }, {
             id: "Scenic",
             text: "Scenic"
     }, {
             id: "Lakes",
             text: "Lakes"
     }, {
             id: "Rivers",
             text: "Rivers"
     }, {
             id: "Forest",
             text: "Forest"
     }, {
             id: "Flowers",
             text: "Flowers"
     }]
     $("#fileTag").select2({
             tags: fileTagData,
             createSearchChoice: function (term, data) {
                     if($(data).filter(function () {
                             return this.text.localeCompare(term) === 0;
                     }).length === 0) {
                             return {
                                     id: term,
                                     text: term
                             };
                     }
             },
             width: "100%",
             multiple: true,
             placeholder: "select or enter tag",
             tokenSeparators: [",", " "]
     });
});
</script>


<!-- Only This Demo Page -->
<script src="{{asset('administrator/js/demo/demo-wisyhtml5.js')}}"></script>
<script src="{{asset('administrator/js/demo/d3.js')}}"></script>
<script>
$(function() {
     $.configureBoxes({selectOnSubmit: false});
     $.configureBoxes({
         box1View: 'box3View',
         box1Storage: 'box3Storage',
         box1Filter: 'box3Filter',
         box1Clear: 'box3Clear',
         box1Counter: 'box3Counter',
         box2View: 'box4View',
         box2Storage: 'box4Storage',
         box2Filter: 'box4Filter',
         box2Clear: 'box4Clear',
         box2Counter: 'box4Counter',
         to1: 'to3',
         to2: 'to4',
         allTo1: 'allTo3',
         allTo2: 'allTo4',
         selectOnSubmit: false
     });
     $.configureBoxes({
         box1View: 'box5View',
         box1Storage: 'box5Storage',
         box1Filter: 'box5Filter',
         box1Clear: 'box5Clear',
         box1Counter: 'box5Counter',
         box2View: 'box6View',
         box2Storage: 'box6Storage',
         box2Filter: 'box6Filter',
         box2Clear: 'box6Clear',
         box2Counter: 'box6Counter',
         to1: 'to5',
         to2: 'to6',
         allTo1: 'allTo5',
         allTo2: 'allTo6',
         selectOnSubmit: false
     });/**/
     });
</script>

</body>
</html>
