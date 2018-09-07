@extends('layouts.admin-mail')

@section('mailbox')
<form action="{{$action}}" method="post">
    {{ csrf_field() }}
    @component('components.box', ['button'=>true, 'class'=>'box-primary'])
      <div class="form-group">
        <input class="form-control" name="subject" type="text" placeholder="@lang('app.subject') *" aria-required="true" required="required" value="{{old('subject',$mail->subject)}}">
      </div>
      <div class="form-group">
        <textarea name="content" id="compose-textarea" class="form-control" style="height: 300px">{{old('content',$mail->content)}}</textarea>
      </div>
      <div class="form-group">
        <div class="btn btn-default btn-file">
          <i class="fa fa-paperclip"></i> Attachment
          <input type="file" name="attachment">
        </div>
        <p class="help-block">Max. 32MB</p>
      </div>

      @slot('footer')
      <div class="pull-right">
          <button type="submit" class="btn btn-default" name="method" value="draft"><i class="fa fa-pencil"></i> @lang('app.btn.draft')</button>
          <button type="submit" class="btn btn-default" name="method" value="model"><i class="fa fa-tag"></i> @lang('app.btn.save_as_model')</button>
          <button type="submit" class="btn btn-info" name="method" value="send"><i class="fa fa-envelope-o"></i> @lang('app.btn.send')</button>
      </div>
      <button type="reset" class="btn btn-default pull-left"><i class="fa fa-times"></i> @lang('app.btn.discard')</button>
      @endslot
    @endcomponent
        
</form>
@endsection
