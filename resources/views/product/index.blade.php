@extends('layouts.app')

@section('content')
<div id="property-single">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7">
                <section class="widget property-meta-wrapper common">
                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                      <li data-target="#myCarousel" data-slide-to="1"></li>
                      <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                      <div class="item active">
                        <img src="http://localhost/iea/images/Surfers_Paradise.jpg" alt="..." style="width:100%;">
                      </div>
                      <div class="item">
                        <img src="http://localhost/iea/images/caroussel-image-1.jpg" alt="..." style="width:100%;">
                      </div>
                      <div class="item">
                        <img src="http://localhost/iea/images/caroussel-image-2.jpg" alt="..." style="width:100%;">
                      </div>
                    </div>
                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                      <span class="glyphicon glyphicon-chevron-left"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                      <span class="glyphicon glyphicon-chevron-right"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
                </section>

                <section class="property-meta-wrapper common">
                    <p>
                      <button class="btn btn-warning"><i class="fa fa-envelope-open-o" aria-hidden="true"></i> contacter l'administrateur</button>
                    <form action="{{route('label.store', ['product'=>$item,'type'=>'saved'])}}" method="post">
                        {{csrf_field()}}
                      <button class="btn btn-info" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Sauvegarder la recherche</button>
                    </form>
                      <button class="btn btn-success"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i>choisir un APL</button>
                    </p>
                </section>
                <section class="property-meta-wrapper common">
                    <h3 class="entry-title">Detail</h3>
                    <div class="property-single-meta">
                        <ul class="clearfix">
                            <li><span>Réference_ID:</span> {{$item->reference}}</li>
                            <li><span>Publication du</span> {{$item->created_at}}</li>
                            <li><span>Prix:</span>{{$item->price}}</li>
                            <li><span>Adresse:</span> 9 Hamilton Ave, Surfers Paradise QLD 4217, Australie</li>
                        </ul>
                    </div>
                </section>
                <section class="property-contents common">
                    <div class="entry-title clearfix">
                        <h4 class="pull-left">Description </h4><a class="pull-right print-btn" href="javascript:window.print()">Print This Property <i class="fa fa-print"></i></a>
                    </div>
                    <p>{{$item->content}}</p>
                </section>
                <section class="property-single-features common clearfix">
                    <h4 class="entry-title">Les différents critères</h4>
                        <label>Aucun autre critère n'est mentionné</label>
                </section>
                <section class="property-nearby-places common">
                    <h4 class="entry-title">Agglomérations</h4>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d56365.45787293253!2d153.422381!3d-27.998757!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b910fe19fd1c2b7%3A0x502a35af3dea680!2sSurfers+Paradise+Queensland+4217%2C+Australie!5e0!3m2!1sfr!2sus!4v1509962436469" width="700" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </section>
                                    <!-- endcontent -->
            </div>
            <div class="col-lg-4 col-md-5">
                @include('product.sidebar')
            </div>
        </div>
    </div>

    <div id="blog-listing" class="grid-style">
        <section id="property-listing">
            <header class="section-header text-center">
                <div class="container">
                    <h2 class="pull-left">Produits enregistrés</h2>
                    <div class="pull-right">
                        <div class="property-sorting pull-left">
                            <label for="property-sort-dropdown"> Trier par:   </label>
                            <select name="property-sort-dropdown" id="property-sort-dropdown">
                                <option value="">Default Order</option>
                                <option value="by_date">By date</option>
                                <option value="by_price">By price</option>
                            </select>
                        </div>
                        <p class="pull-left layout-view"> View as: <i class="fa fa-th selected" data-layout="4"></i> <i class="fa fa-th-large" data-layout="6"></i><i class="fa fa-list-ul" data-layout="12"></i> </p>
                    </div>
                </div>
            </header>

            <div class="container section-layout">
                <div class="row">
                    <!-- start section products -->
                    <div class="col-lg-4 col-sm-6 layout-item-wrap">
                        <article class="property layout-item clearfix">
                            <figure class="feature-image">
                                <a class="clearfix zoom" href="#">
                                    <img data-action="zoom" src="http://localhost/iea/images/Melbourne-appartement-loft-vendre.jpg" alt="Property Image">
                                </a>
                                <!-- <span class="btn btn-warning btn-sale">A vendre</span> -->
                            </figure>
                            <div class="property-contents clearfix">
                                <header class="property-header clearfix">
                                    <div class="pull-left">
                                        <h6 class="entry-title"><a href="id_ref015-melbourne-grand-appartement">melbourne - grand appartement</a></h6>
                                        <span class="property-location"><i class="fa fa-map-marker"></i>Melbourne,Australie</span>
                                    </div>
                                    </header>
                                    <button class="btn btn-default btn-price pull-right" data-hover="Détails">
                                        <strong>A$ 368 914,00</strong>
                                    </button>
                                <div class="property-meta clearfix">
                                    <span><i class="fa fa-arrows-alt"></i> 455 m2</span>
                                    <span><i class="fa fa-bed"></i> 2 lits</span>
                                    <span><i class="fa fa-bathtub"></i> 1 douche</span>
                                    <span><i class="fa fa-cab"></i> 1</span>
                                </div>
                                <div class="contents clearfix">
                                    <p>Le bâtiment de 31 niveaux situé à proximité des jardins historiques de Carlton et le meilleur de cbd a à offrir un design intérieur attrayant bâtiment contemporain. Bâtiment de style Resort. Les caractéristiques comprennent une salle de gym ciel, piscine de 25m, salon en plein air, les jardins sur le toit doivent voir des vues panoramiques. Doit voir design moderne Appartement dispose de 2 chambres de bonne taille égale avec BIR, 1 salle de bain et 1 espace de voiture. Comme vous entrez à votre gauche, cuisine gastronomique européenne avec des appareils Euro, banc de granit, Grande salle de bain combinaison de blanchisserie. Balcon confortable avec de belles vues sur la ville, salon / repas ouvert. La sécurité est importante pour la résidence. Les installations comprennent une piscine chauffée de 25 mètres, un spa et une salle de sport bien équipée pour rester en forme. Confortable style de vie de villégiature, terrasse sur le toit. Venez entrer dans ce hall élégant et inspecter cet appartement aujourd&#039;hui</p>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="col-lg-4 col-sm-6 layout-item-wrap">
                        <article class="property layout-item clearfix">
                            <figure class="feature-image">
                                <a class="clearfix zoom" href="#">
                                    <img data-action="zoom" src="http://localhost/iea/images/Melbourne_AUSTRALIE_Appartement.jpg" alt="Property Image">
                                </a>
                                <!-- <span class="btn btn-warning btn-sale">A vendre</span> -->
                            </figure>
                            <div class="property-contents clearfix">
                                <header class="property-header clearfix">
                                    <div class="pull-left">
                                        <h6 class="entry-title"><a href="id_ref014-melbourne-appartement">melbourne - appartement</a></h6>
                                        <span class="property-location"><i class="fa fa-map-marker"></i>Melbourne,Australie</span>
                                    </div>
                                    </header>
                                    <button class="btn btn-default btn-price pull-right" data-hover="Détails">
                                        <strong>A$ 296 448,00</strong>
                                    </button>
                                <div class="property-meta clearfix">
                                    <span><i class="fa fa-arrows-alt"></i> 450 m2</span>
                                    <span><i class="fa fa-bed"></i> 1 lits</span>
                                    <span><i class="fa fa-bathtub"></i> 1 douche</span>
                                    <span><i class="fa fa-cab"></i> non défini</span>
                                </div>
                                <div class="contents clearfix">
                                    <p>
