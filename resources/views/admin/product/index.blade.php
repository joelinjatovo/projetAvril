@extends('layouts.lte')

@section('content')
<div class="row">
    <div class="col-md-12" style="margin-bottom: 5px;">
        <form action="{{route('admin.product.list')}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="product" value="{{$item->id}}">
            <div class="btn-group">
             @if($item->status=='pinged' || $item->status=='archived')
              <button type="button" class="btn btn-default btn-publish">@lang('app.btn.publish')</button>
              <button type="button" class="btn btn-default btn-trash">@lang('app.btn.trash')</button>
             @elseif($item->status=='trashed')
              <button type="button" class="btn btn-default btn-restore">@lang('app.btn.restore')</button>
              <button type="button" class="btn btn-danger btn-delete"><i class="fa fa-trash-o"></i></button>
             @endif
             @if($item->status=='published')
              <button type="button" class="btn btn-default btn-archive">@lang('app.btn.archive')</button>
              <button type="button" class="btn btn-warning btn-delete"><i class="fa fa-trash-o"></i></button>
             @endif
            </div>
        </form>
    </div>
    
    <div class="col-md-8">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
            <img class="img-responsive pad" src="{{$item->imageUrl()}}" alt="{{$item->title}}">
            <p>{!!$item->content!!}</p>
          
            <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
            </p>
        </div>
        <!-- /.box-body -->
      </div>
      
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">@lang('app.location')</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          @if($item->location)
          <strong><i class="fa fa-map-marker margin-r-5"></i> @lang('app.location')</strong>
          <p class="text-muted">
              {{$item->location->toString()}}
          </p>
          @endif
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <div class="col-md-4">
      <!-- Profile Image -->
      @include('admin/user/inc/profile-image', ['user'=>$item->seller])
    </div>
</div>
@endsection

