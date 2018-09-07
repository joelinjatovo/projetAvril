<tr>
    <td class="product-thumbnail" width="100">
        <a href="{{route('product.index', $product)}}">
            <img width="100" height="100" src="{{$product->imageUrl()}}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="" />
        </a>
    </td>
    <td class="product-name"><a href="{{route('product.index', $product)}}">{{$product->title}}</a></td>
    <td class="product-price"><span>{{$product->currency}}</span> {{$product->price}}</td>
    <td class="product-action">
    </td>
</tr>