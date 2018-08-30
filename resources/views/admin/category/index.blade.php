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
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#products" data-toggle="tab">@lang('app.products')</a></li>
          <li><a href="#blogs" data-toggle="tab">@lang('app.blogs')</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="products">
            @include('admin.table.product',[
                'products'=>$item->products
            ])
          </div>
          <!-- /.tab-pane -->
          
          <div class="tab-pane" id="blogs">
            @include('admin.table.blog',[
                'blogs'=>$item->blogs
            ])
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
@endsection


