<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="{{Request::is('seller')?'active':''}}">
        <a href="{{url('seller')}}"><i class="fa fa-dashboard"></i> <span>@lang('app.dashboard')</span></a>
    </li>
    <li class="header text-aqua">SHOP</li>
    <li class="{{Request::is('seller/products')?'active':''}}">
      <a href="{{route('seller.products')}}">
        <i class="fa fa-shopping-cart"></i> <span>@lang('seller.products')</span>
      </a>
    </li>
    <li class="{{Request::is('seller/orders')?'active':''}}">
      <a href="{{route('seller.orders')}}">
        <i class="fa fa-shopping-basket"></i> <span>@lang('seller.orders')</span>
      </a>
    </li>
    <li class="{{Request::is('seller/sales')?'active':''}}">
      <a href="{{route('seller.sales')}}">
        <i class="fa fa-shopping-bag"></i> <span>@lang('seller.sales')</span>
      </a>
    </li>
    <li class="header">COMMANDES & COMMISSIONS</li>
    <li class="{{Request::is('seller/confirms')?'active':''}}">
      <a href="{{route('seller.orders.to-confirm')}}">
        <i class="fa fa-shopping-basket"></i> <span>@lang('seller.orders.to-confirm')</span>
      </a>
    </li>
    <li class="{{Request::is('seller/commissions/not-paid')?'active':''}}">
      <a href="{{route('seller.commissions', ['filter'=>'not-paid'])}}">
        <i class="fa fa-shopping-basket"></i> <span>@lang('seller.commissions.not-paid')</span>
      </a>
    </li>
    <li class="{{Request::is('seller/commissions/paid')?'active':''}}">
      <a href="{{route('seller.commissions', ['filter'=>'paid'])}}">
        <i class="fa fa-shopping-basket"></i> <span>@lang('seller.commissions.paid')</span>
      </a>
    </li>
    <li class="header text-red">SYSTEMS</li>
    <li class="{{Request::is('seller/mails*')?'active':''}}">
      <a href="{{route('seller.mail.list', ['type'=>'inbox'])}}">
        <i class="fa fa-envelope"></i> <span>@lang('app.admin.mails')</span>
      </a>
    </li>
    <li class="{{Request::is('seller/searches')?'active':''}}">
      <a href="{{url('seller/searches')}}">
        <i class="fa fa-search"></i> <span>@lang('app.saved_searches')</span>
      </a>
    </li>
    <li class="{{Request::is('seller/favorites')?'active':''}}">
      <a href="{{url('seller/favorites')}}">
        <i class="fa fa-heart"></i> <span>@lang('app.favorites')</span>
      </a>
    </li>
  </ul>
</section>