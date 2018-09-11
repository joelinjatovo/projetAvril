<tr>
    <td class="product-thumbnail" width="100">
        <a href="{{route('product.index', $order->product)}}">
            <img width="100" height="100" src="{{$order->product->imageUrl()}}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="" />
        </a>
    </td>
    <td class="product-name">
        <a href="{{route('product.index', $order->product)}}">{{$order->product->title}}</a>
    </td>
    <td>
        <span>{{$order->currency}}</span> {{$order->price}}
    </td>
    <td>
        <span>{{$order->currency}}</span> {{$order->afa_amount}}
        @if(!$order->isTmaPaid())
            <p class="badge badge-danger">Commission sur vente non payée par le vendeur</p>
        @endif
    </td>
    <td>
        <a href="{{route('afa.pay.cpc')}}" class="btn btn-success pull-left">@lang('afa.btn.pay-cpc')</a>
    </td>
</tr>
