<li class="item">
  <div class="product-img">
    <img src="{{$product->imageUrl(true)}}" alt="Product Image">
  </div>
  <div class="product-info">
    <a href="{{route('admin.product.show', $product)}}" class="product-title">{{$product->title}}
      <span class="label label-warning pull-right">{{$product->getPrice()}}</span></a>
    <span class="product-description">{{$product->excerpt()}}</span>
  </div>
</li>
<!-- /.item -->