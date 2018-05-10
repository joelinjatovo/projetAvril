@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <div id="page-content" class="page-content tab-content overflow-y">
        <div id="TabTop1" class="tab-pane padding-bottom30 active fade in">
            <div class="page-header">
                <h3>{{$item->title}} <small>{{$item->path}}</small></h3>
            </div>
            <div class="row-fluid">
                <div class="grider">
                    <div class="widget widget-simple">
                        @include('includes.alerts')
                        <div class="widget-header">
                            <h4><small>@lang('app.description')</small></h4>
                        </div>
                        <div class="widget-content">
                            <div class="widget-body">
                                {!!$item->content!!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="page-content" class="page-content tab-content overflow-y">
        <div class="page-header">
            <h3>@lang('app.pubs')</h3>
        </div>
        <div class="row-fluid">
            @include('admin.table.pub',['pubs'=>$item->pubs])
        </div>
    </div>
</div>

@endsection