Ce développement résidentiel exclusif à Melbourne CBD atteste de l&#039;engagement et du pedigree d&#039;UEM Sunrise pour offrir des espaces de vie de qualité qui résonnent avec la riche culture de Melbourne, ainsi que son statut de ville la plus vivable au monde. À seulement quelques pas d&#039;une sélection d&#039;universités, de boutiques, de lieux culturels et de restaurants réputés dans le monde entier, qui offre le dynamisme de la ville et une vaste gamme d&#039;options de transport, de connectivité et de tranquillité des jardins. Les établissements d&#039;enseignement réputés de Melbourne, tels que l&#039;université Royal Melbourne Institute of Technology (RMIT), se trouvent à environ 3 minutes à pied et l&#039;université de Melbourne se trouve à environ 15 minutes à pied du développement. Caractéristiques: Services de conciergerie Lap Pool &amp; Sun Deck Gynasium &amp; Yoga Zone Sauna et hammam Cinéma privé Simulateur de golf Private &amp; Social Jacuzzi Royal Banquet Room Rooftop Skypods Fosse BBQ avec terrasse et terrasse de divertissement</p>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="col-lg-4 col-sm-6 layout-item-wrap">
                        <article class="property layout-item clearfix">
                            <figure class="feature-image">
                                <a class="clearfix zoom" href="#">
                                    <img data-action="zoom" src="http://localhost/iea/images/Newport-Bureau.jpg" alt="Property Image">
                                </a>
                                <!-- <span class="btn btn-warning btn-sale">A vendre</span> -->
                            </figure>
                            <div class="property-contents clearfix">
                                <header class="property-header clearfix">
                                    <div class="pull-left">
                                        <h6 class="entry-title"><a href="id_ref011-newport-bureau">newport - bureau</a></h6>
                                        <span class="property-location"><i class="fa fa-map-marker"></i>Newport,Australie</span>
                                    </div>
                                    </header>
                                    <button class="btn btn-default btn-price pull-right" data-hover="Détails">
                                        <strong>A$ 303 036,00</strong>
                                    </button>
                                <div class="property-meta clearfix">
                                    <span><i class="fa fa-arrows-alt"></i> 400 m2</span>
                                    <span><i class="fa fa-bed"></i> non défini</span>
                                    <span><i class="fa fa-bathtub"></i> non défini</span>
                                    <span><i class="fa fa-cab"></i> non défini</span>
                                </div>
                                <div class="contents clearfix">
                                    <p>C&#039;est une opportunité à ne pas manquer. Travaillez au bord de la mer ... Cette suite bureau au bord de l&#039;eau donnant sur les magnifiques voies navigables de Pittwater est située dans la banlieue très prisée de Newport. Situé dans un lotissement résidentiel sécurisé, la suite bénéficie d&#039;une excellente lumière naturelle tout au long de la journée depuis les grandes baies vitrées qui donnent sur une vue dont vous ne serez jamais fatigué! Caractéristiques de la propriété: - Bureau de 41m² + Cour extérieure exclusive de 21m² - Bureau au bord de l&#039;eau - Suite magnifiquement présentable donnant sur Pittwater - Planchers de bois à l&#039;entrée - Système de climatisation indépendant - Développement sécurisé avec accès par ascenseur - Système d&#039;intercom et câblé - Parking unique sécurisé - &amp; kitchen En plus, il y a une opportunité d&#039;acquérir 9 Moorings pour une entreprise marine si nécessaire - 7 x situé à Winji Jimmi Bay, 1 x situé à Northern End of Scotland Island, 1 x situé à America&#039;s Bay</p>
                                </div>
                            </div>
                        </article>
                    </div>
                    <!-- end section products -->

                </div>
            </div>
        </section>
    </div>
@endsection