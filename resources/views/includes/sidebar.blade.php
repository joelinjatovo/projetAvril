<div id="property-sidebar">
    <a href="{{route('apls')}}" class="btn btn-success btn-block" style="margin-bottom: 5px;">{!!__('app.list_apl')!!}</a>
    
    @if(\Auth::check()&&\Auth::user()->hasApl())
    <a href="{{route('member.contact', ['role'=>'apl'])}}" class="btn btn-primary btn-block" style="margin-bottom: 20px;">{!!__('app.btn.contact_apl')!!}</a>
    @endif
    
    @foreach($pubs as $pub)
    <section class="widget property-meta-wrapper clearfix" style="padding:0px;">
        <div class="content-box-large box-with-header">
            <a target="_blank" href="{{$pub->links?$pub->links:'#'}}">
                <img src="{{$pub->imageUrl()}}" title="{{$pub->title}}" alt="{{$pub->title}}">
            </a>
        </div>
    </section>
    @endforeach
    
    <section class="widget recent-properties clearfix">
        <h5 class="title">@lang('app.recent.product')</h5>
        @foreach($products as $product)
        <div class="property clearfix">
            <a href="{{route('product.index',['product'=>$product])}}" class="feature-image">
                <img src="{{$product->imageUrl(false)}}" alt="{{$product->title}}">
            </a>
            <div class="property-contents">
                <h6 class="entry-title"> <a href="{{route('product.index',['product'=>$product])}}">{{$product->title}}</a></h6>
                <span class="btn btn-price">{{$product->price}}</span>
                <div class="property-meta clearfix">
                    <span><i class="fa fa-arrows-alt"></i> @lang('app.num.area', ['num'=>number_format($product->area, 0)])</span>
                    <span><i class="fa fa-bed"></i> @lang('app.num.bed', ['num'=>$product->bedrooms])</span>
                    <span><i class="fa fa-bathtub"></i> @lang('app.num.bath', ['num'=>$product->bathrooms])</span>
                    <span><i class="fa fa-cab"></i> {{$product->garage_spaces?__('app.yes'):__('app.no')}}</span>
                </div>
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