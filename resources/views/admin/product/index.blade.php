@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <!-- // page head -->
    <div id="page-content" class="page-content tab-content overflow-y">
        <div id="TabTop1" class="tab-pane padding-bottom30 active fade in">
            @include('includes.alerts')
            <div>
             @if($item->status=='pinged' || $item->status=='archived')
                <a href="{{route('admin.product.publish', $item)}}" class="btn btn-small btn-success btn-publish">@lang('app.btn.publish')</a>
                <a href="{{route('admin.product.trash', $item)}}" class="btn btn-small btn-info btn-trash">@lang('app.btn.trash')</a>
             @elseif($item->status=='trashed')
                <a href="{{route('admin.product.restore', $item)}}" class="btn btn-small btn-info btn-restore">Restore</a>
             @endif
             @if($item->status=='published')
                <a href="{{route('admin.product.archive', $item)}}" class="btn btn-small btn-default  btn-archive">@lang('app.btn.archive')</a>
                <a href="{{route('admin.product.trash', $item)}}" class="btn btn-small btn-info btn-trash">@lang('app.btn.trash')</a>
             @endif
                <a href="{{route('admin.product.delete', $item)}}" class="btn btn-small btn-warning btn-delete">@lang('app.btn.delete')</a>
            </div>
            <div class="page-header">
                <h3>{{$item->title}}</h3>
            </div>
            <div class="row-fluid">
                <div class="grider">
                    <div class="widget widget-simple">
                        <div class="widget-content">
                            <div class="widget-body">
                                <div class="col-md-3">
                                    <img src="{{$item->imageUrl(true)}}" style="width:100%;">
                                </div>
                                <div class="col-md-9">
                                    <h3>@lang('app.reference') : {{$item->reference}}</h3> 
                                    
                                    <h4>@lang('app.status') : <a href="{{route('admin.product.list', ['filter'=>$item->status])}}">@lang('app.'.$item->status)</a></h4> 
                                    
                                    @if($item->category)
                                        <h4>@lang('app.category') : <a href="{{route('admin.category.show', $item->category)}}">{{$item->category->title}}</a></h4> 
                                    @endif
                                    
                                    @if($item->seller)
                                        <h4>@lang('app.seller') : <a href="{{route('admin.user.show', $item->seller)}}">{{$item->seller->name}}</a></h4> 
                                    @endif
                                    
                                    @if($item->buyer)
                                        <h4>@lang('app.buyer') : <a href="{{route('admin.user.show', $item->seller)}}">{{$item->buyer->name}}</a></h4> 
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget widget-simple">
                        <div class="widget-content">
                            <div class="widget-body">
                                <fieldset>
                                    <h4>@lang('app.description')</h4>
                                    <p>{!!$item->content!!}</p>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    @include('admin.product.location', ['location'=>$item->location])
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

