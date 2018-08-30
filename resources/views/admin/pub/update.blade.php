@extends('layouts.lte')

@section('style')
@parent
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('lte/plugins/iCheck/all.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('lte/plugins/select2/dist/css/select2.min.css')}}">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <form role="form" method="post" action="{{$action}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="box box-primary">
                <div class="box-body">
                    <!-- title input -->
                    <div class="form-group">
                      <label>@lang('app.admin.title')</label>
                      <input name="title" type="text" class="form-control" value="{{$item->title}}" placeholder="@lang('app.admin.title.desc')">
                      <span class="help-block">@lang('app.admin.title.desc')</span>
                    </div>
                    
                    <!-- link input -->
                    <div class="form-group">
                      <label>@lang('app.admin.link')</label>
                      <input name="link" type="url" class="form-control" value="{{$item->links}}" placeholder="@lang('app.admin.link.desc')">
                      <span class="help-block">@lang('app.admin.link.desc')</span>
                    </div>

                    <!-- content -->
                    <div class="form-group">
                      <label>@lang('app.admin.content')</label>
                      <textarea name="content" class="form-control" rows="3" placeholder="@lang('app.admin.content.desc')">{!!$item->content!!}</textarea>
                      <span class="help-block">@lang('app.admin.content.desc')</span>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <!-- fileupload -->
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-preview thumbnail" style="width: 200px; height: 120px;">
                                    <img src="{{$item->imageUrl()}}">
                                </div>
                                <div> 
                                <span class="btn btn-file"> 
                                    <span class="fileupload-new">@lang('app.admin.file.select')</span> 
                                    <span class="fileupload-exists">@lang('app.admin.file.change')</span>
                                    <input type="file" name="image" id="file">
                                </span> 
                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">@lang('app.admin.file.remove')</a> </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- page -->
                            <div class="form-group">
                                <label>@lang('app.admin.page')</label>
                                @foreach($pages as $page)
                                <div class="checkbox">
                                    <label>
                                        <input name="page[]" value="{{$page->id}}" type="checkbox" class="minimal"  {{in_array($page->id, $pageIds)?'checked':''}} >
                                        {{$page->title}}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
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
        </form>
    </div>
</div>
@endsection

@section('script')
@parent
    
<!-- iCheck 1.0.1 -->
<script src="{{asset('lte/plugins/iCheck/icheck.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('lte/plugins/select2/dist/js/select2.full.min.js')}}"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
  })
</script>
@endsection
