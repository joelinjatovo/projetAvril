@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
<div class="row-fluid page-head">
    <h2 class="page-title">
        @if($item->status=='paid')
        <h3>@lang('app.purchases')</h3>
        @elseif($item->status=='ordered')
        <h3>@lang('app.orders')</h3>
        @else
        <h3>@lang('app.carts')</h3>
        @endif
    </h2>
    <div class="page-bar">
        <div class="btn-toolbar"> </div>
    </div>
</div>
<!-- // page head -->
<div id="page-content" class="page-content">
    <section>
        <div class="row-fluid">
            <div class="span12">
                @include('admin.table.product', ['products'=>$item->products])
            </div>
        </div>
    </section>
</div>
</div>
@endsection
