@extends('layouts.backend')

@section('subcontent')
<div class="row">
    <div id="property-sidebar">
        <div class="col-sm-12">
            <div class="col-sm-6">
                <a href="#">
                    <section class="widget text-center">
                        <strong>@lang('app.favorites')</strong>
                        <h3>{{$count['favorites']}}</h3>
                    </section>
                </a>
            </div>
            <div class="col-sm-6">
                <a href="#">
                    <section class="widget text-center">
                        <strong>@lang('app.sales')/@lang('app.orders')</strong>
                        <h3>{{$count['sales']}}/{{$count['orders']}}</h3>
                    </section>
                </a>
            </div>
        </div>
    </div>
</div>
<div id="property-sidebar">
    <div class="col-sm-6">
        <section class="widget recent-properties clearfix">
            <h5 class="title">@lang('app.sales')</h5>
            @foreach($recent['sales'] as $product)
                @include('backend.product.item', ['product'=>$product])
            @endforeach
        </section>
    </div>
    <div class="col-sm-6">
        <section class="widget recent-properties clearfix">
            <h5 class="title">@lang('app.orders')</h5>
            @foreach($recent['orders'] as $product)
                @include('backend.product.item', ['product'=>$product])
            @endforeach
        </section>
    </div>
</div>
<div id="property-sidebar">
    <div class="col-sm-6">
        <section class="widget recent-properties clearfix">
            <h5 class="title">@lang('app.favorites')</h5>
            @foreach($recent['favorites'] as $product)
                @include('backend.product.item', ['product'=>$product])
            @endforeach
        </section>
    </div>
    <div class="col-sm-6">
        <section class="widget recent-properties clearfix">
            <h5 class="title">@lang('app.pins')</h5>
            @foreach($recent['pins'] as $product)
                @include('backend.product.item', ['product'=>$product])
            @endforeach
        </section>
    </div>
</div>
@endsection