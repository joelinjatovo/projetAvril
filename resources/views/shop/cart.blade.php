@extends('layouts.backend')

@section('subcontent')
<div class="row">
  @if(!$item||count($item->items)==0)
     <div class="panel panel-default">
         <div class="panel-heading"><h3>Votre panier</h3></div>
        <div class="panel-body">
          <ul class="list-group">
              <li class="list-group-item clearfix">
                  <h4>@lang('app.empty_cart')</h4>
              </li>
            </ul>
        </div>
    </div>
  @else
      <div class="panel panel-default">
        <div class="panel-heading"><h3>Votre panier</h3></div>
        <div class="panel-body">
              <ul class="list-group">
                  @foreach($item->items as $cartItem)
                    @if($cartItem->product)
                      <li class="list-group-item clearfix">
                          <div class="pull-left">
                              <h4>{{$cartItem->product->title}}</h4>
                              <h5>APL: {{$cartItem->apl->name}}</h5>
                              <p><strong>Quantity:</strong> {{$cartItem->quantity}} / <strong>Price:</strong> ${{$cartItem->price}}</p>
                              <p><strong>Taux de reseervation:</strong> {{$cartItem->product->tma}}</p>
                          </div>
                          <div class="pull-right">
                              <a class="btn" href="{{route('shop.product.reduce', ['product' => $cartItem->product])}}"><i class="fa fa-minus-square" aria-hidden="true"></i></a>
                              <a class="btn" href="{{route('shop.product.delete', ['product' => $cartItem->product])}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                              <span class="badge">{{$cartItem->tma}} $</span>
                          </div>
                      </li>
                    @endif
                  @endforeach
                  <li class="list-group-item clearfix">
                      <div class="pull-left">
                          <p><strong>Prix Total :</strong> ${{$item->totalPrice}}</p>
                      </div>
                      <div class="pull-right">
                          <h4>Total à payer : <span class="badge">${{$item->totalTma}}</span></h4>
                      </div>
                  </li>
              </ul>
              <a href="{{route('shop.product.checkout')}}" class="btn btn-primary pull-right">Passer au paiement</a>
        </div>
     </div>
 @endif
</div>
@endsection