
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
