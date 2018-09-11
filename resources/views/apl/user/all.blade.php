@extends('layouts.lte')

@section('content')
<div class="row">
    <div class="col-md-12">
      @component('components.box', ['button'=>true, 'class'=>'box-primary'])
          <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th colspan="2">User</th>
                    <th>Date d'éxpiration</th>
                    <th class="pull-right">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(count($items)>0)
                    @each('apl.user.tr', $items, 'user')
                @else
                    @include('apl.tr-empty', ['col'=>7])
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
