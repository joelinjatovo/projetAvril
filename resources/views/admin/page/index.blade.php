@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <div id="page-content" class="page-content tab-content overflow-y">
        <div id="TabTop1" class="tab-pane padding-bottom30 active fade in">
            @include('includes.alerts')
            <div>
                <a href="{{route('admin.page.create')}}" class="btn btn-small btn-success btn-update">@lang('app.btn.add')</a>
                <a href="{{route('admin.page.edit', $item)}}" class="btn btn-small btn-info btn-update">@lang('app.btn.edit')</a>
                <a href="{{route('admin.page.delete', $item)}}" class="btn btn-small btn-warning btn-delete">@lang('app.btn.delete')</a>
            </div>
            <div class="page-header">
                <h3>{{$item->title}} <small>{{$item->path}}</small></h3>
            </div>
            <div class="row-fluid">
                <div class="grider">
                    <div class="widget widget-simple">
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
    <div class="page-content tab-content overflow-y">
        <div class="page-header">
            <h3>@lang('app.childs')</h3>
        </div>
        <div class="row-fluid">
            @include('admin.table.page',['pages'=>$item->childs])
        </div>
    </div>
    <div class="page-content tab-content overflow-y">
        <div class="page-header">
            <h3>@lang('app.pubs')</h3>
        </div>
        <div class="row-fluid">
            @include('admin.table.pub',['pubs'=>$item->pubs, 'page'=>$item])
        </div>
    </div>
</div>

@endsection

