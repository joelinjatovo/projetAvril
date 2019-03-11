@extends('layouts.lte')

@section('content')
<div class="row">
    <div class="col-md-4">
        @if($item->id>0)
        <a href="{{route('admin.category.create', ['type'=>$type])}}" class="btn btn-primary btn-block margin-bottom">@lang('app.admin.category.add')</a>
        @endif
        <form role="form" method="post" action="{{$action}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="box box-primary">
                <div class="box-header with-border">
                  @if($item->id>0)
                  <h3 class="box-title">@lang('app.admin.category.update')</h3>
                  @else
                  <h3 class="box-title">@lang('app.admin.category.add')</h3>
                  @endif
                  <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body">
                    <!-- title input -->
                    <div class="form-group">
                      <label>@lang('app.admin.title')</label>
                      <input name="title" type="text" class="form-control" value="{{$item->title}}" placeholder="@lang('app.admin.title.desc')">
                      <span class="help-block">@lang('app.admin.title.desc')</span>
                    </div>

                    <!-- content -->
                    <div class="form-group">
                      <label>@lang('app.admin.content')</label>
                      <textarea name="content" class="form-control" rows="3" placeholder="@lang('app.admin.content.desc')">{!!$item->content!!}</textarea>
                      <span class="help-block">@lang('app.admin.content.desc')</span>
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
          
          @if($type=='blog')
              <table class="table table-striped table-hover items-list">
                <thead>
                    <tr>
                        <th scope="col">Titre <span class="column-sorter"></span></th>
                        <th scope="col">Date de publication <span class="column-sorter"></span></th>
                        <th scope="col">Blogs<span class="column-sorter"></span></th>
                        <th scope="col">Auteur<span class="column-sorter"></span></th>
                        <th scope="col" class="pull-right">Actions<span class="column-sorter"></span></th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($items)>0)
                        @each('admin.category.tr-blog', $items, 'category')
                    @else
                        @include('admin.tr-empty', ['col'=>6])
                    @endif
                </tbody>
              </table>
          @else
              <table class="table table-striped table-hover items-list">
                <thead>
                    <tr>
                        <th scope="col">Titre <span class="column-sorter"></span></th>
                        <th scope="col">Date de publication <span class="column-sorter"></span></th>
                        <th scope="col">Produits<span class="column-sorter"></span></th>
                        <th scope="col">Auteur<span class="column-sorter"></span></th>
                        <th scope="col" class="pull-right">Actions<span class="column-sorter"></span></th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($items)>0)
                        @each('admin.category.tr-product', $items, 'category')
                    @else
                        @include('admin.tr-empty', ['col'=>6])
                    @endif
                </tbody>
              </table>
          @endif
          
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
