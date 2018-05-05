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
                        </div>
                    </div>
                    <!-- // Widget -->
                    
                    <div class="widget widget-simple">
                        <div class="widget-header">
                            <h4><small>@lang('app.products')</small></h4>
                        </div>
                        @include('admin.table.product',['products'=>$item->products])
                    </div>
                    <!-- // Widget -->
                    
                    <div class="widget widget-simple">
                        <div class="widget-header">
                            <h4><small>@lang('app.blogs')</small></h4>
                        </div>
                        @include('admin.table.blog',['blogs'=>$item->blogs])
                    </div>
                    <!-- // Widget -->
                    
                    <div class="widget widget-simple">
                        <div class="widget-header">
                            <h4><small>@lang('app.subproducts')</small></h4>
                        </div>
                        @include('admin.table.product',['products'=>$item->subProducts])
                    </div>
                    <!-- // Widget -->
                    
                </div>
                <!-- // Column -->
            </div>
        </div>
    </div>
</div>

@endsection

