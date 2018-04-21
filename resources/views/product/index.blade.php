@extends('layouts.app')

@section('content')
<div id="property-single">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7">
                <section class="property-meta-wrapper common">
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
                      <button class="btn btn-info" onclick="saveRechJS() "><i class="fa fa-floppy-o" aria-hidden="true"></i> Sauvegarder la recherche</button>
                      <button class="btn btn-success"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i>choisir un APL</button>
                    </p>
                </section>
                <section class="property-meta-wrapper common">
                    <h3 class="entry-title">surfers paradise - appartement</h3>
                    <div class="property-single-meta">
                        <ul class="clearfix">
                            <li><span>Superficie:</span> 265 m2</li>
                            <li><span>Réference_ID:</span> ID_REF001</li>
                            <li><span>Chambres:</span> 3 lits</li>
                            <li><span>Salle de bain:</span> 2 douche</li>
                            <li><span>Garage:</span> non défini</li>
                            <li><span>Publication du</span> 2016-01-09</li>
                            <li><span>Prix:</span> A$ 2 265 000,00</li>
                            <li><span>Parking:</span> Non</li>
                            <li><span>Piscine:</span> 1</li>
                            <li><span>Adresse:</span> 9 Hamilton Ave, Surfers Paradise QLD 4217, Australie</li>
                        </ul>
                    </div>
                </section>
                <section class="property-contents common">
                    <div class="entry-title clearfix">
                        <h4 class="pull-left">Description </h4><a class="pull-right print-btn" href="javascript:window.print()">Print This Property <i class="fa fa-print"></i></a>
                    </div>
                    <p>
    Surfers Paradise - Appartement & loft à vendre
    Australie> Queensland> Surfers Paradise
    1 500 000 EUR
    Appartement & Loft (Vente)
    3 ch 2 sdb 265 m²
    Cet appartement de 3 chambres de taille généreuse bénéficie d'une impression de sol de 265m2. Une suite parentale de taille presque égale à celle du salon et couplée à une robe de chambre connectée à la salle de bain garantit à ceux qui le désirent un bon goût de vie en appartement. Pour le plat principal, le côté nord de la Gold Coast vous permettra de profiter d'une vue alléchante sur la magnifique Broadwater, de superbes toits de la ville animés par la vie et de vues sereines ininterrompues sur l'océan depuis le salon! Entièrement équipée avec cuisinière à gaz et table de pique-nique, la vue sur l'océan encapsulant de la cuisine fait pour une expérience culinaire merveilleuse pour les amis, la famille ou les invités! Plus de fonctionnalités comprennent une salle d'eau, une buanderie séparée, une climatisation entièrement canalisée, une salle multimédia et 2 parkings. Un investissement incroyable ou incroyable en live! Caractéristiques et installations du bâtiment Q1: Concierge / Tour Booking Desk. Club des résidents, salles de réception et installations de conférence. Cinéma / cinéma interne. Deux piscines extérieures / lagunes. Une piscine intérieure chauffée. Spa intérieur. Salles de vapeur intérieures et saunas. Gymnase entièrement équipé. Salle de jeux. Célèbre Longboards Café et Pool Bar. Gestion sur site. Sécurité totale. Animaux acceptés. Zone de vente au détail avec dépanneur. Minutes à pied de la plage de baignade. Minutes à pied de Surfers Paradise avec des boutiques, des restaurants et plus</p>
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

                <section id="property-listing">
                    <header class="section-header text-center">
                        <div class="container">
                            <h2 class="pull-left">Derniers produits enregistrés</h2>
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


                            <div class="col-lg-4 col-sm-6 layout-item-wrap">
                                <article class="property layout-item clearfix">
                                    <figure class="feature-image">
                                        <a class="clearfix zoom" href="#">
                                            <img data-action="zoom" src="http://localhost/iea/images/Australie-Entrepôt.jpg" alt="Property Image">
                                        </a>
                                        <!-- <span class="btn btn-warning btn-sale">A vendre</span> -->
                                    </figure>
                                    <div class="property-contents clearfix">
                                        <header class="property-header clearfix">
                                            <div class="pull-left">
                                                <h6 class="entry-title"><a href="id_ref010-"></a></h6>
                                                <span class="property-location"><i class="fa fa-map-marker"></i>Yarrawonga,Australie</span>
                                            </div>
                                            </header>
                                            <button class="btn btn-default btn-price pull-right" data-hover="Détails">
                                                <strong>A$ 16 811,00</strong>
                                            </button>
                                        <div class="property-meta clearfix">
                                            <span><i class="fa fa-arrows-alt"></i> 242 m2</span>
                                            <span><i class="fa fa-bed"></i> non défini</span>
                                            <span><i class="fa fa-bathtub"></i> non défini</span>
                                            <span><i class="fa fa-cab"></i> non défini</span>
                                        </div>
                                        <div class="contents clearfix">
                                            <p>Cette propriété est située juste en face de la route d&#039;où le nouveau magasin Bunnings est proposé d&#039;être construit. L&#039;entrepôt a une grande porte de rouleau de 6x6m pour la facilité d&#039;accès. Il y a suffisamment de place à l&#039;intérieur avec une hauteur centrale de 8m et une hauteur d&#039;avant-toit de 6m, la remise est claire. Un grand parking est disponible. Il y a aussi une abondance de puissance disponible avec 240 volts et 3 phases. * La superficie totale est de 242m2.</p>
                                        </div>
                                    </div>
                                </article>
                            </div>


                            <div class="col-lg-4 col-sm-6 layout-item-wrap">
                                <article class="property layout-item clearfix">
                                    <figure class="feature-image">
                                        <a class="clearfix zoom" href="#">
                                            <img data-action="zoom" src="http://localhost/iea/images/Bangholme-Bureau-commercial.jpg" alt="Property Image">
                                        </a>
                                        <!-- <span class="btn btn-warning btn-sale">A vendre</span> -->
                                    </figure>
                                    <div class="property-contents clearfix">
                                        <header class="property-header clearfix">
                                            <div class="pull-left">
                                                <h6 class="entry-title"><a href="id_ref009-bangholme-bureau">bangholme - bureau</a></h6>
                                                <span class="property-location"><i class="fa fa-map-marker"></i>Dandenong South,Australie</span>
                                            </div>
                                            </header>
                                            <button class="btn btn-default btn-price pull-right" data-hover="Détails">
                                                <strong>A$ 447 967,00</strong>
                                            </button>
                                        <div class="property-meta clearfix">
                                            <span><i class="fa fa-arrows-alt"></i> 484 m2</span>
                                            <span><i class="fa fa-bed"></i> non défini</span>
                                            <span><i class="fa fa-bathtub"></i> non défini</span>
                                            <span><i class="fa fa-cab"></i> non défini</span>
                                        </div>
                                        <div class="contents clearfix">
                                            <p>
    Une chance rare de posséder cette usine / entrepôt, il conviendra à une variété d&#039;occupants / affaires. Situation centrale accès facile à toutes les principales artères et autoroutes, un grand parking à l&#039;arrière et large route excellente pour l&#039;accès des gros camions. Caractéristiques du bâtiment comprennent: -3 bureaux-cuisine / salle à manger, toilettes -Hauteur volet roulant -Grande puissance -Parking à l&#039;arrière -Area de 484m2 env.</p>
                                        </div>
                                    </div>
                                </article>
                            </div>


                            <div class="col-lg-4 col-sm-6 layout-item-wrap">
                                <article class="property layout-item clearfix">
                                    <figure class="feature-image">
                                        <a class="clearfix zoom" href="#">
                                            <img data-action="zoom" src="http://localhost/iea/images/Bridgewater-Terrain.jpg" alt="Property Image">
                                        </a>
                                        <!-- <span class="btn btn-warning btn-sale">A vendre</span> -->
                                    </figure>
                                    <div class="property-contents clearfix">
                                        <header class="property-header clearfix">
                                            <div class="pull-left">
                                                <h6 class="entry-title"><a href="id_ref008-bridgewater-terrain">bridgewater - terrain</a></h6>
                                                <span class="property-location"><i class="fa fa-map-marker"></i>Bridgewater,Australie</span>
                                            </div>
                                            </header>
                                            <button class="btn btn-default btn-price pull-right" data-hover="Détails">
                                                <strong>A$ 32 280,00</strong>
                                            </button>
                                        <div class="property-meta clearfix">
                                            <span><i class="fa fa-arrows-alt"></i> 762 m2</span>
                                            <span><i class="fa fa-bed"></i> non défini</span>
                                            <span><i class="fa fa-bathtub"></i> non défini</span>
                                            <span><i class="fa fa-cab"></i> non défini</span>
                                        </div>
                                        <div class="contents clearfix">
                                            <p>
    Ce bloc de construction serait l&#039;un des meilleurs blocs à gauche dans la région. Prendre des vues sensationnelles du pont Bridgewater et au-delà dans une direction et des vues du mont Wellington et au-delà dans l&#039;autre sens. Avec une superficie approximative de 762 m2, ce terrain est assez grand pour construire la maison de vos rêves ou construire plusieurs unités (STCA). Il y a une réserve du Conseil à la droite de la propriété et elle aura des vues qui ne seront jamais perdues. Les bus ne sont qu&#039;à quelques pas. Il y a des écoles et de nombreux magasins, y compris les grands supermarchés à seulement quelques minutes. Si vous cherchez un bloc avec des vues incroyables, alors c&#039;est ici</p>
                                        </div>
                                    </div>
                                </article>
                            </div>


                            <div class="col-lg-4 col-sm-6 layout-item-wrap">
                                <article class="property layout-item clearfix">
                                    <figure class="feature-image">
                                        <a class="clearfix zoom" href="#">
                                            <img data-action="zoom" src="http://localhost/iea/images/Tugun-terrain.jpg" alt="Property Image">
                                        </a>
                                        <!-- <span class="btn btn-warning btn-sale">A vendre</span> -->
                                    </figure>
                                    <div class="property-contents clearfix">
                                        <header class="property-header clearfix">
                                            <div class="pull-left">
                                                <h6 class="entry-title"><a href="id_ref007-tugun-terrain">tugun - terrain</a></h6>
                                                <span class="property-location"><i class="fa fa-map-marker"></i>Piggabeen,Australie</span>
                                            </div>
                                            </header>
                                            <button class="btn btn-default btn-price pull-right" data-hover="Détails">
                                                <strong>A$ 1 121 100,00</strong>
                                            </button>
                                        <div class="property-meta clearfix">
                                            <span><i class="fa fa-arrows-alt"></i> 80 937 m2</span>
                                            <span><i class="fa fa-bed"></i> non défini</span>
                                            <span><i class="fa fa-bathtub"></i> non défini</span>
                                            <span><i class="fa fa-cab"></i> non défini</span>
                                        </div>
                                        <div class="contents clearfix">
                                            <p>
    Offert à la vente, un terrain de 20 acres situé à proximité de tout le Tweed a à offrir. Pittoresque avec la façade de l&#039;eau à Piggabeen Creek, la propriété a un potentiel incroyable pour le développement futur. * 20 acres * Emplacement idéal et endroit où vivre * Derrière / Ouest de l&#039;aéroport de Coolangatta (pas sous aucune trajectoire de vol) * 10-15 minutes de l&#039;aéroport de Coolangatta et des plages. * 400 mètres de front de mer de marée &quot;Piggabeen Creek&quot; Utilisation du terrain: * Tourisme écologique, cheval, terrain de golf, etc .. * Développement futur &quot;Potentiel incroyable&quot;</p>
                                        </div>
                                    </div>
                                </article>
                            </div>


                            <div class="col-lg-4 col-sm-6 layout-item-wrap">
                                <article class="property layout-item clearfix">
                                    <figure class="feature-image">
                                        <a class="clearfix zoom" href="#">
                                            <img data-action="zoom" src="http://localhost/iea/images/Mount-Barker-australie-2.jpg" alt="Property Image">
                                        </a>
                                        <!-- <span class="btn btn-warning btn-sale">A vendre</span> -->
                                    </figure>
                                    <div class="property-contents clearfix">
                                        <header class="property-header clearfix">
                                            <div class="pull-left">
                                                <h6 class="entry-title"><a href="id_ref006-mount-barker-terrain">mount barker - terrain</a></h6>
                                                <span class="property-location"><i class="fa fa-map-marker"></i>Mount Barker,Australie</span>
                                            </div>
                                            </header>
                                            <button class="btn btn-default btn-price pull-right" data-hover="Détails">
                                                <strong>A$ 270 000,00</strong>
                                            </button>
                                        <div class="property-meta clearfix">
                                            <span><i class="fa fa-arrows-alt"></i> 350 m2</span>
                                            <span><i class="fa fa-bed"></i> non défini</span>
                                            <span><i class="fa fa-bathtub"></i> non défini</span>
                                            <span><i class="fa fa-cab"></i> non défini</span>
                                        </div>
                                        <div class="contents clearfix">
                                            <p>
    C&#039;est une offre unique de terrains vacants. Idéalement situé dans une magnifique rue bordée d&#039;arbres, ce lotissement de près de 350 m² est situé à quelques pas des magasins, cabinets médicaux, banques, écoles et transports. Actuellement zoné «Résidentiel». Le conseil envisagera une utilisation à la maison ou au bureau. Il est presque impossible d&#039;obtenir une allocation centrale comme celle-ci au Mont Barker aujourd&#039;hui, alors ne tardez pas!
    </p>
                                        </div>
                                    </div>
                                </article>
                            </div>


                            <div class="col-lg-4 col-sm-6 layout-item-wrap">
                                <article class="property layout-item clearfix">
                                    <figure class="feature-image">
                                        <a class="clearfix zoom" href="#">
                                            <img data-action="zoom" src="http://localhost/iea/images/Redland-Bay.jpg" alt="Property Image">
                                        </a>
                                        <!-- <span class="btn btn-warning btn-sale">A vendre</span> -->
                                    </figure>
                                    <div class="property-contents clearfix">
                                        <header class="property-header clearfix">
                                            <div class="pull-left">
                                                <h6 class="entry-title"><a href="id_ref005-redland-bay-terrain">redland bay - terrain</a></h6>
                                                <span class="property-location"><i class="fa fa-map-marker"></i>MacLeay Island,Australie</span>
                                            </div>
                                            </header>
                                            <button class="btn btn-default btn-price pull-right" data-hover="Détails">
                                                <strong>A$ 25 000,00</strong>
                                            </button>
                                        <div class="property-meta clearfix">
                                            <span><i class="fa fa-arrows-alt"></i> 658 m2</span>
                                            <span><i class="fa fa-bed"></i> non défini</span>
                                            <span><i class="fa fa-bathtub"></i> non défini</span>
                                            <span><i class="fa fa-cab"></i> non défini</span>
                                        </div>
                                        <div class="contents clearfix">
                                            <p>
    Ce bloc résidentiel de 658 m2 est merveilleusement positionné, pratique pour le club de golf, les boutiques locales et la jetée de Macleay Island et le centre d&#039;affaires principal. Le bloc est complètement dégagé, pentes doucement de la route pavée, n&#039;a pas de problèmes de drainage, est clôturé sur 2 côtés et a actuellement des vues sur le terrain de golf à l&#039;arrière. Macleay Island offre un style de vie unique, avec une atmosphère de village convivial, un environnement de parc marin pittoresque et avec les magasins, clubs et services essentiels ici sur l&#039;île prêt pour que vous appréciiez</p>
                                        </div>
                                    </div>
                                </article>
                            </div>

                                                            <!-- end section products -->

                        </div>
                        <ul id="pagination" class="text-center clearfix">
                            <li class="disabled">
                                <a href="#">Précedent</a>
                            </li>
                            <li>
                                <a href="#">2</a>
                            </li>
                            <li>
                                <a href="#">3</a>
                            </li>
                            <li>
                                <a href="#">4</a>
                            </li>
                            <li>
                                <a href="#">Suivant</a>
                            </li>
                        </ul>
                    </div>
    </section>
            </div>
             <div class="col-lg-4 col-md-5">
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
                        <p>
                          <button class="btn btn-info"><i class="fa fa-share-alt" aria-hidden="true"></i> Partager</button><br/>
                        </p>
                        <p>
                          <button class="btn btn-success"><i class="fa fa-envelope-open-o" aria-hidden="true"></i> contacter l'agence</button><br/>
                        </p>
                        <p>
                          <button class="btn btn-warning"><i class="fa fa-shopping-cart" aria-hidden="true"></i> je veux acheter ce produit</button><br/>
                        </p>
                        <p>
                          <button class="btn btn-primary" onclick="putFavorisJS()"><i class="fa fa-star" aria-hidden="true"></i> Favoris</button><br/>
                        </p>
                    </section>
                    </section>
                    <section class="widget recent-properties clearfix">
                        <h5 class="title">Récents</h5>
                        <div class="property clearfix">
                            <a href="#" class="feature-image zoom">
                                <img data-action="zoom" src="http://localhost/iea/public/assets/images/property/1.jpg" alt="Property Image">
                            </a>
                            <div class="property-contents">
                                <h6 class="entry-title"><a href="single-property.html">Maison familiale luxe</a></h6>
                                <span class="btn-price">$389.000</span>
                                <div class="property-meta clearfix">
                                    <span><i class="fa fa-arrows-alt"></i> 3060 SqFt</span>
                                    <span><i class="fa fa-bed"></i> 3 Beds</span>
                                    <span><i class="fa fa-bathtub"></i> 3 Baths</span>
                                    <span><i class="fa fa-cab"></i> Yes</span>
                                </div>
                            </div>
                        </div>
                        <div class="property clearfix">
                            <a href="#" class="feature-image zoom">
                                <img data-action="zoom" src="http://localhost/iea/public/assets/images/property/2.jpg" alt="Property Image">
                            </a>
                            <div class="property-contents">
                                <h6 class="entry-title"><a href="single-property.html">Maison familiale luxe</a></h6>
                                <span class="btn-price">$389.000</span>
                                <div class="property-meta clearfix">
                                    <span><i class="fa fa-arrows-alt"></i> 3060 SqFt</span>
                                    <span><i class="fa fa-bed"></i> 3 Beds</span>
                                    <span><i class="fa fa-bathtub"></i> 3 Baths</span>
                                    <span><i class="fa fa-cab"></i> Yes</span>
                                </div>
                            </div>
                        </div>
                        <div class="property clearfix">
                            <a href="#" class="feature-image zoom">
                                <img data-action="zoom" src="http://localhost/iea/public/assets/images/property/3.jpg" alt="Property Image">
                            </a>
                            <div class="property-contents">
                                <h6 class="entry-title"><a href="single-property.html">Maison familiale luxe</a></h6>
                                <span class="btn-price">$389.000</span>
                                <div class="property-meta clearfix">
                                    <span><i class="fa fa-arrows-alt"></i> 3060 SqFt</span>
                                    <span><i class="fa fa-bed"></i> 3 Beds</span>
                                    <span><i class="fa fa-bathtub"></i> 3 Baths</span>
                                    <span><i class="fa fa-cab"></i> Yes</span>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="widget property-taxonomies clearfix">
                        <h5 class="title">Status récents</h5>
                        <ul class="clearfix">
                            <li>
                                <a href="#">à louer </a>
                                <span class="pull-right">29</span>
                            </li>
                            <li>
                                <a href="#">à vendre </a>
                                <span class="pull-right">35</span>
                            </li>
                            <li>
                                <a href="#">Bureau à louer </a>
                                <span class="pull-right">07</span>
                            </li>
                        </ul>
                    </section>
                    <section class="widget property-taxonomies clearfix">
                        <h5 class="title">Types récents</h5>
                        <ul class="clearfix">
                            <li>
                                <a href="#">Apartement </a>
                                <span class="pull-right">30</span>
                            </li>
                            <li>
                                <a href="#">Grenier </a>
                                <span class="pull-right">05</span>
                            </li>
                            <li>
                                <a href="#">Maison unifamiliale </a>
                                <span class="pull-right">28</span>
                            </li>
                            <li>
                                <a href="#">Villa </a>
                                <span class="pull-right">37</span>
                            </li>
                        </ul>
                    </section>
                </div>
            </div>
        </div>
    </div>
    </div>


    <div id="blog-listing" class="grid-style">
    <section class="section-header text-center">
        <div class="container">
        <h2 class="pull-left">Les Derniers articles enregistrés</h2>
            <div class="pull-right">
                <div class="property-sorting pull-left">
                    <label for="property-sort-dropdown"> Sort by:   </label>
                    <select name="property-sort-dropdown" id="property-sort-dropdown">
                        <option value="">Default Order</option>
                        <option value="by_date">By date</option>
                        <option value="by_price">By price</option>
                    </select>
                </div>
                <p class="pull-left layout-view"> View as: <i class="fa fa-th selected" data-layout="4"></i> <i class="fa fa-th-large" data-layout="6"></i><i class="fa fa-list-ul" data-layout="12"></i> </p>
            </div>
        </div>
    </section>


    <div class="container">
        <div class="row">
            <div id="filter-container">
                                    <div class='col-md-4 col-sm-6 layout-item-wrap mix a1'><article class="blog-post clearfix layout-item">
                    <figure class="feature-image">
                        <a href="single.html" class="clearfix zoom"><img data-action="zoom" src="http://localhost/iea/images/construire-pour-revendre.jpg" alt="..."></a>
                        <!-- <time class="updated btn btn-warning" datetime="2017-02-01T13:58Z">20 April</time> -->
                    </figure>
                    <div class="post-contents clearfix">
                        <h5 class="entry-title"><a href="http://localhost/iea/blog/detail/artcl5-construire-pour-revendre-ce-quil-faut-savoir">Construire pour revendre : ce qu’il faut savoir</a></h5>
                        <div class="contents clearfix">
                            <p>L’immobilier est et sera toujours une valeur sûre. Surtout que depuis peu, les crédits immobiliers sont plus accessibles pour tous les ménages...
                        </div>
                        <footer class="post-footer post-meta clearfix">
                            <span class="author">Poster par <a href="#"> Admin</a>  </span>
                            <span>Comment <a href="#"> 23</a> </span>
                            <a href="http://localhost/iea/blog/detail/artcl5-construire-pour-revendre-ce-quil-faut-savoir" class="more">Continuer la lecture <i class="fa fa-angle-double-right"></i></a>
                        </footer>
                    </div>
                </article>
                </div>
                                    <div class='col-md-4 col-sm-6 layout-item-wrap mix a1'><article class="blog-post clearfix layout-item">
                    <figure class="feature-image">
                        <a href="single.html" class="clearfix zoom"><img data-action="zoom" src="http://localhost/iea/images/promotteur-immo.jpg" alt="..."></a>
                        <!-- <time class="updated btn btn-warning" datetime="2017-02-01T13:58Z">20 April</time> -->
                    </figure>
                    <div class="post-contents clearfix">
                        <h5 class="entry-title"><a href="http://localhost/iea/blog/detail/artcl6-zoom-sur-le-metier-de-promoteur-immobilier">Zoom sur le métier de promoteur immobilier</a></h5>
                        <div class="contents clearfix">
                            <p> L’immobilier est un secteur très vaste et pris en charge par de nombreuses personnes qui présentent des fonctions différentes à des responsa...
                        </div>
                        <footer class="post-footer post-meta clearfix">
                            <span class="author">Poster par <a href="#"> Admin</a>  </span>
                            <span>Comment <a href="#"> 23</a> </span>
                            <a href="http://localhost/iea/blog/detail/artcl6-zoom-sur-le-metier-de-promoteur-immobilier" class="more">Continuer la lecture <i class="fa fa-angle-double-right"></i></a>
                        </footer>
                    </div>
                </article>
                </div>
                                    <div class='col-md-4 col-sm-6 layout-item-wrap mix a1'><article class="blog-post clearfix layout-item">
                    <figure class="feature-image">
                        <a href="single.html" class="clearfix zoom"><img data-action="zoom" src="http://localhost/iea/images/tout-savoir-contrat.jpg" alt="..."></a>
                        <!-- <time class="updated btn btn-warning" datetime="2017-02-01T13:58Z">20 April</time> -->
                    </figure>
                    <div class="post-contents clearfix">
                        <h5 class="entry-title"><a href="http://localhost/iea/blog/detail/artcl7-tout-savoir-sur-lassurance-pour-un-pret-immobilier">Tout savoir sur l’assurance pour un prêt immobilier</a></h5>
                        <div class="contents clearfix">
                            <p>Lorsque vous prenez un crédit immobilier, votre banquier vous parlera surement de l’assurance prêt immobilier. Votre banquier peut vous le réc...
                        </div>
                        <footer class="post-footer post-meta clearfix">
                            <span class="author">Poster par <a href="#"> Admin</a>  </span>
                            <span>Comment <a href="#"> 23</a> </span>
                            <a href="http://localhost/iea/blog/detail/artcl7-tout-savoir-sur-lassurance-pour-un-pret-immobilier" class="more">Continuer la lecture <i class="fa fa-angle-double-right"></i></a>
                        </footer>
                    </div>
                </article>
                </div>
                                    <div class='col-md-4 col-sm-6 layout-item-wrap mix a1'><article class="blog-post clearfix layout-item">
                    <figure class="feature-image">
                        <a href="single.html" class="clearfix zoom"><img data-action="zoom" src="http://localhost/iea/images/louer-abordable.jpg" alt="..."></a>
                        <!-- <time class="updated btn btn-warning" datetime="2017-02-01T13:58Z">20 April</time> -->
                    </figure>
                    <div class="post-contents clearfix">
                        <h5 class="entry-title"><a href="http://localhost/iea/blog/detail/artcl1-nos-conseils-pour-mettre-en-valeur-sa-maison-pour-mieux-la-vendre">Nos conseils pour mettre en valeur sa maison pour mieux la vendre</a></h5>
                        <div class="contents clearfix">
                            Vendre une maison n’est pas une mince à faire, surtout si vous ne souhaitez pas avoir recours aux services d’une agence immobilière. Il faut ass...
                        </div>
                        <footer class="post-footer post-meta clearfix">
                            <span class="author">Poster par <a href="#"> Admin</a>  </span>
                            <span>Comment <a href="#"> 23</a> </span>
                            <a href="http://localhost/iea/blog/detail/artcl1-nos-conseils-pour-mettre-en-valeur-sa-maison-pour-mieux-la-vendre" class="more">Continuer la lecture <i class="fa fa-angle-double-right"></i></a>
                        </footer>
                    </div>
                </article>
                </div>
                                    <div class='col-md-4 col-sm-6 layout-item-wrap mix a1'><article class="blog-post clearfix layout-item">
                    <figure class="feature-image">
                        <a href="single.html" class="clearfix zoom"><img data-action="zoom" src="http://localhost/iea/images/engagement-immobilier.jpg" alt="..."></a>
                        <!-- <time class="updated btn btn-warning" datetime="2017-02-01T13:58Z">20 April</time> -->
                    </figure>
                    <div class="post-contents clearfix">
                        <h5 class="entry-title"><a href="http://localhost/iea/blog/detail/artcl2-quel-est-le-premier-investissement-immobilier-ideal-pour-un-jeune-couple">Quel est le premier investissement immobilier idéal pour un jeune cou...</a></h5>
                        <div class="contents clearfix">
                            <p>Que ce soit pour y vivre, ou pour en faire un complément de revenu, investir dans l’immobilier reste une valeur sûre. Pour un jeune couple, le ...
                        </div>
                        <footer class="post-footer post-meta clearfix">
                            <span class="author">Poster par <a href="#"> Admin</a>  </span>
                            <span>Comment <a href="#"> 23</a> </span>
                            <a href="http://localhost/iea/blog/detail/artcl2-quel-est-le-premier-investissement-immobilier-ideal-pour-un-jeune-couple" class="more">Continuer la lecture <i class="fa fa-angle-double-right"></i></a>
                        </footer>
                    </div>
                </article>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection