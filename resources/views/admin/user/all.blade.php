@extends('layouts.lte')

@section('content')
    @if(count($items)>0)
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="row">
                  <div class="col-md-12 pull-right">
                    <form method="get" action="">
                        <div class="input-group input-group-sm">
                          <div class="col-md-2 input-group-sm pull-right" style="padding-right: 0; padding-left: 0;">
                              <input type="text" name="q" class="form-control pull-right" placeholder="@lang('app.search')" value="{{$q}}">
                          </div>
                          <div class="col-md-2 input-group-sm pull-right" style="padding-right: 0; padding-left: 0;">
                              <input class="form-control" type="number" name="record" min="10" value="{{$record}}" placeholder="Nombre par page">
                          </div>
                          <div class="col-md-2 input-group-sm pull-right" style="padding-right: 0; padding-left: 0;">
                            <select class="form-control" name="role">
                                <option value="">@lang('app.select_role')</option>
                                <option value="admin" {{$role=='admin'?'selected':''}}>@lang('app.admin')</option>
                                <option value="apl" {{$role=='apl'?'selected':''}}>@lang('app.apl')</option>
                                <option value="afa" {{$role=='afa'?'selected':''}}>@lang('app.afa')</option>
                                <option value="member" {{$role=='member'?'selected':''}}>@lang('app.member')</option>
                            </select>
                          </div>
                          <div class="col-md-2 input-group-sm pull-right" style="padding-right: 0; padding-left: 0;">
                            <select class="form-control" name="country">
                                <option value="">@lang('app.select_country')</option>
                                @foreach($countries as $c)
                                <option value="{{$c->id}}" {{$c->id==$country?'selected':''}}>{{$c->content}}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="col-md-2 input-group-sm pull-right" style="padding-right: 0; padding-left: 0;">
                             <select class="form-control" name="state">
                                <option value="">@lang('app.select_state')</option>
                                @foreach($states as $stateItem)
                                <option value="{{$stateItem->id}}" {{$stateItem->id==$state?'selected':''}}>{{$stateItem->content}}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                          </div>
                        </div>
                    </form>
                  </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              @include('admin.table.user', ['users'=>$items])
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              {{$items->links()}}
            </div>
          </div>
          <!-- /.box -->
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-xs-12">
            <div class="callout callout-info">
              <h4>@lang('app.empty')</h4>
            </div>
        </div>
    </div>
    @endif
@endsection

@section('script')
@parent
<!-- SweetAlert -->
<script src="{{asset('lte/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script>
  $(function () {
      
      $('.btn-delete').click(function(e){
        e.preventDefault;
        var $this = $(this);
        swal({
          title: "@lang('alert.are_you_sure')",
          text: "@lang('alert.delete_content')",
          icon: "warning",
          buttons: ["@lang('app.btn.cancel')", "@lang('app.btn.delete')"],
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
              ajax($this);
          }
        });
      })
      
      $('.btn-status').click(function(e){
        e.preventDefault;
        var $this = $(this);
          
        var action = $this.attr('data-action');
        var text = '';
        var txtBtn = true;
          
        if(action == 'disable'){
            text = "@lang('alert.disable_content')";
            txtBtn = "@lang('app.btn.disable')";
        }else{
            text = "@lang('alert.active_content')";
            txtBtn = "@lang('app.btn.active')";
        }
          
        swal({
          title: "@lang('alert.are_you_sure')",
          text: text,
          icon: "warning",
          buttons: ["@lang('app.btn.cancel')", txtBtn],
        })
        .then((willDelete) => {
          if (willDelete) { 
              ajax($this);
          }
        });
      })
      
      function ajax($this, url, id, action){
        var id = $this.attr('data-id');
        var url = $this.attr('data-href');
        var action = $this.attr('data-action');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: 'POST',
            dataType: 'json',
            data: {data_id: id, action: action},
            beforeSend: function( xhr ) {
                $('#mute').addClass('on');
            }
        }).done(function(data){
            $('#mute').removeClass('on');
            if(data.status==1){
                swal(data.message, {
                  icon: "success",
                });
                
                if(action=='delete'){
                    $('.data-item-'+id).remove();
                }else if(action=='disable'){
                    $this.attr('data-action', 'active');
                    $this.html("@lang('app.btn.active')");
                    $('.data-item-status-'+id).html('<span class="label label-warning">désactivé</span>');
                }else if(action=='active'){
                    $this.attr('data-action', 'disable');
                    $this.html("@lang('app.btn.disable')");
                    $('.data-item-status-'+id).html('<span class="label label-success">activé</span>');
                }
            }else{
                swal(data.message, {
                  icon: "error",
                  dangerMode: true,
                });
            }
        }).fail(function(error) {
            $('#mute').removeClass('on');
            swal("@lang('alert.error')",{ icon: "error", dangerMode: true, });
        });
      }
  })
</script>
@endsection

