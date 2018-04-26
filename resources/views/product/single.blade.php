
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
            <a href="{{route('product.index',['product'=>$item])}}" class="btn btn-default btn-price pull-right">
                <strong>{{$item->currency}} {{$item->price}}</strong>
            </a>
        <div class="contents clearfix">
            <p> {{$item->excerpt()}} </p>
        </div>
    </div>
</article>