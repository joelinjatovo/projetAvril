@extends('layouts.app')

@section('content')

@if(\Auth::check()&&\Auth::user()->hasRole('member'))
<!-- Modal -->
<div id="modal-select-apl" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="title">@lang('member.info')</h4>
      </div>
      <div class="modal-body">
          @if(\Auth::check()&&Auth::user()->hasApl())
            <p>@lang('member.info_has_apl')</p>
          @else
            <p>@lang('member.info_no_apl')</p>
          @endif
      </div>
      <div class="modal-footer">
          <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">@lang('app.btn.cancel')</button>
          @if(\Auth::check()&&Auth::user()->hasApl())
            <a href="{{route('member.select.apl')}}" class="btn btn-success">@lang('app.btn.next')</a>
          @else
            <a href="{{route('member.select.apl')}}" class="btn btn-success">@lang('member.select.apl')</a>
          @endif
      </div>
    </div>
  </div>
</div>
@endif
    
<div class="content corps" style="margin-top: 20px;">
    <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="sidebar content-box" style="display: block; background: #fff; margin-bottom: 10px;">
                <ul class="nav nav-side" id="nav-accordion">
                    
                    @if(\Auth::check()&&\Auth::user()->hasRole('member'))
                        <li><a class="btn-select-apl btn btn-success" href="{{route('member.select.apl')}}" style="color: #000000;" aria-hidden="true">{!!__('member.choose.apl')!!}</a></li>
                    @endif
                    
                    <li><a href="{{url(Auth::user()->role)}}"><i class="fa fa-tachometer" aria-hidden="true"></i> @lang('app.dashboard')</a></li>
                    <li><a href="{{route('profile')}}"><i class="fa fa-pencil-square" aria-hidden="true"></i> @lang('app.profile')</a></li>
                    
                    @if(\Auth::check()&&\Auth::user()->hasRole('member'))
                        <li><a href="{{route('shop.cart')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> @lang('member.cart')</a></li>
                        <li><a href="{{route('member.orders')}}"><i class="fa fa-shopping-basket" aria-hidden="true"></i> @lang('member.orders')</a></li>
                        <li><a href="{{route('member.purchases')}}"><i class="fa fa-shopping-bag" aria-hidden="true"></i> @lang('member.purchases')</a></li>
                    @endif
                    
                    @if(\Auth::check()&&\Auth::user()->hasRole('apl'))
                        <li><a href="{{route('apl.commissions', ['filter'=>'not-received'])}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('apl.commissions.not-received')</a></li>
                        <li><a href="{{route('apl.commissions', ['filter'=>'received'])}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('apl.commissions.received')</a></li>
                    
                        <li><a href="{{route('apl.orders')}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('apl.orders')</a></li>
                        <li><a href="{{route('apl.sales')}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('apl.sales')</a></li>
                        <li><a href="{{route('apl.customers')}}"><i class="fa fa-users" aria-hidden="true"></i> @lang('apl.customers')</a></li>
                    @endif
                    
                    @if(\Auth::check()&&\Auth::user()->hasRole('afa'))
                    
                        <li><a href="{{route('afa.commissions', ['filter'=>'not-received'])}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('afa.commissions.not-received')</a></li>
                        <li><a href="{{route('afa.commissions', ['filter'=>'received'])}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('afa.commissions.received')</a></li>
                    
                        <li><a href="{{route('afa.commissions', ['filter'=>'not-paid'])}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('afa.commissions.not-paid')</a></li>
                        <li><a href="{{route('afa.commissions', ['filter'=>'paid'])}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('afa.commissions.paid')</a></li>
                    
                        <li><a href="{{route('afa.orders')}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('afa.orders')</a></li>
                        <li><a href="{{route('afa.sales')}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('afa.sales')</a></li>
                    @endif
                    
                    @if(\Auth::check()&&\Auth::user()->hasRole('seller'))
                        <li><a href="{{route('seller.products')}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('seller.products')</a></li>
                    
                        <li><a href="{{route('seller.orders.to-confirm')}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('seller.orders.to-confirm')</a></li>
                        <li><a href="{{route('seller.commissions', ['filter'=>'not-paid'])}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('seller.commissions.not-paid')</a></li>
                        <li><a href="{{route('seller.commissions', ['filter'=>'paid'])}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('seller.commissions.paid')</a></li>
                    
                        <li><a href="{{route('seller.orders')}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('seller.orders')</a></li>
                        <li><a href="{{route('seller.sales')}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('seller.sales')</a></li>
                    
                    @endif
                    
                    @if(\Auth::check()&&!\Auth::user()->isAdmin())
                        <li><a href="{{url(Auth::user()->role.'/favorites')}}"><i class="fa fa-gratipay" aria-hidden="true"></i> @lang('app.favorites')</a></li>
                        <li><a href="{{url(Auth::user()->role.'/searches')}}"><i class="fa fa-search" aria-hidden="true"></i> @lang('app.saved_searches')</a></li>
                        <li><a href="{{route(Auth::user()->role.'.mail.list',['filter'=>'inbox'])}}"><i class="fa fa-envelope" aria-hidden="true"></i> @lang('app.mails')</a></li>
                        @if(\Auth::check()&&\Auth::user()->hasRole('member'))
                            @if(\Auth::check()&&\Auth::user()->hasApl())
                                <li><a href="{{route('member.contact', ['role'=>'apl'])}}"><i class="fa fa-envelope" aria-hidden="true"></i> @lang('member.contact_apl')</a></li>
                            @endif
                        @endif
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
@endsection
