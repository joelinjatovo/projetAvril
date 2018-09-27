@extends('layouts.lte')

@section('content')
<div class="row">
    <div class="col-md-12">
      @component('components.box', ['button'=>true, 'class'=>'box-primary'])
          <table class="table table-striped table-hover items-list">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Date d'éxpiration</th>
                    <th class="pull-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(count($items)>0)
                    @each('apl.user.tr', $items, 'user')
                @else
                    @include('apl.tr-empty', ['col'=>3])
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
