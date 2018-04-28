@extends('layouts.app')

@section('content')

@include('includes.slider')
<div class="container">
  <div class="row">
      <div class="col-lg-8 col-md-7">
          <section class="property-meta-wrapper common text-center bg-info">
            <div class="entry-title">
                <h3 class="title wow slideInLeft" style="visibility: hidden; animation-name: none;">
                        COMMUNAUTE FRANCOPHONE
                </h3>
            </div>
            <br>
            <div class="property-single-metax" >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet.
                <p><br></p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur                                   ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s                                   ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci.                                       P   ellentesque                                         fermentum nisl purus, et iaculis lectus pharetra sit amet.
              </div>
          </section>
          <section class="property-meta-wrapper common text-center bg-info">
            <div class="entry-title">
                <h3 class="title wow slideInLeft" style="visibility: hidden; animation-name: none;">ESPACES PUBLICITES</h3>
            </div>
            <br>
            <div class="property-single-metax-center" >
                <p class="wow slideInRight" style="visibility: hidden; animation-name: none;">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut <br>
                        labore et dolore magna aliquan ut enim ad minim veniam.</p>
                <a class="btn" href="#">
                    <img src="{{asset('images/iso-btn.png')}}" alt="ISO Button">
                </a>
                <a class="btn" href="#">
                    <img src="{{asset('images/playstore-btn.png')}}" alt="Play Store Button">
                </a>
            </div>
          </section>
          <section class="property-video common text-center bg-info">
              <div class="entry-title">
                  <h3 class="title wow slideInLeft" style="visibility: hidden; animation-name: none;">
                    COMMENT FONCTIONNE LE SITE INVESTIR EN AUSTRALIE
                  </h3>
              </div>
              <div class="property-single-metax">

              </div>
              <br>
              <iframe src="https://www.youtube.com/embed/dzHw2RRyk68" allowfullscreen=""></iframe>
          </section>
          <section class="property-meta-wrapper common text-center bg-info">
            <div class="entry-title">
              <h3 class="title wow slideInLeft" style="visibility: visible; animation-name: slideInLeft;">
                      NOTRE MISSION / NOTRE VISION
              </h3>
            </div>
            <br>
              <div class="row">
                  <div class="col-md-3 col-xs-6">
                      <div class="feature clearfix">
                          <i class="icon"><img src="{{asset('images/features/1.png')}}" alt="Feature Icon"></i>
                          <h6 class="">Etape 1</h6>
                          <p> Parmi tous les produits affichés sur le site. séléctionnez celui ou ceux qui vous interessent </p>
                      </div>
                  </div>
                  <div class="col-md-3 col-xs-6">
                      <div class="feature clearfix">
                          <i class="icon"><img src="{{asset('images/features/2.png')}}" alt="Feature Icon"></i>
                          <h6 class="">Etape 2</h6>
                          <p> Obtenez de l'agence les informations que vous souhaitez sur le ou les biens séléctionnés </p>
                      </div>
                  </div>
                  <div class="col-md-3 col-xs-6">
                      <div class="feature clearfix">
                          <i class="icon"><img src="{{asset('images/features/3.png')}}" alt="Feature Icon"></i>
                          <h6 class="">Etape 3</h6>
                          <p> Après avoir fait votre choix, faites connaitre votre décision d'achat à l'agence francophone australienne chargée de la vente </p>
                      </div>
                  </div>
                  <div class="col-md-3 col-xs-6">
                      <div class="feature clearfix">
                          <i class="icon"><img src="{{asset('images/features/4.png')}}" alt="Feature Icon"></i>
                          <h6 class="">Etape 4</h6>
                          <p> l'agence phrancophone australienne se charge des formalités juridiquesde transfert de propriété </p>
                      </div>
                  </div>
              </div>
              <div style="text-align:justify">
                  <p> <label class="entry-title">Etape 1</label> : Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. </p>
                  <p> <label class="entry-title">Etape 2</label> : Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. </p>
                  <p> <label class="entry-title">Etape 3</label> : Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. </p>
                  <p> <label class="entry-title">Etape 4</label> : Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. </p>
              </div>
          </section>
                                <!-- end content -->
      </div>

      <!-- side bar -->
      <div class="col-lg-4 col-md-5">
        @include('includes.sidebar')
      </div>

       <!-- ARTICLE ENREGISTREES -->
       <div class="container">
          <header class="section-header text-center">
             <div class="container">
               <h3 class="pull-left">Derniers Produits </h3>
             </div>
          </header>
       </div>

       <div class="row">
           @php $i = 0; @endphp
           @foreach($recentProducts as $product)
               @if($i%3 === 0)
               <div class="col-lg-12">
               @endif
               <div class="col-lg-4 col-sm-6 layout-item-wrap mix a0">
                    @include('product.single', ['item'=>$product])
               </div>
               @php $i++; @endphp
               @if($i%3 === 0)
               </div>
               @endif
           @endforeach
           @if(($i%3) > 0)
                </div>
           @endif
       </div>

      <section class="property-meta-wrapper common text-center bg-info">
         <h2 class="title wow slideInLeft" style="visibility: hidden; animation-name: none;">
                 ESPACES PUBLICITES
         </h2>
         <p class="wow slideInRight" style="visibility: hidden; animation-name: none;">
                 Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut <br>
                     labore et dolore magna aliquan ut enim ad minim veniam.
         </p>
         <a class="btn" href="#">
             <img src="{{asset('images/iso-btn.png')}}" alt="ISO Button">
         </a>
         <a class="btn" href="#">
             <img src="{{asset('images/playstore-btn.png')}}" alt="Play Store Button">
         </a><br><br>
       </section>

       <!-- ARTICLE ENREGISTREES -->
       <div class="container">
         <header class="section-header text-center">
             <div class="container">
               <h3 class="pull-left">Derniers Articles</h3>
             </div>
         </header>
       </div>
       <div class="row">
           @php $i = 0; @endphp
           @foreach($blogs as $blog)
               @if($i%3 === 0)
               <div class="col-lg-12">
               @endif
               <div class="col-lg-4 col-sm-6 layout-item-wrap mix a0">
                    @include('blog.single',  ['item'=>$blog])
               </div>
               @php $i++; @endphp
               @if($i%3 === 0)
               </div>
               @endif
           @endforeach
           @if(($i%3) > 0)
                </div>
           @endif
       </div><!-- /row -->
   </div>
</div>
@endsection