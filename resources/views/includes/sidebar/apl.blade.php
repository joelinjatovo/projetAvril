<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="{{Request::is('admin')?'active':''}}">
        <a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> <span>@lang('app.dashboard')</span></a>
    </li>
    <li class="header">SYSTEMS</li>
    <li class="{{Request::is('admin/mails*')?'active':''}}">
      <a href="{{route('admin.mail.list', ['type'=>'inbox'])}}">
        <i class="fa fa-envelope"></i> <span>@lang('app.admin.mails')</span>
        <div class="notify" style="margin-right: 10px;"> <span class="heartbit"></span> <span class="point"></span> </div>
      </a>
    </li>
  </ul>
</section>