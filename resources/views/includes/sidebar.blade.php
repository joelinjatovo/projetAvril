<div id="property-sidebar">
    <a href="{{route('apls')}}" class="btn btn-default col-md-12">@lang('app.list_apl')</a>
    <br>
    <br>
    @foreach($pubs as $pub)
    <section class="widget property-meta-wrapper clearfix">
        <h2 class="title wow slideInLeft">{{$pub->title}}</h2>
        <div class="content-box-large box-with-header">
            <a target="_blank" href="{{$pub->links?$pub->links:'#'}}"><img src="{{$pub->imageUrl()}}" class="img-rounded" alt="Cinque Terre" width="604" height="236"></a>
        </div>
    </section>
    @endforeach
    <section class="widget recent-properties clearfix">
        <h5 class="title">@lang('app.recent.product')</h5>
        @foreach($products as $product)
        <div class="property clearfix">
            <a href="{{route('product.index',['product'=>$product])}}">
                <img src="{{$product->imageUrl(false)}}" alt="Property Image">
            </a>
            <div class="property-contents">
                <h6 class="entry-title"> <a href="{{route('product.index',['product'=>$product])}}">{{$product->title}}</a></h6>
                <span  class="btn btn-price">${{$product->price}}</span>
            </div>
        </div>
        @endforeach
    </section>
    <section class="widget property-taxonomies clearfix">
        <h5 class="title">@lang('app.recent.category')</h5>
        <ul class="clearfix">
            @foreach($categories as $category)
            <li><a href="{{route('shop.index',$category)}}">{{$category->title}} </a><span class="pull-right">{{$category->products_count}}</span></li>
            @endforeach
        </ul>
    </section>
</div>