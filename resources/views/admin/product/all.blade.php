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
                            <select class="form-control" name="category">
                                <option value="0">@lang('app.select_category')</option>
                                @foreach($categories as $cat)
                                    <option {{$category==$cat->id?'selected':''}} value="{{$cat->id}}">{{$cat->title}} ({{$cat->products_count}})</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="col-md-2 input-group-sm pull-right" style="padding-right: 0; padding-left: 0;">
                            <select class="form-control" name="seller">
                                <option value="">@lang('app.select_seller')</option>
                                @foreach($sellers as $sellerItem)
                                <option value="{{$sellerItem->id}}" {{$sellerItem->id==$seller?'selected':''}}>{{$sellerItem->name}}</option>
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
              @include('admin.table.product', ['products'=>$items])
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
        e.preventDefault();
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
        e.preventDefault();
        var $this = $(this);
          
        var action = $this.attr('data-action');
        var text = '';
        var txtBtn = true;
          
        if(action == 'publish'){
            text = "@lang('alert.publish_content')";
            txtBtn = "@lang('app.btn.publish')";
        }else{
            text = "@lang('alert.archive_content')";
            txtBtn = "@lang('app.btn.archive')";
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
                }else if(action=='archive'){
                    $this.attr('data-action', 'publish');
                    $this.html("@lang('app.btn.publish')");
                    $('.data-item-status-'+id).html('<span class="label label-warning">archivé</span>');
                }else if(action=='publish'){
                    $this.attr('data-action', 'archive');
                    $this.html("@lang('app.btn.archive')");
                    $('.data-item-status-'+id).html('<span class="label label-success">publié</span>');
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