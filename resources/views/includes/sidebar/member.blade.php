<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="{{Request::is('member')?'active':''}}">
        <a href="{{url('member')}}"><i class="fa fa-dashboard"></i> <span>@lang('app.dashboard')</span></a>
    </li>
    <li class="header">PERSONNAL</li>
    <li class="{{Request::is('member/searches')?'active':''}}">
      <a href="{{route('shop.cart')}}">
        <i class="fa fa-shopping-cart"></i> <span>@lang('member.cart')</span>
        @if(session()->has('order'))
        <div class="notify" style="margin-right: 10px;"> <span class="heartbit"></span> <span class="point"></span> </div>
        @endif
      </a>
    </li>
    <li class="{{Request::is('member/carts')?'active':''}}">
      <a href="{{route('member.carts')}}">
        <i class="fa fa-shopping-cart"></i> <span>@lang('member.carts')</span>
      </a>
    </li>
    <li class="{{Request::is('member/orders')?'active':''}}">
      <a href="{{route('member.orders')}}">
        <i class="fa fa-shopping-basket"></i> <span>@lang('member.orders')</span>
      </a>
    </li>
    <li class="{{Request::is('member/purchases')?'active':''}}">
      <a href="{{route('member.purchases')}}">
        <i class="fa fa-shopping-bag"></i> <span>@lang('member.purchases')</span>
      </a>
    </li>
    <li class="{{Request::is('member/contact')?'active':''}}">
      <a href="{{route('member.contact', ['role'=>'apl'])}}">
        <i class="fa fa-send"></i> <span>@lang('member.contact_apl')</span>
      </a>
    </li>
    <li class="header text-red">SYSTEMS</li>
    <li class="{{Request::is('member/mails*')?'active':''}}">
      <a href="{{route('member.mail.list', ['type'=>'inbox'])}}">
        <i class="fa fa-envelope"></i> <span>@lang('app.admin.mails')</span>
      </a>
    </li>
    <li class="{{Request::is('member/searches')?'active':''}}">
      <a href="{{url('member/searches')}}">
        <i class="fa fa-search"></i> <span>@lang('app.saved_searches')</span>
      </a>
    </li>
    <li class="{{Request::is('member/favorites')?'active':''}}">
      <a href="{{url('member/favorites')}}">
        <i class="fa fa-heart"></i> <span>@lang('app.favorites')</span>
      </a>
    </li>
  </ul>
</section>