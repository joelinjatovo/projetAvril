<table class="shop_table shop_table_responsive cart table table-striped table-hover">
    <thead>
        <tr>
            <th colspan="2">Produits</th>
            <th>Prix</th>
            <th>Montant de reservation</th>
            
            @if(\Auth::check()&&\Auth::user()->hasRole('apl'))
            <th colspan="2">Clients</th>
            <th>Commission sur presentation client</th>
            @endif
            
            @if(\Auth::check()&&\Auth::user()->hasRole('afa'))
            <th>Commission sur vente a payer</th>
            @endif
            
            @if($orders[0]->status == 'pinged')
            <th>Action</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td class="product-thumbnail" width="100">
                <a href="{{route('product.index', $order->product)}}">
                    <img width="100" height="100" src="{{$order->product->imageUrl()}}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="" />
                </a>
            </td>
            <td class="product-name">
                <a href="{{route('product.index', $order->product)}}">{{$order->product->title}}</a>
            </td>
            
            <td class="product-price"><span>{{$order->currency}}</span> {{$order->price}}</td>
            <td class="product-price"><span>{{$order->currency}}</span> {{$order->tma}}</td>
            
            @if(\Auth::check()&&\Auth::user()->hasRole('apl'))
                <td class="product-thumbnail" width="100">
                    @if($order->author)
                    <a href="{{route(\Auth::user()->role.'.user.contact', $order->author)}}">
                        <img width="100" height="100" src="{{$order->author->imageUrl()}}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="" />
                    </a>
                    @endif
                </td>
                <td>
                     @if($order->author)
                     <a href="{{route(\Auth::user()->role.'.user.contact', $order->author)}}">{{$order->author->email}}</a>
                     @endif
                </td>
                <td><span>{{$order->currency}}</span> {{$order->apl_amount}}</td>
            @endif
            
            @if(\Auth::check()&&\Auth::user()->hasRole('afa'))
                <td><span>{{$order->currency}}</span> {{$order->afa_amount}}</td>
            @endif
            
            @if(\Auth::check()&&\Auth::user()->hasRole('seller'))
                <td><span>{{$order->currency}}</span> {{$order->tma}}</td>
            @endif
            
            <td class="product-action">
                @if($order->status == 'pinged')
                <form action="{{route('shop.cart')}}" method="post" class="pull-right">
                    {{csrf_field()}}
                    <input type="hidden" name="order" value="{{$order->id}}">
                    <input type="hidden" name="action" value="item">
                    <button type="submit" class="btn btn-default pull-left">x</button>
                </form>
                <form action="{{route('shop.checkout')}}" method="post" class="pull-right">
                    {{csrf_field()}}
                    <input type="hidden" name="order" value="{{$order->id}}">
                    <input type="hidden" name="action" value="update_session">
                    <input type="submit" class="btn btn-success pull-left" value="@lang('member.pay_order')">
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{$orders->links()}}

@if($order->status == 'pinged')
<form action="{{route('shop.cart')}}" method="post">
{{csrf_field()}}
<input type="hidden" name="action" value="all">
<button type="submit" class="btn btn-default pull-right">@lang('member.cancel_orders')</button>
</form>
@endif