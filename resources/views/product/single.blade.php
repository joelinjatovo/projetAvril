
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
                @if($item->location)
                <span class="property-location"><i class="fa fa-map-marker"></i> {{$item->location->toString()}}</span>
                @endif
            </div>
        </header>
        <div class="property-meta clearfix">
            <span><i class="fa fa-arrows-alt"></i> {{$item->area}}</span>
            <span><i class="fa fa-bed"></i> {{$item->bedrooms}}</span>
            <span><i class="fa fa-bathtub"></i> {{$item->bathrooms}}</span>
            <span><i class="fa fa-cab"></i> {{$item->garage_spaces}}</span>
        </div>
        <div class="contents clearfix">
            <p> {{$item->excerpt()}} </p>
        </div>
        <a href="{{route('product.index',['product'=>$item])}}" class="btn btn-default btn-price pull-right">
            <strong>{{$item->currency}} {{$item->price}}</strong>
        </a>
    </div>
</article>