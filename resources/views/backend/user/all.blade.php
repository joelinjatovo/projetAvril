@extends('layouts.backend')

@section('subcontent')
<section>
    <div class="page-header">
        <h3>{{$title}}</h3>
    </div>
    <div class="row-fluid">
        <div class="col-md-12">
            @if(count($items)>0)
                @include('backend.table.user', ['users'=>$items])
            @else
            <div class="panel panel-default">
                <div class="panel-body">
                  <ul class="list-group">
                      <li class="list-group-item clearfix">
                          <h4>@lang('apl.empty')</h4>
                      </li>
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection

