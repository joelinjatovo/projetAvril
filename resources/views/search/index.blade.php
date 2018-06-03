@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 160px;">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <header class="section-header text-center">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="pull-left">@lang('app.search')</h3>
                    </div>
                </div>
            </header>

            <!-- breadcrumb     -->
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('home')}}">@lang('app.home')</a></li>
                        <li class="breadcrumb-item active">@lang('app.search')</li>
                    </ol>
                </div>
            </div>
            
            <div class="product-data"> 
                @php $i = 0; @endphp
                @foreach($items as $item)
                    @if($i%3 === 0)
                        <div class="row" id="txtHint">
                    @endif
                    <div class="col-md-4 layout-item-wrap">
                        @include('product.single', ['item'=>$item])
                    </div>
                    @php $i++; @endphp
                    @if($i%3 === 0)
                        </div>
                    @endif
                @endforeach
                @if((($i%3) > 0))
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

