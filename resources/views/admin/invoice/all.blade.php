@extends('layouts.lte')

@section('content')
<div class="row">
    <div class="col-md-12">
      @component('components.box', ['button'=>true, 'class'=>'box-primary'])
          <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Factures</th>
                    <th>Prix</th>
                    <th>Type</th>
                    <th>Order ID</th>
                    <th>From</th>
                    <th>To</th>
                    <th class="pull-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(count($items)>0)
                    @each('admin.invoice.tr', $items, 'invoice')
                @else
                    @include('admin.tr-empty', ['col'=>6])
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

@section('script')
@parent
@include('admin.inc.sweetalert-product')
@endsection