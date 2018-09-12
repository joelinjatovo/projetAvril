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
          @endslot
          
          @include('admin.product.table', ['products'=>$items])
          
          @slot('footer')
              {{$items->links()}}
          @endslot
          
      @endcomponent
    </div>
</div>
@endsection

@section('script')
@parent
@include('admin.inc.sweetalert-product')
@endsection