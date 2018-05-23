@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <div class="row-fluid page-head">
        <h2 class="page-title">
            @if(isset($title))
                {{$title}}
            @else
                @lang('app.cart.list')
            @endif
        </h2>
    </div>
    <div id="page-content" class="page-content">
        <section>
            <div class="row-fluid">
                <div class="span12">
                    @include('admin.table.cart', ['carts'=>$items])
                </div>
            </div>
        </section>
        {{$items->links()}}
    </div>
</div>
@endsection
