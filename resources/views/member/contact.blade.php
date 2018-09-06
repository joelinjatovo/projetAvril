@extends('layouts.lte')

@section('content')
<div class="row">
    <div class="col-md-12">
        <form action="{{$action}}" method="post" id="commentform" class="contact-form" >
            {{ csrf_field() }}
            @component('components.box', ['button'=>true, 'class'=>'box-primary'])
             
              <!-- title input -->
              <div class="form-group common">
                  <label>@lang('app.subject')</label>
                  <input name="subject" type="text" class="form-control" placeholder="Sujet *" aria-required="true" required="required" value="{{old('subject')}}">
              </div>
              <!-- content -->
              <div class="form-group common">
                  <label>@lang('app.message')</label>
                  <textarea name="content" class="form-control ckeditor" rows="10" placeholder="@lang('app.message.desc')">{!!old('content')!!}</textarea>
                  <span class="help-block">@lang('app.message.desc')</span>
              </div>
              <div class="form-group form-group-default">
                <label>@lang('app.attachments') (jpg, jpeg, png, gif, pdf: Max: 2MB)</label>
                <input type="file" name="files[]" accept="file_extension|image/*|media_type" multiple>
              </div>

              @slot('footer')
                  <div class="pull-right">
                      <button type="submit" class="btn btn-info" name="method" value="draft"><i class="fa fa-database"></i> @lang('app.btn.save')</button>
                  </div>
                  <button type="reset" class="btn btn-default pull-left"><i class="fa fa-times"></i> @lang('app.btn.discard')</button>
              @endslot
            @endcomponent
        </form>
    </div>
</div>
@endsection
