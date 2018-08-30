@extends('layouts.lte')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{$item->title}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <p class="text-muted">{!!$item->content!!}</p>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{$item->title_en}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <p class="text-muted">{!!$item->content_en!!}</p>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#childs" data-toggle="tab">@lang('app.childs')</a></li>
          <li><a href="#pubs" data-toggle="tab">@lang('app.pubs')</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="childs">
            @include('admin.table.page',[
                'pages'=>$item->childs
            ])
          </div>
          <!-- /.tab-pane -->
          
          <div class="tab-pane" id="pubs">
            @include('admin.table.pub',[
                'pubs'=>$item->pubs, 
                'page'=>$item
            ])
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
</div>
@endsection

