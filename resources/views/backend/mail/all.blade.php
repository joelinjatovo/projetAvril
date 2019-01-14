@extends('layouts.admin-mail')

@section('mailbox')
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Inbox</h3>

      <div class="box-tools pull-right">
        <div class="has-feedback">
          <input type="text" class="form-control input-sm" placeholder="Search Mail">
          <span class="glyphicon glyphicon-search form-control-feedback"></span>
        </div>
      </div>
      <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
      <div class="table-responsive mailbox-messages">
        <table class="table table-hover table-striped items-list">
          <tbody>
          @forelse($items as $item)
          <tr class="data-item-{{$item->id}} item">
            <td class="mailbox-subject">
                <b>{{$item->subject}}</b> <br> {{$item->excerpt(20)}}
            </td>
            <td class="mailbox-star"><a href="#" class="btn-star"
                      data-action="star" 
                      data-id="{{$item->id}}" 
                      data-href="{{route(Auth::user()->role.'.mail.list')}}"><i class="fa {{$item->pivot&&$item->pivot->starred?'fa-star':'fa-star-o'}} text-yellow"></i></a></td>
            <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
            <td class="mailbox-date">{{$item->created_at->diffForHumans()}}</td>
            <td>
             @if($item->sender)
                 <a  href="{{route('admin.user.show', $item->sender)}}">
                  <div class="item-img">
                    <img class="img-circle" src="{{$item->sender->imageUrl()}}" alt="sender Image">
                  </div>
                  <div class="item-info">
                    <span class="item-title">
                        {{$item->sender->name}}
                        @if($item->sender->isOnline())
                        <span class="badge badge-warning pull-right" style="background-color:green;">&nbsp;</span>
                        @endif
                    </span>
                    <span class="item-description">
                      {{$item->sender->email}}
                    </span>
                  </div>
                 </a>
             @endif
            </td>
            <td>
               <div class="btn-group">
                <a href="{{route(Auth::user()->role.'.mail.index', $item)}}"  class="btn btn-default"><i class="fa fa-eye"></i> @lang('app.btn.view')</a>
                
                @if(Auth::user()->isAdmin())
                    <a href="{{route('admin.mail.compose', $item)}}"  class="btn btn-default"><i class="fa fa-send"></i> @lang('app.btn.resend')</a>
                @else
                @endif
                
                <a href="#" class="btn btn-small btn-danger btn-delete"
                      data-action="delete" 
                      data-id="{{$item->id}}" 
                      data-href="{{route(Auth::user()->role.'.mail.list')}}"><i class="fa fa-trash-o"></i></a>
               </div>
            </td>
          </tr>
          @empty
              @include('backend.table.tr-empty', ['col'=>6])
          @endforelse
          </tbody>
        </table>
        <!-- /.table -->
      </div>
      <!-- /.mail-box-messages -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer no-padding">
    </div>
  </div>
  <!-- /. box -->
@endsection

@section('script')
@parent()
@include('admin.inc.sweetalert-mail')
@endsection
