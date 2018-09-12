@extends('layouts.lte')

@section('content')
<div class="row">
    <div class="col-md-4">
        @if($item->id>0)
        <a href="{{route('admin.postalcode.create')}}" class="btn btn-primary btn-block margin-bottom">@lang('app.admin.postalcode.create')</a>
        @endif
        <form role="form" method="post" action="{{$action}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="box box-primary">
                <div class="box-header with-border">
                  @if($item->id>0)
                  <h3 class="box-title">@lang('app.admin.postalcode.update')</h3>
                  @else
                  <h3 class="box-title">@lang('app.admin.postalcode.create')</h3>
                  @endif
                  <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body">
                    <!-- content -->
                    <div class="form-group">
                      <label>@lang('app.admin.postalcode')</label>
                      <input type="text" minlength="5" maxlength="5" name="content" class="form-control" rows="3" placeholder="@lang('app.admin.postalcode')" value="{{$item->content}}"/>
                    </div>
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
    <div class="col-md-8">
      @component('components.box', ['button'=>true, 'class'=>'box-primary'])
          @slot('header')
              <div class="row">
                  <div class="col-md-12 pull-right">
                    <form method="get" action="{{url()->current()}}">
                        <div class="input-group input-group-sm">
                          <div class="col-md-3 input-group-sm pull-right" style="padding-right: 0; padding-left: 0;">
                              <input type="text" name="q" class="form-control pull-right" placeholder="@lang('app.search')" value="{{$q}}">
                          </div>
                          <div class="col-md-3 input-group-sm pull-right" style="padding-right: 0; padding-left: 0;">
                              <input class="form-control" type="number" name="record" min="10" value="{{$record}}" placeholder="Nombre par page">
                          </div>
                          <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                          </div>
                        </div>
                    </form>
                  </div>
              </div>
          @endslot

          <table class="table table-striped table-hover items-list">
            <thead>
                <tr>
                    <th scope="col">Codes postaux<span class="column-sorter"></span></th>
                    <th scope="col">Date de publication <span class="column-sorter"></span></th>
                    <th scope="col" class="pull-right">Actions </th>
                </tr>
            </thead>
            <tbody>
                @if(count($items)>0)
                    @each('admin.postalcode.tr', $items, 'postalcode')
                @else
                    @include('admin.tr-empty', ['col'=>3])
                @endif
            </tbody>
          </table>

          @slot('footer')
              {{$items->links()}}
          @endslot

      @endcomponent
    </div>
</div>
@endsection

@section('script')
@parent
@include('admin.inc.sweetalert-delete')
@endsection