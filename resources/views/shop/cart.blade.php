@extends('layouts.app')

@section('content')
  <div class="row">
      @if(!$item)
          <h3>Votre panier est vide!</h3>
      @else
          <h3>Votre panier</h3>
          <ul class="list-group">
              @foreach($item->items as $cartItem)
                @if($cartItem->product)
                  <li class="list-group-item">
                      <span><strong>{{$cartItem->product->title}}</strong> x {{$cartItem->quantity}}</span>
                      <a href="{{route('shop.product.reduce', ['product' => $cartItem->product])}}"><i class="fa fa-minus-square" aria-hidden="true">X</i></a>
                      <a href="{{route('shop.product.delete', ['product' => $cartItem->product])}}"><i class="fa fa-trash" aria-hidden="true">XX</i></a>
                      <span class="badge">{{$cartItem->price}} $</span>
                  </li>
                @endif
              @endforeach
          </ul>
          <span class="pull-right badge">Total à payer : {{$item->totalPrice}} $</span>
          <a href="{{route('shop.product.checkout')}}" class="btn btn-primary">Passé au paiement</a>
      @endif
  </div>
@endsection