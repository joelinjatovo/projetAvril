@extends('layouts.lte')

@section('content')
<div class="row">
    <div class="col-md-6">
      <img class="img-responsive " src="{{$item->imageUrl()}}">
    </div>
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
    <div class="col-md-12 pad">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">@lang('app.pages')</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @include('admin.table.page',['pages'=>$item->pages, 'pub'=>$item])
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection

