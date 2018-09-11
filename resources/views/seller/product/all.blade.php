@extends('layouts.lte')

@section('content')
<div class="row">
    <div class="col-md-12">
      @component('components.box', ['button'=>true, 'class'=>'box-primary'])
          <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th colspan="2">Produits</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(count($items)>0)
                    @each('seller.product.tr', $items, 'product')
                @else
                    @include('seller.tr-empty', ['col'=>4])
                @endif
            </tbody>
          </table>
          
          @slot('footer')
              {{$items->links()}}
          @endslot
          
      @endcomponent
    </div>
</div>
@endsection
