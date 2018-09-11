<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="{{Request::is('afa')?'active':''}}">
        <a href="{{url('afa')}}"><i class="fa fa-dashboard"></i> <span>@lang('app.dashboard')</span></a>
    </li>
    <li class="header text-aqua">SHOP</li>
    <li class="{{Request::is('afa/orders')?'active':''}}">
      <a href="{{route('afa.orders')}}">
        <i class="fa fa-shopping-basket"></i> <span>@lang('afa.orders')</span>
      </a>
    </li>
    <li class="{{Request::is('afa/sales')?'active':''}}">
      <a href="{{route('afa.sales')}}">
        <i class="fa fa-shopping-bag"></i> <span>@lang('afa.sales')</span>
      </a>
    </li>
    <li class="header text-yellow">COMMISSIONS SUR VENTE</li>
    <li class="{{Request::is('afa/commissions/not-received')?'active':''}}">
      <a href="{{route('afa.commissions', ['filter'=>'not-received'])}}">
        <i class="fa fa-shopping-basket"></i> <span>@lang('afa.commissions.not-received')</span>
      </a>
    </li>
    <li class="{{Request::is('afa/commissions/received')?'active':''}}">
      <a href="{{route('afa.commissions', ['filter'=>'received'])}}">
        <i class="fa fa-shopping-basket"></i> <span>@lang('afa.commissions.received')</span>
      </a>
    </li>
    <li class="header text-yellow">Commission PC</li>
    <li class="{{Request::is('afa/commissions/not-paid')?'active':''}}">
      <a href="{{route('afa.commissions', ['filter'=>'not-paid'])}}">
        <i class="fa fa-shopping-basket"></i> <span>@lang('afa.commissions.not-paid')</span>
      </a>
    </li>
    <li class="{{Request::is('afa/commissions/paid')?'active':''}}">
      <a href="{{route('afa.commissions', ['filter'=>'paid'])}}">
        <i class="fa fa-shopping-basket"></i> <span>@lang('afa.commissions.paid')</span>
      </a>
    </li>
    <li class="header text-red">SYSTEMS</li>
    <li class="{{Request::is('afa/mails*')?'active':''}}">
      <a href="{{route('afa.mail.list', ['type'=>'inbox'])}}">
        <i class="fa fa-envelope"></i> <span>@lang('app.admin.mails')</span>
      </a>
    </li>
    <li class="{{Request::is('afa/searches')?'active':''}}">
      <a href="{{url('afa/searches')}}">
        <i class="fa fa-search"></i> <span>@lang('app.saved_searches')</span>
      </a>
    </li>
    <li class="{{Request::is('afa/favorites')?'active':''}}">
      <a href="{{url('afa/favorites')}}">
        <i class="fa fa-heart"></i> <span>@lang('app.favorites')</span>
      </a>
    </li>
  </ul>
</section>