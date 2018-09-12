@extends('layouts.lte')

@section('content')
<div class="row">
    <div class="col-md-12">
      @component('components.box', ['button'=>true, 'class'=>'box-primary'])
          @slot('header')
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
          @endslot
          
          <table class="table table-striped table-hover items-list">
            <thead>
                <tr>
                    <th scope="col">@lang('app.table.blogs') <span class="column-sorter"></span></th>
                    <th scope="col">@lang('app.table.comment') <span class="column-sorter"></span></th>
                    <th scope="col">@lang('app.table.meta_tag') <span class="column-sorter"></span></th>
                    <th scope="col">@lang('app.table.meta_desc') <span class="column-sorter"></span></th>
                    <th scope="col">@lang('app.table.status') <span class="column-sorter"></span></th>
                    <th scope="col">@lang('app.table.date') <span class="column-sorter"></span></th>
                    <th scope="col" width="200px" class="text-right">@lang('app.table.actions')</th>
                </tr>
            </thead>
            <tbody>
                @if(count($items)>0)
                    @each('admin.blog.tr', $items, 'blog')
                @else
                    @include('admin.tr-empty', ['col'=>7])
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
@include('admin.inc.sweetalert-blog')
@endsection
