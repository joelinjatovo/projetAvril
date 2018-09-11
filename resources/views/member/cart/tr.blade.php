
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
    <td class="product-price"><span>{{$cart->currency}}</span> {{$cart->reservation}}</td>

    <td>
        @if($cart->afa)
            {{$cart->afa->name}}
        @else
            <form action="{{route('shop.checkout')}}" method="post" class="pull-right">
                {{csrf_field()}}
                <input type="hidden" name="order" value="{{$cart->id}}">
                <input type="hidden" name="action" value="update_session">
                <input type="submit" value="@lang('member.select')">
            </form>
        @endif
    </td>
</tr>
