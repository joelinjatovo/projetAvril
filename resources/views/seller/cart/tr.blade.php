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
    <td class="product-price"><span>{{$cart->currency}}</span> {{$cart->tma}}</td>

    <td>
        @if(!$cart->isConfirmed())
        <form action="{{route('seller.order.show', $cart)}}" method="post" class="pull-right">
            {{csrf_field()}}
            <input type="hidden" name="action" value="cancel">
            <button type="submit" class="btn btn-default pull-left">x</button>
        </form>
        <form action="{{route('seller.order.show', $cart)}}" method="post" class="pull-right">
            {{csrf_field()}}
            <input type="hidden" name="action" value="confirm">
            <button type="submit" class="btn btn-success pull-left">@lang('app.btn.confirm')</button>
        </form>
        @elseif(!$cart->isTmaPaid())
        <form action="{{route('seller.order.show', $cart)}}" method="post" class="pull-right">
            {{csrf_field()}}
            <input type="hidden" name="action" value="pay-tma">
            <button type="submit" class="btn btn-success pull-left">@lang('seller.btn.pay-tma')</button>
        </form>
        @endif
    </td>
</tr>
