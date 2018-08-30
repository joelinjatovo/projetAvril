@extends('layouts.lte')

@section('content')
<div class="row">
    <form role="form" method="post" action="{{$action}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <!-- title / content -->
                    <div class="row">
                        <div class="col-md-6">
                            <!-- title input -->
                            <div class="form-group">
                              <label>@lang('app.admin.title')</label>
                              <input name="title" type="text" class="form-control" value="{{$item->title}}" placeholder="@lang('app.admin.title.desc')">
                              <span class="help-block">@lang('app.admin.title.desc')</span>
                            </div>
                            <!-- content -->
                            <div class="form-group">
                              <label>@lang('app.admin.content')</label>
                              <textarea name="content" class="form-control" rows="3" placeholder="@lang('app.admin.content.desc')">{!!$item->content!!}</textarea>
                              <span class="help-block">@lang('app.admin.content.desc')</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- title input -->
                            <div class="form-group">
                              <label>@lang('app.admin.title')</label>
                              <input name="title_en" type="text" class="form-control" value="{{$item->title_en}}" placeholder="@lang('app.admin.title.desc')">
                              <span class="help-block">@lang('app.admin.title.desc')</span>
                            </div>
                            <!-- content -->
                            <div class="form-group">
                              <label>@lang('app.admin.content')</label>
                              <textarea name="content_en" class="form-control" rows="3" placeholder="@lang('app.admin.content.desc')">{!!$item->content_en!!}</textarea>
                              <span class="help-block">@lang('app.admin.content.desc')</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- title / content -->
                    <div class="row">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                    
                    <!-- path input -->
                    <div class="form-group">
                      <label>@lang('app.admin.page_order')</label>
                      <input name="page_order" type="text" class="form-control" value="{{$item->page_order}}" placeholder="@lang('app.admin.page_order.desc')">
                      <span class="help-block">@lang('app.admin.page_order.desc')</span>
                    </div>
                    
                    <!-- path input -->
                    <div class="form-group">
                      <label>@lang('app.admin.path')</label>
                      <input name="path" type="text" class="form-control" value="{{$item->path}}" placeholder="@lang('app.admin.path.desc')">
                      <span class="help-block">@lang('app.admin.path.desc')</span>
                    </div>
                    
                    <!-- parent input -->
                    <div class="form-group">
                      <label>@lang('app.select_one')</label>
                      <select name="parent_id" class="form-control" >
                            <option value="0">@lang('app.select_one')</option>
                            @foreach($pages as $page)
                                <option value="{{$page->id}}" {{$page->id==$item->parent_id?'selected':''}}>{{$page->title}} ({{$page->path}})</option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <div class="pull-right">
                      <button type="submit" class="btn btn-info" name="method" value="draft"><i class="fa fa-database"></i> @lang('app.btn.save')</button>
                  </div>
                  <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> @lang('app.btn.discard')</button>
                </div>
                <!-- /.box-footer -->
              </div>
        </div>
    </form>
</div>
@endsection
