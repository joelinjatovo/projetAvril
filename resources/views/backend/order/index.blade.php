@extends('layouts.backend')

@section('subcontent')
<section>
    <div class="page-header">
        @if($item->status=='payed')
        <h3>@lang('app.purchases')</h3>
        @else
        <h3>@lang('app.orders')</h3>
        @endif
        <?php $cart = $item->cart; ?>
    </div>
    <div class="row-fluid">
        <div class="col-md-12">
            @include('backend.table.product', ['products'=>$cart->products])
        </div>
    </div>
</section>
@endsection
