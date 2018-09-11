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
</tr>
