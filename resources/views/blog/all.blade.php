@extends('layouts.app')

@section('content')
<div class="main-slider-wrapper clearfix content corps">
    @include('includes.breadcrumb')
</div>     

<div id="blog-listing" class="grid-style"> 
    <header class="section-header text-center"> 
        <div class="container"> 
            <h2 class="pull-left">Blog</h2> 
            <div class="pull-right"> 
                <div class="property-sorting pull-left"> 
                    <label for="property-sort-dropdown"> Trier par:   </label>                             
                    <select name="property-sort-dropdown" id="property-sort-dropdown"> 
                        <option value="croissant">Croissant </option>                                 
                        <option value="décroissant">Décroissant</option>                                 
                    </select>
                </div>                         
                <p class="pull-left layout-view"> Vue: <i class="fa fa-th-large selected" data-layout="6"></i> <i class="fa fa-list-ul" data-layout="12"></i> </p> 
            </div>                     
        </div>                 
    </header>  


    <div class="container">
        <div class="col-lg-9 col-md-8">
            <div class="row"> 
                <div id="filter-container">

                    <div class="col-md-6 layout-item-wrap mix a1">
                        <article class="blog-post clearfix layout-item"> 
                            <figure class="feature-image"> 
                                <a href="#" class="clearfix zoom">
                                    <img data-action="zoom" src="http://localhost/iea/images/1521219325.jpg" alt="Blog Image">
                                </a>                                         
                                <time class="updated btn btn-warning" datetime="2017-02-01T13:58Z">12 April</time>            
                            </figure>                                     
                            <div class="post-contents clearfix">
                                <h4 class="entry-title"><a href="http://localhost/iea/blog/detail/artcl4-nos-conseils-pour-mettre-en-valeur-sa-maison-pour-mieux-la-vendre">Nos conseils pour mettre en valeur sa maison pour mieux la vendre</a></h4> 
                                <div class="contents clearfix"> 
                                    Vendre une maison n’est pas une mince à faire, surtout si vous ne souhaitez pas avoir recours aux services d’une agence immobilière. Il faut ass...
                                </div>                                         
                                <footer class="post-footer post-meta clearfix"> 
                                    <span class="author">Posté par <a href="#"> Admin</a> </span> 
                                    <span>Comment <a href="#"> 23</a> </span> 
                                    <a href="http://localhost/iea/blog/detail/artcl4-nos-conseils-pour-mettre-en-valeur-sa-maison-pour-mieux-la-vendre" class="more">Continuer la lecture <i class="fa fa-angle-double-right"></i></a> 
                                </footer>
                            </div>                                     
                        </article>
                    </div>
                                                <div class="col-md-6 layout-item-wrap mix a1">
                        <article class="blog-post clearfix layout-item"> 
                            <figure class="feature-image"> 
                                <a href="#" class="clearfix zoom">
                                    <img data-action="zoom" src="http://localhost/iea/images/construire-pour-revendre.jpg" alt="Blog Image">
                                </a>                                         
                                <time class="updated btn btn-warning" datetime="2017-02-01T13:58Z">12 April</time>            
                            </figure>                                     
                            <div class="post-contents clearfix">
                                <h4 class="entry-title"><a href="http://localhost/iea/blog/detail/artcl5-construire-pour-revendre-ce-quil-faut-savoir">Construire pour revendre : ce qu’il faut savoir</a></h4> 
                                <div class="contents clearfix"> 
                                    <p>L’immobilier est et sera toujours une valeur sûre. Surtout que depuis peu, les crédits immobiliers sont plus accessibles pour tous les ménages...
                                </div>                                         
                                <footer class="post-footer post-meta clearfix"> 
                                    <span class="author">Posté par <a href="#"> Admin</a> </span> 
                                    <span>Comment <a href="#"> 23</a> </span> 
                                    <a href="http://localhost/iea/blog/detail/artcl5-construire-pour-revendre-ce-quil-faut-savoir" class="more">Continuer la lecture <i class="fa fa-angle-double-right"></i></a> 
                                </footer>
                            </div>                                     
                        </article>
                    </div>
                                                <div class="col-md-6 layout-item-wrap mix a1">
                        <article class="blog-post clearfix layout-item"> 
                            <figure class="feature-image"> 
                                <a href="#" class="clearfix zoom">
                                    <img data-action="zoom" src="http://localhost/iea/images/promotteur-immo.jpg" alt="Blog Image">
                                </a>                                         
                                <time class="updated btn btn-warning" datetime="2017-02-01T13:58Z">12 April</time>            
                            </figure>                                     
                            <div class="post-contents clearfix">
                                <h4 class="entry-title"><a href="http://localhost/iea/blog/detail/artcl6-zoom-sur-le-metier-de-promoteur-immobilier">Zoom sur le métier de promoteur immobilier</a></h4> 
                                <div class="contents clearfix"> 
                                    <p> L’immobilier est un secteur très vaste et pris en charge par de nombreuses personnes qui présentent des fonctions différentes à des responsa...
                                </div>                                         
                                <footer class="post-footer post-meta clearfix"> 
                                    <span class="author">Posté par <a href="#"> Admin</a> </span> 
                                    <span>Comment <a href="#"> 23</a> </span> 
                                    <a href="http://localhost/iea/blog/detail/artcl6-zoom-sur-le-metier-de-promoteur-immobilier" class="more">Continuer la lecture <i class="fa fa-angle-double-right"></i></a> 
                                </footer>
                            </div>                                     
                        </article>
                    </div>
                                                <div class="col-md-6 layout-item-wrap mix a1">
                        <article class="blog-post clearfix layout-item"> 
                            <figure class="feature-image"> 
                                <a href="#" class="clearfix zoom">
                                    <img data-action="zoom" src="http://localhost/iea/images/tout-savoir-contrat.jpg" alt="Blog Image">
                                </a>                                         
                                <time class="updated btn btn-warning" datetime="2017-02-01T13:58Z">12 April</time>            
                            </figure>                                     
                            <div class="post-contents clearfix">
                                <h4 class="entry-title"><a href="http://localhost/iea/blog/detail/artcl7-tout-savoir-sur-lassurance-pour-un-pret-immobilier">Tout savoir sur l’assurance pour un prêt immobilier</a></h4> 
                                <div class="contents clearfix"> 
                                    <p>Lorsque vous prenez un crédit immobilier, votre banquier vous parlera surement de l’assurance prêt immobilier. Votre banquier peut vous le réc...
                                </div>                                         
                                <footer class="post-footer post-meta clearfix"> 
                                    <span class="author">Posté par <a href="#"> Admin</a> </span> 
                                    <span>Comment <a href="#"> 23</a> </span> 
                                    <a href="http://localhost/iea/blog/detail/artcl7-tout-savoir-sur-lassurance-pour-un-pret-immobilier" class="more">Continuer la lecture <i class="fa fa-angle-double-right"></i></a> 
                                </footer>
                            </div>                                     
                        </article>
                    </div>
                                                <div class="col-md-6 layout-item-wrap mix a1">
                        <article class="blog-post clearfix layout-item"> 
                            <figure class="feature-image"> 
                                <a href="#" class="clearfix zoom">
                                    <img data-action="zoom" src="http://localhost/iea/images/louer-abordable.jpg" alt="Blog Image">
                                </a>                                         
                                <time class="updated btn btn-warning" datetime="2017-02-01T13:58Z">12 April</time>            
                            </figure>                                     
                            <div class="post-contents clearfix">
                                <h4 class="entry-title"><a href="http://localhost/iea/blog/detail/artcl1-nos-conseils-pour-mettre-en-valeur-sa-maison-pour-mieux-la-vendre">Nos conseils pour mettre en valeur sa maison pour mieux la vendre</a></h4> 
                                <div class="contents clearfix"> 
                                    Vendre une maison n’est pas une mince à faire, surtout si vous ne souhaitez pas avoir recours aux services d’une agence immobilière. Il faut ass...
                                </div>                                         
                                <footer class="post-footer post-meta clearfix"> 
                                    <span class="author">Posté par <a href="#"> Admin</a> </span> 
                                    <span>Comment <a href="#"> 23</a> </span> 
                                    <a href="http://localhost/iea/blog/detail/artcl1-nos-conseils-pour-mettre-en-valeur-sa-maison-pour-mieux-la-vendre" class="more">Continuer la lecture <i class="fa fa-angle-double-right"></i></a> 
                                </footer>
                            </div>                                     
                        </article>
                    </div>
                                                <div class="col-md-6 layout-item-wrap mix a1">
                        <article class="blog-post clearfix layout-item"> 
                            <figure class="feature-image"> 
                                <a href="#" class="clearfix zoom">
                                    <img data-action="zoom" src="http://localhost/iea/images/engagement-immobilier.jpg" alt="Blog Image">
                                </a>                                         
                                <time class="updated btn btn-warning" datetime="2017-02-01T13:58Z">12 April</time>            
                            </figure>                                     
                            <div class="post-contents clearfix">
                                <h4 class="entry-title"><a href="http://localhost/iea/blog/detail/artcl2-quel-est-le-premier-investissement-immobilier-ideal-pour-un-jeune-couple">Quel est le premier investissement immobilier idéal pour un jeune couple ?</a></h4> 
                                <div class="contents clearfix"> 
                                    <p>Que ce soit pour y vivre, ou pour en faire un complément de revenu, investir dans l’immobilier reste une valeur sûre. Pour un jeune couple, le ...
                                </div>                                         
                                <footer class="post-footer post-meta clearfix"> 
                                    <span class="author">Posté par <a href="#"> Admin</a> </span> 
                                    <span>Comment <a href="#"> 23</a> </span> 
                                    <a href="http://localhost/iea/blog/detail/artcl2-quel-est-le-premier-investissement-immobilier-ideal-pour-un-jeune-couple" class="more">Continuer la lecture <i class="fa fa-angle-double-right"></i></a> 
                                </footer>
                            </div>                                     
                        </article>
                    </div>

                </div>                         
            </div>                     

        </div>
        <div class="col-lg-3 col-md-4"> 
            @include('includes.sidebar')
        </div>
    </div>             
</div> 



@endsection
