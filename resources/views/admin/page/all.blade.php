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
                    <th scope="col">Titre/Contenu (FR)<span class="column-sorter"></span></th>
                    <th scope="col">Titre/Contenu (EN)<span class="column-sorter"></span></th>
                    <th scope="col">Parent<span class="column-sorter"></span></th>
                    <th scope="col">Ordre<span class="column-sorter"></span></th>
                    <th scope="col">Auteur<span class="column-sorter"></span></th>
                    <th scope="col">Date<span class="column-sorter"></span></th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(count($items)>0)
                    @each('admin.page.tr', $items, 'page')
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
@include('admin.inc.sweetalert-delete')
@endsection
