@extends('layouts.lte')

@section('style')
@parent
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('lte/plugins/iCheck/all.css')}}">
@endsection

@section('content')
<div class="row">
    <form role="form" method="post" action="{{$action}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <!-- title / content -->
                    <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>
                              <input name="type" type="hidden" value="page">
                              <input name="type" value="pub" class="minimal" type="checkbox" id="checkbox-pub" {{$item->type=="pub"?'checked':''}} > Cochez si c'est une publicité
                            </label>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                              <li class="active"><a href="#fr" data-toggle="tab">Français</a></li>
                              <li><a href="#en" data-toggle="tab">English</a></li>
                            </ul>
                            <div class="tab-content">
                              <div class="active tab-pane" id="fr">
                                    <!-- title input -->
                                    <div class="form-group common">
                                      <label>@lang('app.admin.title')</label>
                                      <input name="title" type="text" class="form-control" value="{{$item->title}}" placeholder="@lang('app.admin.title.desc')">
                                      <span class="help-block">@lang('app.admin.title.desc')</span>
                                    </div>

                                    <!-- content -->
                                    <div class="form-group common">
                                      <label>@lang('app.admin.content')</label>
                                      <textarea name="content" class="form-control ckeditor" rows="3" placeholder="@lang('app.admin.content.desc')">{!!$item->content!!}</textarea>
                                      <span class="help-block">@lang('app.admin.content.desc')</span>
                                    </div>

                                    <!-- pub_url input -->
                                    <div class="form-group pub-only">
                                      <label>@lang('app.admin.pub_url')</label>
                                      <input name="pub_url" type="url" class="form-control" value="{{$item->pub_url}}" placeholder="@lang('app.admin.pub_url.desc')">
                                      <span class="help-block">@lang('app.admin.pub_url.desc')</span>
                                    </div>

                                    <!-- fileupload -->
                                    <div class="fileupload fileupload-new pub-only" data-provides="fileupload">
                                        <div class="fileupload-preview thumbnail" style="width: 200px; height: 120px;">
                                            <img src="{{$item->imageUrl('fr')}}">
                                        </div>
                                        <div> 
                                        <span class="btn btn-file"> 
                                            <span class="fileupload-new">@lang('app.admin.file.select')</span> 
                                            <span class="fileupload-exists">@lang('app.admin.file.change')</span>
                                            <input type="file" name="pub_image" id="file">
                                        </span> 
                                        <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">@lang('app.admin.file.remove')</a> </div>
                                    </div>
                              </div>
                              <!-- /.tab-pane -->

                              <div class="tab-pane" id="en">
                                    <!-- title input -->
                                    <div class="form-group common">
                                      <label>@lang('app.admin.title') [english]</label>
                                      <input name="title_en" type="text" class="form-control" value="{{$item->title_en}}" placeholder="@lang('app.admin.title.desc')">
                                      <span class="help-block">@lang('app.admin.title.desc')</span>
                                    </div>

                                    <!-- content -->
                                    <div class="form-group common">
                                      <label>@lang('app.admin.content') [english]</label>
                                      <textarea name="content_en" class="form-control ckeditor" rows="3" placeholder="@lang('app.admin.content.desc')">{!!$item->content_en!!}</textarea>
                                      <span class="help-block">@lang('app.admin.content.desc')</span>
                                    </div>

                                    <!-- pub_url input -->
                                    <div class="form-group pub-only">
                                      <label>@lang('app.admin.pub_url') [english]</label>
                                      <input name="pub_url_en" type="url" class="form-control" value="{{$item->pub_url_en}}" placeholder="@lang('app.admin.pub_url.desc')">
                                      <span class="help-block">@lang('app.admin.pub_url.desc')</span>
                                    </div>

                                    <!-- fileupload -->
                                    <div class="fileupload fileupload-new pub-only" data-provides="fileupload">
                                        <div class="fileupload-preview thumbnail" style="width: 200px; height: 120px;">
                                            <img src="{{$item->imageUrl('en')}}">
                                        </div>
                                        <div> 
                                        <span class="btn btn-file"> 
                                            <span class="fileupload-new">@lang('app.admin.file.select')</span> 
                                            <span class="fileupload-exists">@lang('app.admin.file.change')</span>
                                            <input type="file" name="pub_image_en" id="file">
                                        </span> 
                                        <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">@lang('app.admin.file.remove')</a> </div>
                                    </div>
                              </div>
                              <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                          </div>
                          <!-- /.nav-tabs-custom -->
                        </div>
                    </div>
                    
                    <!-- path input -->
                    <div class="form-group common">
                      <label>@lang('app.admin.page_order')</label>
                      <input name="page_order" type="text" class="form-control" value="{{$item->page_order}}" placeholder="@lang('app.admin.page_order.desc')">
                      <span class="help-block">@lang('app.admin.page_order.desc')</span>
                    </div>
                    
                    <!-- path input -->
                    <div class="form-group page-only">
                      <label>@lang('app.admin.path')</label>
                      <input name="path" type="text" class="form-control" value="{{$item->path}}" placeholder="@lang('app.admin.path.desc')">
                      <span class="help-block">@lang('app.admin.path.desc')</span>
                    </div>
                    
                    <!-- parent input -->
                    <div class="form-group common">
                      <label>@lang('app.select_one')</label>
                      <select name="parent_id" class="form-control select2" >
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


@section('script')
@parent
<!-- CK Editor -->
<script src="{{asset('lte/plugins/ckeditor/ckeditor.js')}}"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('ckeditor')
  })
</script>

<!-- iCheck 1.0.1 -->
<script src="{{asset('lte/plugins/iCheck/icheck.min.js')}}"></script>
<script>
  $(function () {
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
    
    if($("#checkbox-pub").is(':checked')){
        $(".pub-only").show();
        $(".page-only").hide();
    }else{
        $(".pub-only").hide();
        $(".page-only").show();
    }
      
    $("#checkbox-pub").on('ifChecked', function(event){ 
        $(".pub-only").show();
        $(".page-only").hide();
    });
      
    $("#checkbox-pub").on('ifUnchecked', function(event){ 
        $(".pub-only").hide();
        $(".page-only").show();
    });
      
  })
</script>
@endsection