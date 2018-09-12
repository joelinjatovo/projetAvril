@extends('layouts.lte')

@section('content')
<div class="row">
    <div class="col-md-12">
      @component('components.box', ['button'=>true, 'class'=>'box-primary'])
          <table class="table table-striped table-hover items-list">
            <thead>
                <tr>
                     <th scope="col">@lang('app.table.products') <span class="column-sorter"></span></th>
                     <th scope="col">@lang('app.table.date') <span class="column-sorter"></span></th>
                     <th scope="col">@lang('app.table.status') <span class="column-sorter"></span></th>
                     <th scope="col" class="pull-right text-right" width="150px">@lang('app.table.actions') </th>
                </tr>
            </thead>
            <tbody>
                @if(count($items)>0)
                    @each('seller.product.tr', $items, 'product')
                @else
                    @include('seller.tr-empty', ['col'=>5])
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
