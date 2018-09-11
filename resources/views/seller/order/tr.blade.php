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

    <td>
        @if(!$order->isConfirmed())
        <form action="{{route('seller.order.show', $order)}}" method="post" class="pull-right">
            {{csrf_field()}}
            <input type="hidden" name="action" value="cancel">
            <button type="submit" class="btn btn-default pull-left">x</button>
        </form>
        <form action="{{route('seller.order.show', $order)}}" method="post" class="pull-right">
            {{csrf_field()}}
            <input type="hidden" name="action" value="confirm">
            <button type="submit" class="btn btn-success pull-left">@lang('app.btn.confirm')</button>
        </form>
        @elseif(!$order->isTmaPaid())
        <form action="{{route('seller.order.show', $order)}}" method="post" class="pull-right">
            {{csrf_field()}}
            <input type="hidden" name="action" value="pay-tma">
            <button type="submit" class="btn btn-success pull-left">@lang('seller.btn.pay-tma')</button>
        </form>
        @endif
    </td>
</tr>
