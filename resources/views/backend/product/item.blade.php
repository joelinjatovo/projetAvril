<div class="property clearfix">
    <a href="{{route('product.index',['product'=>$product])}}">
        <img  class="feature-image" src="{{$product->imageUrl(false)}}" alt="{{$product->title}}">
    </a>
    <div class="property-contents">
        <h6 class="entry-title"> <a href="{{route('product.index',['product'=>$product])}}">{{$product->title}}</a></h6>
        <span  class="btn btn-price">${{$product->price}}</span>
    </div>
</div>