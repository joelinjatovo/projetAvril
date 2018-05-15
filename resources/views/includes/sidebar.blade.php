<div id="property-sidebar">
    @foreach($pubs as $pub)
    <section class="widget property-meta-wrapper clearfix">
        <h2 class="title wow slideInLeft">{{$pub->title}}</h2>
        <div class="content-box-large box-with-header">
            <a target="_blank" href="{{$pub->links?$pub->links:'#'}}"><img src="{{$pub->imageUrl()}}" class="img-rounded" alt="Cinque Terre" width="604" height="236"></a>
        </div>
    </section>
    @endforeach
    <section class="widget property-meta-wrapper clearfix">
        <div class="col-md-12">
            <!-- google maps API -->
            <div class="content-box-large box-with-header">
                <div id="map"></div>
            </div>
            <h6><img src="{{asset('images/features/bleu.png')}}" width="10" height="10"> Résidentiel </h6>
            <h6><img src="{{asset('images/features/vert.png')}}" width="10" height="10"> Foncier </h6>
            <h6><img src="{{asset('images/features/rouge.png')}}" width="10" height="10"> Industriel </h6>
            <h6><img src="{{asset('images/features/jaune.png')}}" width="10" height="10"> Commercial</h6>
        </div>
    </section>
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