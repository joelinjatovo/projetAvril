<div id="property-sidebar">
    
    <section class="property-meta-wrapper common text-center bg-info">
        <h2 class="title wow slideInLeft" style="visibility: hidden; animation-name: none;">
            ESPACES PUBLICITES</h2>
        <p class="wow slideInRight" style="visibility: hidden; animation-name: none;">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut <br>
                labore et dolore magna aliquan ut enim ad minim veniam.</p>
    </section>
    
    <section class="property-meta-wrapper common text-center bg-info">
        <h2 class="title wow slideInLeft" style="visibility: hidden; animation-name: none;">
            ESPACES PUBLICITES</h2>
        <p class="wow slideInRight" style="visibility: hidden; animation-name: none;">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut <br>
                labore et dolore magna aliquan ut enim ad minim veniam.</p>
    </section>

    <section class="widget property-taxonomies clearfix">
      <button class="btn btn-info"><i class="fa fa-share-alt" aria-hidden="true"></i> Partager</button><br>
        
      <button class="btn btn-success"><i class="fa fa-envelope-open-o" aria-hidden="true"></i> Contacter l'agence</button><br>
        
      <form action="{{route('shop.add', ['product'=>$item])}}" method="post">
        {{csrf_field()}}
        <button class="btn btn-warning"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Je veux acheter ce produit</button>
      </form>
      <form action="{{route('label.store', ['product'=>$item,'type'=>'starred'])}}" method="post">
        {{csrf_field()}}
        <button class="btn btn-primary" type="submit"><i class="fa fa-star" aria-hidden="true"></i> Ajouter au Favoris</button>
      </form>
    </section>
    
    <section class="widget property-meta-wrapper clearfix">
        <br><br>
        <h2 class="title wow slideInLeft">Pub</h2>
        @foreach($pubs as $pub)
        <div class="content-box-large box-with-header">
            <img src="{{asset('images/publicite3-gformat.jpg')}}" class="img-rounded" alt="Cinque Terre" width="604" height="236">
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