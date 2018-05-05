@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <!-- // page head -->
    <div id="page-content" class="page-content tab-content overflow-y">
        <div id="TabTop1" class="tab-pane padding-bottom30 active fade in">
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
                    <!-- // Widget -->
                    
                    <div class="widget widget-simple">
                        <div class="widget-header">
                            <h4><small>@lang('app.pages')</small></h4>
                        </div>
                        @include('admin.table.page',['pages'=>$item->pages])
                    </div>
                    <!-- // Widget -->
                    
                </div>
                <!-- // Column -->
            </div>
        </div>
    </div>
</div>

@endsection

