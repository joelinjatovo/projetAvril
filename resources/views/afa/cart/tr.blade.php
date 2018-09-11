<tr>
    <td class="product-thumbnail" width="100">
        <a href="{{route('product.index', $cart->product)}}">
            <img width="100" height="100" src="{{$cart->product->imageUrl()}}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="" />
        </a>
    </td>
    <td class="product-name">
        <a href="{{route('product.index', $cart->product)}}">{{$cart->product->title}}</a>
    </td>
    <td>
        <span>{{$cart->currency}}</span> {{$cart->price}}
    </td>
    <td>
        <span>{{$cart->currency}}</span> {{$cart->afa_amount}}
        @if(!$cart->isTmaPaid())
            <p class="badge badge-danger">Commission sur vente non payée par le vendeur</p>
        @endif
    </td>
    <td>
        <a href="{{route('afa.pay.cpc')}}" class="btn btn-success pull-left">@lang('afa.btn.pay-cpc')</a>
    </td>
</tr>
