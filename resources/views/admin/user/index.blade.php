@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <!-- // page head -->
    <div id="page-content" class="page-content tab-content overflow-y">
        <div id="TabTop1" class="tab-pane padding-bottom30 active fade in">
            @include('includes.alerts')
            <div>
                 @if($item->status!='blocked')
                    <a href="{{route('admin.user.block', $item)}}" class="btn btn-small btn-default">@lang('app.btn.block')</a>
                 @endif
                 @if($item->status=='active')
                    <a href="{{route('admin.user.disable', $item)}}" class="btn btn-small btn-success">@lang('app.btn.disable')</a>
                 @else
                    <a href="{{route('admin.user.active', $item)}}" class="btn btn-small btn-info">@lang('app.btn.active')</a>
                 @endif
                    <a href="{{route('admin.user.delete', $item)}}" class="btn btn-small btn-warning">@lang('app.btn.delete')</a>
            </div>
            <div class="page-header">
                <h3>
                    @if(isset($title))
                        {{$title}}
                    @else
                        @lang('app.user')
                    @endif
                </h3>
            </div>
            <div class="row-fluid">
                <div class="grider">
                    @include('admin.user.info.login',    ['item'=>$item])
                    
                    @if($item->type=='organization')
                    @include('admin.user.info.orga',     ['item'=>$item])
                    @include('admin.user.info.contact',  ['item'=>$item])
                    @endif
                    
                    @if($item->type=='person')
                    @include('admin.user.info.person',   ['item'=>$item])
                    @endif
                    
                    @include('admin.user.info.location', ['location'=>$item->location])
                    
                    <div class="widget widget-simple">
                        <div class="widget-header">
                            <h4><small>@lang('app.observations')</small></h4>
                        </div>
                        @include('admin.table.observation',['item'=>$item])
                    </div>
                    
                    @if($item->role=='member')
                    <div class="widget widget-simple">
                        <div class="widget-header">
                            <h4><small>@lang('app.purchases')</small></h4>
                        </div>
                        @include('admin.table.product',['products'=>$item->purchases])
                    </div>
                    <div class="widget widget-simple">
                        <div class="widget-header">
                            <h4><small>@lang('app.pins')</small></h4>
                        </div>
                        @include('admin.table.product',['products'=>$item->pins])
                    </div>
                    <div class="widget widget-simple">
                        <div class="widget-header">
                            <h4><small>@lang('app.favorites')</small></h4>
                        </div>
                        @include('admin.table.product',['products'=>$item->favorites])
                    </div>
                    @endif
                    
                    @if($item->role=='apl')
                    <div class="widget widget-simple">
                        <div class="widget-header">
                            <h4><small>@lang('app.customers')</small></h4>
                        </div>
                        @include('admin.table.user',['users'=>$item->customers])
                    </div>
                    <div class="widget widget-simple">
                        <div class="widget-header">
                            <h4><small>@lang('app.sales')</small></h4>
                        </div>
                        @include('admin.table.product',['products'=>$item->sales])
                    </div>
                    @endif
                    
                    @if($item->role=='seller')
                    <div class="widget widget-simple">
                        <div class="widget-header">
                            <h4><small>@lang('app.products')</small></h4>
                        </div>
                        @include('admin.table.product',['products'=>$item->products])
                    </div>
                    @endif
                    
                    @if($item->role=='afa')
                    <div class="widget widget-simple">
                        <div class="widget-header">
                            <h4><small>@lang('app.sales')</small></h4>
                        </div>
                        @include('admin.table.product',['products'=>$item->sales])
                    </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

