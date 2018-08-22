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
              @include('admin.table.order', ['orders'=>$items])
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
