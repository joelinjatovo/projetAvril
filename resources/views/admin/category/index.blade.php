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
                @include('admin.table.blog',[
                    'blogs'=>$item->blogs
                ])
            </div>
        </div>
        @endif
        
        @if($item->type=='product')
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">@lang('app.products')</h3>
            </div>
            <div class="box-body">
                @include('admin.table.product',[
                    'products'=>$item->products
                ])
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


