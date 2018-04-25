<div id="property-sidebar">
    <section class="widget property-meta-wrapper common text-center bg-info">
        <div class="col-md-12">
            <div class="content-box-header">
                <div class="panel-title">Espaces publicitaires</div>
            </div>
            <p><a href="#" class="btn btn-success btn-lg">Agences Partenaires Locales</a></p>

            <!-- google maps API -->
            <div class="content-box-large box-with-header">
                <div id="map"></div>
            </div>
        </div>
    </section>
    
    <section class="widget property-meta-wrapper clearfix">
        <div class="col-md-12">
            <h6><img src="{{asset('images/features/bleu.png')}}" width="10" height="10"> Résidentiel </h6>
            <h6><img src="{{asset('images/features/vert.png')}}" width="10" height="10"> Foncier </h6>
            <h6><img src="{{asset('images/features/rouge.png')}}" width="10" height="10"> Industriel </h6>
            <h6><img src="{{asset('images/features/jaune.png')}}" width="10" height="10"> Commercial</h6>
        </div>
    </section>
    
    <section class="widget property-meta-wrapper clearfix">
        <h2 class="title wow slideInLeft">Pub</h2>
        @foreach($pubs as $pub)
        <div class="content-box-large box-with-header">
            <a target="_blank" href="{{$pub->links?$pub->links:'#'}}"><img src="{{$pub->imageUrl()}}" class="img-rounded" alt="Cinque Terre" width="604" height="236"></a>
            <br><br>
        </div>
        @endforeach
    </section>
    
    <section class="widget recent-properties clearfix">
        <h5 class="title">Récents</h5>
        @foreach($products as $product)
        <div class="property clearfix">
            <a href="#" class="feature-image zoom">
                <img data-action="zoom" src="{{asset('images/property/1.jpg')}}" alt="Property Image">
            </a>
            <div class="property-contents">
                <h6 class="entry-title"> <a href="{{route('product.index',['product'=>$product])}}">{{$product->title}}</a></h6>
                <span class="btn-price">${{$product->price}}</span>
                <div class="property-meta clearfix">
                    <span> <i class="fa fa-arrows-alt"></i> 3060 SqFt</span>
                </div>
            </div>
        </div>
        @endforeach
    </section>
    <section class="widget property-taxonomies clearfix">
        <h5 class="title">Types récents</h5>
        <ul class="clearfix">
            @foreach($categories as $category)
            <li><a href="#">{{$category->title}} </a><span class="pull-right">30</span></li>
            @endforeach
        </ul>
    </section>
</div>