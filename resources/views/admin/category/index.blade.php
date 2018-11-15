@extends('layouts.lte')

@section('content')
<div class="row">
    <div class="col-md-4">
      <div class="box box-widget widget-user">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-aqua-active">
          <h3 class="widget-user-username">{{$item->title}}</h3>
          <h5 class="widget-user-desc">{!!$item->content!!}</h5>
        </div>
        <div class="box-footer">
          <div class="row">
            <div class="col-sm-6 border-right">
              <div class="description-block">
                <h5 class="description-header">{{$item->products()->count()}}</h5>
                <span class="description-text">@lang('app.products')</span>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-6 border-right">
              <div class="description-block">
                <h5 class="description-header">{{$item->blogs()->count()}}</h5>
                <span class="description-text">@lang('app.blogs')</span>
              </div>
              <!-- /.description-block -->
            </div>
          </div>
          <!-- /.row -->
        </div>
      </div>
    </div>
    <div class="col-md-8">
       
        @if($item->type=='blog')
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">@lang('app.blogs')</h3>
            </div>
            <div class="box-body">
              <table class="table table-striped table-hover items-list">
                <thead>
                    <tr>
                        <th scope="col">@lang('app.table.blogs') <span class="column-sorter"></span></th>
                        <th scope="col">@lang('app.table.comment') <span class="column-sorter"></span></th>
                        <th scope="col">@lang('app.table.meta_tag') <span class="column-sorter"></span></th>
                        <th scope="col">@lang('app.table.meta_desc') <span class="column-sorter"></span></th>
                        <th scope="col">@lang('app.table.status') <span class="column-sorter"></span></th>
                        <th scope="col">@lang('app.table.date') <span class="column-sorter"></span></th>
                        <th scope="col" width="200px" class="text-right">@lang('app.table.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($item->blogs)>0)
                        @each('admin.blog.tr', $item->blogs, 'blog')
                    @else
                        @include('admin.tr-empty', ['col'=>6])
                    @endif
                </tbody>
              </table>
            </div>
        </div>
        @endif
        
        @if($item->type=='product')
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">@lang('app.products')</h3>
            </div>
            <div class="box-body">
               <table class="table table-striped table-hover items-list">
                    <thead>
                        <tr>
                             <th scope="col">@lang('app.table.products') <span class="column-sorter"></span></th>
                             <th scope="col">@lang('app.table.date') <span class="column-sorter"></span></th>
                             <th scope="col">@lang('app.table.status') <span class="column-sorter"></span></th>
                             <th scope="col">@lang('app.table.seller') <span class="column-sorter"></span></th>
                             <th scope="col">@lang('app.table.author') <span class="column-sorter"></span></th>
                             <th scope="col" class="pull-right text-right" width="150px">@lang('app.table.actions') </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($item->products)>0)
                            @each('admin.product.tr', $item->products, 'product')
                        @else
                            @include('admin.tr-empty', ['col'=>6])
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        @endif
         
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
@endsection

@section('script')
@parent

@if($item->type=='blog')
@include('admin.inc.sweetalert-blog')
@endif

@if($item->type=='product')
@include('admin.inc.sweetalert-product')
@endif

@endsection


