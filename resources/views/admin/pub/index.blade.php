@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <!-- // page head -->
    <div id="page-content" class="page-content tab-content overflow-y">
        <div class="page-header">
            <h3>{{$item->title}}</h3>
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
                        <img src="{{$item->imageUrl()}}" width="100%">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="page-content" class="page-content tab-content overflow-y">
        <div class="page-header">
            <h3>@lang('app.pages')</h3>
        </div>
        <div class="row-fluid">
            @include('admin.table.page',['pages'=>$item->pages])
        </div>
    </div>
</div>

@endsection

