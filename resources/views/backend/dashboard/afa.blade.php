@extends('layouts.backend')

@section('subcontent')
<div class="row">
    <div id="property-sidebar">
        <div class="col-sm-12">
            <div class="col-sm-4">
                <a href="{{route('shop.cart')}}">
                    <section class="widget text-center">
                        <strong></strong>
                        <h3></h3>
                    </section>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="r">
                    <section class="widget text-center">
                        <strong>@lang('app.pin')/@lang('app.favorites')</strong>
                        <h3>{{count($item->pins)}}/{{count($item->favorites)}}</h3>
                    </section>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="r">
                    <section class="widget text-center">
                        <strong>@lang('app.orders')/@lang('app.sales')</strong>
                        <h3>{{count($item->sales)}}/{{count($item->sales)}}</h3>
                    </section>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection