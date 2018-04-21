@extends('layouts.app')

@section('content')
  <div class="row">
      @if(!Session::has('cart'))
          <h3>Votre panier est vide!</h3>
      @else
          <h3>Votre panier</h3>
          <ul class="list-group">
              @foreach($items as $item)
                  <li class="list-group-item">
                      <span><strong>{{$item['item']->title}}</strong> x {{$item['quantity']}}</span>
                      <a href="{{route('product.reduce', ['id' => $item['item']->id])}}"><i class="fa fa-minus-square" aria-hidden="true">X</i></a>
                      <a href="{{route('product.delete', ['id' => $item['item']->id])}}"><i class="fa fa-trash" aria-hidden="true">XX</i></a>
                      <span class="badge">{{$item['price']}} $</span>
                  </li>
              @endforeach
          </ul>
          <span class="pull-right badge">Total à payer : {{$totalP}} $</span>
          <a href="{{route('product.checkout')}}" class="btn btn-primary">Passé au paiement</a>
      @endif
  </div>
@endsection