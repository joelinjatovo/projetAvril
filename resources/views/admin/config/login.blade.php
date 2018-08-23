@extends('layouts.lte')

@section('content')
<div class="row">
    <form method="post" action="{{route('config.login.update')}}">
        {{csrf_field()}}
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Français</h3>
                  <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body">
                    <!-- title input -->
                    <div class="form-group">
                      <label>@lang('app.admin.title')</label>
                      <input name="title[fr]" type="text" class="form-control" value="{{old('title.fr',$item->get_meta_array('title', 'fr', ''))}}">
                    </div>
                    <!-- content -->
                    <div class="form-group">
                      <label>@lang('app.admin.content')</label>
                      <textarea name="content[fr]" class="form-control" rows="3" placeholder="@lang('app.admin.content.desc')">{!!old('content.fr',$item->get_meta_array('content', 'fr', ''))!!}</textarea>
                      <span class="help-block">@lang('app.admin.content.desc')</span>
                    </div>
                    <!-- address -->
                    <div class="form-group">
                      <label>@lang('app.admin.address')</label>
                      <textarea name="address[fr]" class="form-control" rows="3" placeholder="@lang('app.admin.address.desc')">{!!old('address.fr',$item->get_meta_array('address', 'fr', ''))!!}</textarea>
                      <span class="help-block">@lang('app.admin.address.desc')</span>
                    </div>
                    <!-- contact -->
                    <div class="form-group">
                      <label>@lang('app.admin.contact')</label>
                      <textarea name="contact[fr]" class="form-control" rows="3" placeholder="@lang('app.admin.contact.desc')">{!!old('contact.fr',$item->get_meta_array('contact', 'fr', ''))!!}</textarea>
                      <span class="help-block">@lang('app.admin.contact.desc')</span>
                    </div>
                </div>
                <!-- /.box-body -->
           </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">English</h3>
                  <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body">
                    <!-- title input -->
                    <div class="form-group">
                      <label>@lang('app.admin.title')</label>
                      <input name="title[en]" type="text" class="form-control" value="{{old('title.en',$item->get_meta_array('title', 'en', ''))}}">
                    </div>
                    <!-- content -->
                    <div class="form-group">
                      <label>@lang('app.admin.content')</label>
                      <textarea name="content[en]" class="form-control" rows="3" placeholder="@lang('app.admin.content.desc')">{!!old('content.en',$item->get_meta_array('content', 'en', ''))!!}</textarea>
                      <span class="help-block">@lang('app.admin.content.desc')</span>
                    </div>
                    <!-- address -->
                    <div class="form-group">
                      <label>@lang('app.admin.address')</label>
                      <textarea name="address[en]" class="form-control" rows="3" placeholder="@lang('app.admin.address.desc')">{!!old('address.en',$item->get_meta_array('address', 'en', ''))!!}</textarea>
                      <span class="help-block">@lang('app.admin.address.desc')</span>
                    </div>
                    <!-- contact -->
                    <div class="form-group">
                      <label>@lang('app.admin.contact')</label>
                      <textarea name="contact[en]" class="form-control" rows="3" placeholder="@lang('app.admin.contact.desc')">{!!old('contact.en',$item->get_meta_array('contact', 'en', ''))!!}</textarea>
                      <span class="help-block">@lang('app.admin.contact.desc')</span>
                    </div>
                </div>
                <!-- /.box-body -->
           </div>
        </div>
        <div class="col-md-12">
            <div class="pull-right">
              <button type="submit" class="btn btn-info" name="method" value="draft"><i class="fa fa-database"></i> @lang('app.btn.save')</button>
          </div>
          <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> @lang('app.btn.discard')</button>
        </div>
    </form>
</div>
@endsection