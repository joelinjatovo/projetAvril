<tr>
    <td class="product-thumbnail" width="100">
        <a href="{{route('product.index', $cart->product)}}">
            <img width="100" height="100" src="{{$cart->product->imageUrl()}}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="" />
        </a>
    </td>
    <td class="product-name">
        <a href="{{route('product.index', $cart->product)}}">{{$cart->product->title}}</a>
    </td>

    <td class="product-price"><span>{{$cart->currency}}</span> {{$cart->price}}</td>
    <td class="product-thumbnail" width="100">
        @if($cart->author)
        <a href="{{route(\Auth::user()->role.'.user.contact', $cart->author)}}">
            <img width="100" height="100" src="{{$cart->author->imageUrl()}}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="" />
        </a>
        @endif
    </td>
    <td>
         @if($cart->author)
         <a href="{{route(\Auth::user()->role.'.user.contact', $cart->author)}}">{{$cart->author->email}}</a>
         @endif
    </td>
    <td><span>{{$cart->currency}}</span> {{$cart->apl_amount}}</td>
</tr>
