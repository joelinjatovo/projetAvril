@extends('layouts.backend')

@section('subcontent')
<div id="property-sidebar">
    <div class="col-sm-12">
        <section class="widget recent-properties clearfix">
            <div class="page-header">
                <h3>{{isset($title)?$title:__('app.list.product')}}</h3>
            </div>
            @foreach($items as $item)
                @include('backend.product.item', ['product'=>$item])
            @endforeach
        </section>
    </div>
</div>
@endsection
