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

                    <!-- content -->
                    <div class="form-group">
                      <label>@lang('app.admin.content')</label>
                      <textarea name="content" class="form-control ckeditor" rows="3" placeholder="@lang('app.admin.content.desc')">{!!$item->content!!}</textarea>
                      <span class="help-block">@lang('app.admin.content.desc')</span>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <!-- year_built -->
                            <div class="form-group">
                                <label>@lang('app.admin.year_built')</label>
                                <select name="currency" class="form-control select2">
                                    @for($year=1990; $year<=date('Y'); $year++)
                                    <option {{$item->year_built==$year?'selected':''}} value="{{$year}}">{{$year}}</option>
                                   @endfor
                                </select>
                            </div>
                            <!-- is_new -->
                            <div class="form-group">
                                <label>@lang('app.admin.is_new')</label>
                                <div class="checkbox">
                                    <label>
                                        <input name="is_new" value="1" type="checkbox" class="minimal"  {{$item->is_new?'checked':''}} >
                                        @lang('app.admin.is_new')
                                    </label>
                                </div>
                            </div>
                        </div>
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
                    </div>
                
                    <div class="row">
                        <div class="col-md-6">
                            <!-- price -->
                            <div class="form-group">
                                <label>@lang('app.admin.price')</label>
                                <input name="price" value="{{$item->price}}" type="number" class="form-control" placeholder="@lang('app.admin.price')" >
                            </div>
                            <!-- currency -->
                            <div class="form-group">
                                <label>@lang('app.admin.currency')</label>
                                <select name="currency" class="form-control select2">
                                    <option {{$item->currency=='eur'?'selected':''}} value="eur">EUR</option>
                                    <option {{$item->currency=='usd'?'selected':''}} value="usd">USD</option>
                                </select>
                            </div>
                            <!-- tma -->
                            <div class="form-group">
                                <label>@lang('app.admin.tma')</label>
                                <input name="tma" value="{{$item->tma}}" type="number" class="form-control" placeholder="@lang('app.admin.tma')" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- display_address -->
                            <div class="form-group">
                                <label>@lang('app.admin.display_address')</label>
                                <input name="display_address" value="{{$item->display_address}}" type="text" class="form-control" placeholder="@lang('app.admin.display_address')" >
                            </div>
                            <!-- postalCode -->
                            <div class="form-group">
                                <label>@lang('app.admin.postalCode')</label>
                                <input name="postalCode" value="{{$item->postalCode}}" type="text" class="form-control" placeholder="@lang('app.admin.postalCode')" >
                            </div>
                            <!-- state_id -->
                            <div class="form-group">
                                <label>@lang('app.admin.state')</label>
                                <select name="state_id" class="form-control select2">
                                    @foreach($states as $state)
                                    <option {{$item->state_id==$state->id?'selected':''}} value="{{$state->id}}">{{$state->content}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- type_id -->
                            <div class="form-group">
                                <label>@lang('app.admin.type')</label>
                                <select name="type_id" class="form-control select2">
                                    @foreach($types as $type)
                                    <option {{$item->type_id==$type->id?'selected':''}} value="{{$type->id}}">{{$type->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- location_type_id -->
                            <div class="form-group">
                                <label>@lang('app.admin.location_type')</label>
                                <select name="location_type_id" class="form-control select2">
                                    @foreach($location_types as $type)
                                    <option {{$item->location_type_id==$type->id?'selected':''}} value="{{$type->id}}">{{$type->title}}</option>
                                    @endforeach
                                </select>
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
