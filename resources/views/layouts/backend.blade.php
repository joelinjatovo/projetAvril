@extends('layouts.app')

@section('content')
<div class="content corps" style="margin-top: 160px;">
    <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="sidebar content-box" style="display: block; background: #fff; margin-bottom: 10px;">
                <ul class="nav nav-side">
                    
                    @if(Auth::user()->hasRole('member'))
                        <li><a class="btn-select-apl btn btn-success" href="{{route('member.select.apl')}}">@lang('member.select.apl')</a></li>
                    @endif
                    
                    <li><a href="{{url(Auth::user()->role)}}"><i class="fa fa-tachometer" aria-hidden="true"></i> @lang('app.dashboard')</a></li>
                    <li><a href="{{route('profile')}}"><i class="fa fa-pencil-square" aria-hidden="true"></i> @lang('app.profile')</a></li>
                    
                    @if(Auth::user()->hasRole('member'))
                        <li><a href="{{route('shop.order.last')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> @lang('member.cart')</a></li>
                        <li><a href="{{route('member.orders')}}"><i class="fa fa-shopping-basket" aria-hidden="true"></i> @lang('member.orders')</a></li>
                        <li><a href="{{route('member.purchases')}}"><i class="fa fa-shopping-bag" aria-hidden="true"></i> @lang('member.purchases')</a></li>
                    
                        <li><a href="{{route('member.contact', ['role'=>'admin'])}}"><i class="fa fa-envelope" aria-hidden="true"></i> @lang('member.contact_admin')</a></li>
                        @if(Auth::user()->hasApl())
                            <li><a href="{{route('member.contact', ['role'=>'apl'])}}"><i class="fa fa-envelope" aria-hidden="true"></i> @lang('member.contact_apl')</a></li>
                        @endif
                    @endif
                    
                    @If(Auth::user()->hasRole('apl'))
                        <li><a href="{{route('apl.orders')}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('apl.orders')</a></li>
                        <li><a href="{{route('apl.sales')}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('apl.sales')</a></li>
                        <li><a href="{{route('apl.customers')}}"><i class="fa fa-users" aria-hidden="true"></i> @lang('apl.customers')</a></li>
                    
                        <li><a href="{{route('apl.commissions', ['filter'=>'not-paid'])}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('app.commissions.not_paid')</a></li>
                        <li><a href="{{route('apl.commissions', ['filter'=>'paid'])}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('app.commissions.paid')</a></li>
                    @endif
                    
                    @If(Auth::user()->hasRole('afa'))
                        <li><a href="{{route('afa.orders')}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('afa.orders')</a></li>
                        <li><a href="{{route('afa.sales')}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('afa.sales')</a></li>
                    
                        <li><a href="{{route('afa.commissions', ['filter'=>'paid'])}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('app.commissions.paid')</a></li>
                        <li><a href="{{route('afa.commissions', ['filter'=>'not-paid'])}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('app.commissions.not_paid')</a></li>
                    @endif
                    
                    @If(Auth::user()->hasRole('seller'))
                        <li><a href="{{route('seller.products')}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('seller.products')</a></li>
                        <li><a href="{{route('seller.orders')}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('seller.orders')</a></li>
                        <li><a href="{{route('seller.sales')}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('seller.sales')</a></li>
                    @endif
                    
                    @if(!Auth::user()->isAdmin())
                        <li><a href="{{url(Auth::user()->role.'/favorites')}}"><i class="fa fa-gratipay" aria-hidden="true"></i> @lang('app.favorites')</a></li>
                        <li><a href="{{url(Auth::user()->role.'/searches')}}"><i class="fa fa-search" aria-hidden="true"></i> @lang('app.saved_searches')</a></li>
                        <li>
                             <a href="{{route(Auth::user()->role.'.mail.list',['filter'=>'inbox'])}}">
                                <i class="fa fa-envelope"></i> @lang('app.mails')
                             </a>
                        </li>
                    @endif
                    
                    <li><a href="{{route('logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> @lang('app.logout')</a></li>
                </ul>
             </div>
          </div>
          <div class="col-md-9">
              @include('includes.alerts')
              @yield('subcontent')
          </div>
      </div>
  </div>
</div>

@if(Auth::user()->hasRole('member'))
<!-- Modal -->
<div id="modal-select-apl" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="title">@lang('member.info')</h4>
      </div>
      <div class="modal-body">
          @if(Auth::user()->hasAPl())
          <p>@lang('member.info_has_apl')</p>
          @else
          <p>@lang('member.info_no_apl')</p>
          @endif
      </div>
      <div class="modal-footer">
          <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">@lang('app.btn.cancel')</button>
          @if(Auth::user()->hasAPl())
            <a href="{{route('member.select.apl')}}" class="btn btn-success" type="submit">@lang('app.btn.next')</a>
          @else
            <a href="{{route('member.select.apl')}}" class="btn btn-success" type="submit">@lang('member.select.apl')
          @endif
      </div>
    </div>
  </div>
</div>
@endif

@endsection
