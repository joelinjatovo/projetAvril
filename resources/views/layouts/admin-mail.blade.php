@extends('layouts.lte')

@section('content')
<div class="row">
        <div class="col-md-3">
         
          @if(Auth::user()->isAdmin())
              <a href="{{route('admin.mail.compose')}}" class="btn btn-primary btn-block margin-bottom">Compose</a>
          @endif
         
          @if(Auth::user()->hasRole('member'))
              <a href="{{route('member.contact')}}" class="btn btn-primary btn-block margin-bottom">Contacter mon APL</a>
          @endif

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Boîte email</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li>
                   <a class="{{Request::is('*/mails/inbox')?'active':''}}" href="{{route(Auth::user()->role.'.mail.list',['filter'=>'inbox'])}}"><i class="fa fa-inbox"></i>@lang('app.admin.mail.inbox')
                   <!--<span class="label label-primary pull-right">12</span>-->
                   </a>
                </li>
                <li>
                    <a class="{{Request::is('*/mails/outbox')?'active':''}}" href="{{route(Auth::user()->role.'.mail.list',['filter'=>'outbox'])}}"><i class="fa fa-envelope-o"></i>@lang('app.admin.mail.outbox')</a>
                </li>
                <li>
                    <a class="{{Request::is('*/mails/draft')?'active':''}}" href="{{route(Auth::user()->role.'.mail.list',['filter'=>'draft'])}}"><i class="fa fa-file-text-o"></i>@lang('app.admin.mail.draft')</a>
                </li>
                <li>
                    <a class="{{Request::is('*/mails/spam')?'active':''}}" href="{{route(Auth::user()->role.'.mail.list',['filter'=>'spam'])}}"><i class="fa fa-filter"></i>@lang('app.admin.mail.spam') 
                    <!--<span class="label label-warning pull-right">65</span>-->
                    </a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Labels</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a class="{{Request::is('*/mails/model')?'active':''}}" href="{{route(Auth::user()->role.'.mail.list',['filter'=>'model'])}}"><i class="fa fa-tag"></i>@lang('app.admin.mail.model')</a></li>
                <li><a class="{{Request::is('*/mails/trash')?'active':''}}" href="{{route(Auth::user()->role.'.mail.list',['filter'=>'trash'])}}"><i class="fa fa-trash-o"></i>@lang('app.admin.mail.trash')</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          @yield('mailbox')
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
@endsection