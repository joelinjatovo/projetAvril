@extends('layouts.admin-mail')

@section('mailbox')
@include('includes.alerts')
<form action="{{route('admin.mail.compose')}}" method="post">
    {{ csrf_field() }}
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Compose New Message</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            <select id="role" name="role" class="form-control">
                <option {{old('role')&&old('role')=='0'?'selected':''}} value="0">@lang('app.select_role')</option>
                <option {{old('role')&&old('role')=='admin'?'selected':''}} value="admin">Admin</option>
                <option {{old('role')&&old('role')=='apl'?'selected':''}} value="apl">APL</option>
                <option {{old('role')&&old('role')=='afa'?'selected':''}} value="afa">AFA</option>
                <option {{old('role')&&old('role')=='member'?'selected':''}} value="member">Member</option>
                <option {{old('role')&&old('role')=='seller'?'selected':''}} value="seller">Seller</option>
            </select>
          </div>
          <div class="form-group">
            <select id="users" name="users[]" class="form-control" multiple>
                <option value="0">@lang('app.select_user')</option>
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group">
            <input class="form-control" name="subject" type="text" placeholder="@lang('app.subject') *" aria-required="true" required="required" value="{{old('subject')?old('subject'):$item->subject}}">
          </div>
          <div class="form-group">
            <textarea name="content" id="compose-textarea" class="form-control" style="height: 300px">{{old('content')?old('content'):$item->content}}</textarea>
          </div>
          <div class="form-group">
            <div class="btn btn-default btn-file">
              <i class="fa fa-paperclip"></i> Attachment
              <input type="file" name="attachment">
            </div>
            <p class="help-block">Max. 32MB</p>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <div class="pull-right">
              <button type="submit" class="btn btn-default" name="method" value="draft"><i class="fa fa-pencil"></i> @lang('app.btn.draft')</button>
              <button type="submit" class="btn btn-default" name="method" value="model"><i class="fa fa-tag"></i> @lang('app.btn.save_as_model')</button>
              <button type="submit" class="btn btn-info" name="method" value="send"><i class="fa fa-envelope-o"></i> @lang('app.btn.send')</button>
          </div>
          <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
        </div>
        <!-- /.box-footer -->
    </div>
    <!-- /. box -->
</form>
@endsection
