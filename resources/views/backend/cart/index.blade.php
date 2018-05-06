@extends('layouts.backend')

@section('subcontent')
<section>
    <div class="page-header">
        @if($item->status=='paid')
        <h3>@lang('app.purchases')</h3>
        @else
        <h3>@lang('app.orders')</h3>
        @endif
    </div>
    <div class="row-fluid">
        <div class="col-md-12">
            @include('backend.table.product', ['products'=>$item->products])
        </div>
    </div>
</section>
@endsection
