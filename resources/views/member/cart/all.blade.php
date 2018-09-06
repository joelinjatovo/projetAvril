@extends('layouts.lte')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if(count($items)>0)
            @include('backend.table.order', ['orders'=>$items])
        @else
        <div class="panel panel-default">
            <div class="panel-body">
              <ul class="list-group">
                  <li class="list-group-item clearfix">
                      <h4>@lang('member.empty')</h4>
                  </li>
                </ul>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
