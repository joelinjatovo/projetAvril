@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <!-- // page head -->
    <div id="page-content" class="page-content tab-content overflow-y">
        <div class="tab-pane padding-bottom30 active fade in">
            @include('includes.alerts')
            <div>
                @if($item->status=='ordered')
                    @if(!$item->apl_paid_at)
                    <a href="{{route('admin.shop.pay', ['cartitem'=>$item, 'role'=>'apl'])}}" class="btn btn-small btn-info btn-delete">@lang('app.admin.shop.pay.apl')</a>
                    @endif

                    @if(!$item->afa_paid_at)
                    <a href="{{route('admin.shop.pay', ['cartitem'=>$item, 'role'=>'afa'])}}" class="btn btn-small btn-info btn-delete">@lang('app.admin.shop.pay.afa')</a>
                    @endif
                @endif
            </div>
            <div class="page-header">
                <h3>{{$title}}</h3>
            </div>
            <div class="row-fluid">
                <div class="grider">
                    <div class="widget widget-simple">
                        <div class="widget-content">
                            <div class="widget-body">
                                @if($item->product)
                                <div class="col-md-3">
                                    <img src="{{$item->product->imageUrl(true)}}" style="width:100%;">
                                </div>
                                @endif
                                <div class="col-md-9">
                                    
                                    <span class="pull-right label label-default">{{$item->created_at->diffForHumans()}}</span>
                                    <h4>@lang('app.status') : <a href="{{route('admin.shop', ['filter'=>$item->status])}}">@lang('app.'.$item->status)</a></h4> 
                                    <hr> 
                                    
                                    
                                    @if($item->author)
                                        <h4>@lang('app.customer') : <a href="{{route('admin.user.show', $item->author)}}">{{$item->author->name}}</a></h4> 
                                    <hr>
                                    @endif
                                    
                                    @if($item->apl)
                                        <h4>@lang('app.apl') : <a href="{{route('admin.user.show', $item->apl)}}">{{$item->apl->name}}</a></h4>
                                        @if($item->status=='ordered')
                                            @if($item->apl_paid_at)
                                                <span class="label label-info">@lang('app.paid')</span>
                                                <span class="pull-right label label-default">{{$item->apl_paid_at->diffForHumans()}}</span>
                                            @else
                                                <span class="label label-warning">@lang('app.not_paid')</span>
                                            @endif
                                        @endif
                                    <hr>
                                    @endif
                                    
                                    @if($item->afa)
                                        <h4>@lang('app.afa') : <a href="{{route('admin.user.show', $item->afa)}}">{{$item->afa->name}}</a></h4> 
                                        @if($item->status=='ordered')
                                            @if($item->afa_paid_at)
                                                <span class="label label-info">@lang('app.paid')</span>
                                                <span class="pull-right label label-default">{{$item->afa_paid_at->diffForHumans()}}</span>
                                            @else
                                                <span class="label label-warning">@lang('app.not_paid')</span>
                                            @endif
                                        @endif
                                    <hr>
                                    @endif
                                    
                                    @if($item->product&&$item->product->seller)
                                        <h4>@lang('app.seller') : <a href="{{route('admin.user.show', $item->product->seller)}}">{{$item->product->seller->name}}</a></h4> 
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($item->product)
                    <div class="widget widget-simple">
                        <div class="widget-content">
                            <div class="widget-body">
                                <fieldset>
                                    <h4>@lang('app.description')</h4>
                                    <p>{!!$item->product->content!!}</p>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
