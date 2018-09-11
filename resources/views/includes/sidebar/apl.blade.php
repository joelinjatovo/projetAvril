<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="{{Request::is('apl')?'active':''}}">
        <a href="{{url('apl')}}"><i class="fa fa-dashboard"></i> <span>@lang('app.dashboard')</span></a>
    </li>
    <li class="header text-aqua">SHOP</li>
    <li class="{{Request::is('apl/customers')?'active':''}}">
      <a href="{{route('apl.customers')}}">
        <i class="fa fa-users"></i> <span>@lang('apl.customers')</span>
      </a>
    </li>
    <li class="{{Request::is('apl/orders')?'active':''}}">
      <a href="{{route('apl.orders')}}">
        <i class="fa fa-shopping-basket"></i> <span>@lang('apl.orders')</span>
      </a>
    </li>
    <li class="{{Request::is('apl/sales')?'active':''}}">
      <a href="{{route('apl.sales')}}">
        <i class="fa fa-shopping-bag"></i> <span>@lang('apl.sales')</span>
      </a>
    </li>
    <li class="header">COMMANDES & COMMISSIONS MIO</li>
    <li class="{{Request::is('apl/commissions/not-received')?'active':''}}">
      <a href="{{route('apl.commissions', ['filter'=>'not-received'])}}">
        <i class="fa fa-shopping-basket"></i> <span>@lang('apl.commissions.not-received')</span>
      </a>
    </li>
    <li class="{{Request::is('apl/commissions/received')?'active':''}}">
      <a href="{{route('apl.commissions', ['filter'=>'received'])}}">
        <i class="fa fa-shopping-basket"></i> <span>@lang('apl.commissions.received')</span>
      </a>
    </li>
    <li class="header text-red">SYSTEMS</li>
    <li class="{{Request::is('apl/mails*')?'active':''}}">
      <a href="{{route('apl.mail.list', ['type'=>'inbox'])}}">
        <i class="fa fa-envelope"></i> <span>@lang('app.admin.mails')</span>
      </a>
    </li>
    <li class="{{Request::is('apl/searches')?'active':''}}">
      <a href="{{url('apl/searches')}}">
        <i class="fa fa-search"></i> <span>@lang('app.saved_searches')</span>
      </a>
    </li>
    <li class="{{Request::is('apl/favorites')?'active':''}}">
      <a href="{{url('apl/favorites')}}">
        <i class="fa fa-heart"></i> <span>@lang('app.favorites')</span>
      </a>
    </li>
  </ul>
</section>