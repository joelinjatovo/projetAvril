<div id="property-sidebar">
    <a href="{{route('apls')}}" class="btn btn-default col-md-12" style="margin-bottom: 20px;">@lang('app.list_apl')</a>
    
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
                <img class="feature-image" src="{{$product->imageUrl(false)}}" alt="{{$product->title}}">
            </a>
            <div class="property-contents">
                <h6 class="entry-title"> <a href="{{route('product.index',['product'=>$product])}}">{{$product->title}}</a></h6>
                <span  class="btn btn-price">{{$product->price}}</span>
            </div>
        </div>
        @endforeach
    </section>
    
    <section class="widget recent-properties clearfix">
        <a href="{{route('member.contact', ['role'=>'admin'])}}" class="btn btn-primary col-sm-12"><i class="fa fa-envelope-open-o"></i> @lang('app.btn.contact_admin')</a>
        <a href="{{route('member.contact', ['role'=>'apl'])}}" class="btn btn-default col-sm-12"><i class="fa fa-envelope-open-o"></i> @lang('app.btn.contact_apl')</a>
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