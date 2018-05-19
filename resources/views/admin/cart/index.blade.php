@extends('layouts.admin')

@section('style')
<style>
	.map-info-title{
		font-family: Arial, Helvetica, sans-serif;
		font-style: italic;
		font-weight: bold;
		color:#267AA8;
		text-align:center;
	}
	.map-info-desc{
		margin-bottom:1em;
		font-family: Arial, Helvetica, sans-serif;
		font-style: normal;
		font-weight: bold;
		color:#FF9900;
		text-align:center;
	}
	.map-info-image{
		float: left;
		width: 100px;
		height: 64px;
		margin: 0 1em 1em 0;
	}
</style>
@endsection

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
    </div>
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
