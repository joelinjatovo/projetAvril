@extends('layouts.lte')

@section('content')
<div class="row">
    <form role="form" method="post" action="{{$action}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <!-- login input -->
                    <div class="form-group common">
                      <label>@lang('app.form.login')</label>
                      <input name="name" type="text" class="form-control" value="{{$item->name}}" placeholder="@lang('app.form.login')" disabled>
                    </div>
                    <!-- email input -->
                    <div class="form-group common">
                      <label>@lang('app.form.login')</label>
                      <input name="email" type="email" class="form-control" value="{{$item->email}}" placeholder="@lang('app.form.email')">
                    </div>
                    <!-- language input -->
                    <div class="form-group common">
                      <label>@lang('app.form.language')</label>
                      <select name="language" class="form-control" id="language">
                        <option value="fr" {{$item->language=='fr'?'selected':''}}>Français</option>
                        <option value="en" {{$item->language=='en'?'selected':''}}>English</option>
                      </select>
                    </div>
                    <!-- first_name input -->
                    <div class="form-group common">
                      <label>@lang('app.form.first_name')</label>
                      <input name="first_name" type="text" class="form-control" value="{{old('first_name', $item->meta('first_name', ''))}}" placeholder="@lang('app.form.first_name')">
                    </div>
                    <!-- last_name input -->
                    <div class="form-group common">
                      <label>@lang('app.form.last_name')</label>
                      <input name="last_name" type="text" class="form-control" value="{{old('last_name', $item->meta('last_name', ''))}}" placeholder="@lang('app.form.last_name')">
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

