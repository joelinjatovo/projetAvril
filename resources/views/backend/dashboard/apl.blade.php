@extends('layouts.backend')

@section('subcontent')
<div class="row">
    <div id="property-sidebar">
        <div class="col-sm-12">
            <div class="col-sm-4">
                <a href="{{route('shop.cart')}}">
                    <section class="widget text-center">
                        <strong>@lang('app.customers')</strong>
                        <h3>{{$count['customers']}}</h3>
                    </section>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="#">
                    <section class="widget text-center">
                        <strong>@lang('app.pins')/@lang('app.favorites')</strong>
                        <h3>{{$count['pins']}}/{{$count['favorites']}}</h3>
                    </section>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="#">
                    <section class="widget text-center">
                        <strong>@lang('app.orders')/@lang('app.sales')</strong>
                        <h3>{{$count['orders']}}/{{$count['sales']}}</h3>
                    </section>
                </a>
            </div>
        </div>
    </div>
</div>
<div id="property-sidebar">
    <div class="col-sm-6">
        <section class="widget recent-properties clearfix">
            <h5 class="title">@lang('app.orders')</h5>
            @foreach($recent['orders'] as $product)
                @include('backend.product.item', ['product'=>$product])
            @endforeach
        </section>
    </div>
    <div class="col-sm-6">
        <section class="widget recent-properties clearfix">
            <h5 class="title">@lang('app.sales')</h5>
            @foreach($recent['sales'] as $product)
                @include('backend.product.item', ['product'=>$product])
            @endforeach
        </section>
    </div>
</div>
<div id="property-sidebar">
    <div class="col-sm-12">
        <section class="widget recent-properties clearfix">
            <h5 class="title">@lang('app.customers')</h5>
            @foreach($recent['customers'] as $user)
                @include('backend.user.item', ['user'=>$user])
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