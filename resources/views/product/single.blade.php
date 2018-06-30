
<article class="property layout-item clearfix">
    <figure class="feature-image">
        <a class="clearfix zoom" href="#">
            <img data-action="zoom" src="{{$item->imageUrl()}}" alt="{{$item->title}}">
        </a>
    </figure>
    <div class="property-contents clearfix">
        <header class="property-header clearfix">
            <div class="pull-left">
                <h6 class="entry-title"><a href="{{route('product.index',['product'=>$item])}}">{{$item->title}}</a></h6>
                <span class="property-location"><i class="fa fa-map-marker"></i> {{$item->location?$item->location->toString():''}}</span>
            </div>
        </header>
        <div class="contents clearfix">
            {{$item->excerpt()}}
        </div>
        <div class="property-meta clearfix">
            <span><i class="fa fa-arrows-alt"></i> @lang('app.num.area', ['num'=>number_format($item->area, 0)])</span>
            <span><i class="fa fa-bed"></i> @lang('app.num.bed', ['num'=>$item->bedrooms])</span>
            <span><i class="fa fa-bathtub"></i> @lang('app.num.bath', ['num'=>$item->bathrooms])</span>
            <span><i class="fa fa-cab"></i> {{$item->garage_spaces?__('app.yes'):__('app.no')}}</span>
        </div>
        <a href="{{route('product.index',['product'=>$item])}}" class="btn btn-default btn-price pull-right">
            <strong>{{$item->currency}} {{$item->price}}</strong>
        </a>
    </div>
</article>