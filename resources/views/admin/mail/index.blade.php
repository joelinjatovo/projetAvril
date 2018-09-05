@extends('layouts.admin-mail')

@section('mailbox')
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Message de {{$item->sender->name}}</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <p>{{$item->content}}</p>
    </div>
    <!-- /.box-body -->
</div>
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">@lang('app.receivers')</h3>
    </div>
    <!-- /.box-header -->
    
    <div class="box-body">
        @include('admin.table.user',['users'=>$item->users])
    </div>
    <!-- /.box-body -->
</div>
@endsection

@section('script')
@parent
@include('admin.inc.sweetalert-user')
@endsection