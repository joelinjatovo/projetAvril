@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <!-- // page head -->
    <div id="page-content" class="page-content tab-content overflow-y">
        <div id="TabTop1" class="tab-pane padding-bottom30 active fade in">
            @include('includes.alerts')
            <div>
                
                 <form id="form-item-action-delete" class="pull-left" action="{{route('admin.user.list')}}" method="post">
                     {{csrf_field()}}
                     <input type="hidden" name="user" value="{{$item->id}}">
                     <input type="hidden" name="action" value="delete">
                     <button type="submit" class="btn btn-small btn-warning">@lang('app.btn.delete')</button>
                 </form>
                 @if($item->status=='active')
                 <form id="form-item-action-disable" class="pull-left" action="{{route('admin.user.list')}}" method="post">
                     {{csrf_field()}}
                     <input type="hidden" name="user" value="{{$item->id}}">
                     <input type="hidden" name="action" value="disable">
                     <button type="submit" class="btn btn-small btn-success">@lang('app.btn.disable')</button>
                 </form>
                 @else
                 <form id="form-item-action-active" class="pull-left" action="{{route('admin.user.list')}}" method="post">
                     {{csrf_field()}}
                     <input type="hidden" name="user" value="{{$item->id}}">
                     <input type="hidden" name="action" value="active">
                     <button type="submit" class="btn btn-small btn-info">@lang('app.btn.active')</button>
                 </form>
                 @endif
                 <a href="{{route('admin.user.contact', $item)}}" class="btn btn-small btn-default">@lang('app.btn.contact')</a>
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
                    
                    @if($item->hasRole('member') && $item->type=='person')
                        @include('admin.user.info.person',   ['item'=>$item])
                    @else
                        @include('admin.user.info.orga',     ['item'=>$item])
                        @include('admin.user.info.contact',  ['item'=>$item])
                    @endif
                    
                    @include('admin.user.info.location', ['location'=>$item->location])
                    
                    <div class="widget widget-simple">
                        <div class="widget-header">
                            <h4><small>@lang('app.observations')</small></h4>
                        </div>
                        @include('admin.table.observation',['item'=>$item])
                    </div>
                    
                    @if($item->role=='member')
                        @if($item->apl)
                            @include('admin.user.info.apl',    ['item'=>$item->apl])
                        @endif
                        <div class="widget widget-simple">
                            <div class="widget-header">
                                <h4><small>@lang('app.orders')</small></h4>
                            </div>
                            @include('admin.table.product',[
                                'products'=>$item->purchases()->wherePivot('status', 'ordered')
                            ])
                        </div>
                        <div class="widget widget-simple">
                            <div class="widget-header">
                                <h4><small>@lang('app.purchases')</small></h4>
                            </div>
                            @include('admin.table.product',[
                                'products'=>$item->purchases()->wherePivot('status', 'paid')
                            ])
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
                                <h4><small>@lang('app.orders')</small></h4>
                            </div>
                            @include('admin.table.product',[
                                'products'=>$item->sales()->wherePivot('status', 'ordered')
                            ])
                        </div>
                        <div class="widget widget-simple">
                            <div class="widget-header">
                                <h4><small>@lang('app.sales')</small></h4>
                            </div>
                            @include('admin.table.product',[
                                'products'=>$item->sales()->wherePivot('status', 'paid')
                            ])
                        </div>
                    @endif
                    
                    @if($item->role=='seller')
                        <div class="widget widget-simple">
                            <div class="widget-header">
                                <h4><small>@lang('app.products')</small></h4>
                            </div>
                            @include('admin.table.product',[
                                'products'=>$item->products
                            ])
                        </div>
                        <div class="widget widget-simple">
                            <div class="widget-header">
                                <h4><small>@lang('app.orders')</small></h4>
                            </div>
                            @include('admin.table.product',[
                                'products'=>$item->products()->where('products.status', 'ordered')
                            ])
                        </div>
                        <div class="widget widget-simple">
                            <div class="widget-header">
                                <h4><small>@lang('app.sales')</small></h4>
                            </div>
                            @include('admin.table.product',[
                                'products'=>$item->products()->where('products.status', 'paid')
                            ])
                        </div>
                    @endif
                    
                    @if($item->role=='afa')
                        <div class="widget widget-simple">
                            <div class="widget-header">
                                <h4><small>@lang('app.orders')</small></h4>
                            </div>
                            @include('admin.table.product',[
                                'products'=>$item->sales()->wherePivot('status', 'ordered')
                            ])
                        </div>
                        <div class="widget widget-simple">
                            <div class="widget-header">
                                <h4><small>@lang('app.sales')</small></h4>
                            </div>
                            @include('admin.table.product',[
                                'products'=>$item->sales()->wherePivot('status', 'paid')
                            ])
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

