@extends('layouts.lte')

@section('content')
<div class="row">
    <div class="col-md-12">
      @if(!$item)
         <div class="panel panel-default">
            <div class="panel-body">
              <ul class="list-group">
                  <li class="list-group-item clearfix">
                      <h4>@lang('member.empty_order')</h4>
                  </li>
                </ul>
            </div>
        </div>
      @else
          <div class="panel panel-default">
            <div class="panel-body">
                  <ul class="list-group">
                    @if($item->product)
                      <li class="list-group-item clearfix">
                          <div class="pull-left">
                              <h4>{{$item->product->title}}</h4>
                              <h5>APL: {{$item->apl->name}}</h5>
                              <p><strong>Price:</strong> {{$item->price}}</p>
                              <p><strong>Taux de reservation:</strong> {{$item->tma}}</p>
                          </div>
                          <div class="pull-right">
                              <span class="badge">{{$item->tma}}</span>
                          </div>
                      </li>
                    @endif
                  </ul>
                  <form action="{{route('shop.cart')}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="action" value="session">
                    <button type="submit" class="btn btn-default pull-left">@lang('member.cancel_order')</button>
                  </form>
                  <a href="{{route('shop.checkout')}}" class="btn btn-primary pull-right">@lang('member.goto_payment')</a>
            </div>
         </div>
     @endif
    </div>
</div>
@endsection