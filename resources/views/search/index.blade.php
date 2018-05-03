@extends('layouts.app')

@section('content')
@include('includes.slider')
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-7">
            @php $i = 0; @endphp
            @foreach($items as $item)
                @if($i%2 === 0)
                    <div class="row" id="txtHint">
                @endif
                <div class="col-md-6 layout-item-wrap">
                    @include('product.single', ['item'=>$item])
                </div>
                @php $i++; @endphp
                @if($i%2 === 0)
                    </div>
                @endif
            @endforeach
            @if((($i%2) > 0))
            </div>
            @endif
            <div class="col-md-12 layout-item-wrap">
                {{$items->links()}}
            </div>
        </div>
        <div class="col-lg-4 col-md-5">
            @include('includes.sidebar')
        </div>
    </div>
</div>

@endsection