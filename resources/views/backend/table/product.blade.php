<table class="shop_table shop_table_responsive cart table table-striped table-hover">
    <thead>
        <tr>
            <th colspan="2">Produits</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
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
        @endforeach
    </tbody>
</table>

{{$products->links()}}