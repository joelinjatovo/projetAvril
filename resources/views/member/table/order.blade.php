<table class="shop_table shop_table_responsive cart table table-striped table-hover">
    <thead>
        <tr>
            <th colspan="2">Produits</th>
            <th>Prix</th>
            <th>Reservation</th>
            <th>@lang('app.afa')</th>
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
            <td class="product-price"><span>{{$order->currency}}</span> {{$order->reservation}}</td>
            
            <td>
                @if($order->afa)
                    {{$order->afa->name}}
                @else
                    <form action="{{route('shop.checkout')}}" method="post" class="pull-right">
                        {{csrf_field()}}
                        <input type="hidden" name="order" value="{{$order->id}}">
                        <input type="hidden" name="action" value="update_session">
                        <input type="submit" value="@lang('member.select')">
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