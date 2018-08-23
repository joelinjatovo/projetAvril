@extends('layouts.lte')

@section('content')
<div class="row">
    <div class="col-md-12">
        <form method="post" action="{{route('config.social.update')}}">
            {{csrf_field()}}
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">@lang('app.social_network')</h3>
                  <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body">
                    @foreach($titles as $key=>$value)
                    <!-- text input -->
                    <div class="form-group">
                      <label>{{$value}}</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-{{$key}}"></i></span>
                        <input name="{{$key}}" type="text" class="form-control" value="{{old($key,$item->meta($key, ''))}}" placeholder="https://www.{{$key}}.com">
                      </div>
                    </div>
                    @endforeach
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