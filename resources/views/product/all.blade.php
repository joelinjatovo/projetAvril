@extends('layouts.app')

@section('content')

@include('includes.slider')

<div class="container">
    <header class="section-header text-center">
        <div class="container"><br><br>
            <h3 class="pull-left">Commercial - <small> 3 produits enregistrées </small></h3>
            <div class="pull-right">
                <div class="property-sorting pull-left">
                    <label for="property-sort-dropdown"> Nombre de produits à afficher:   </label>
                    <select name="property-sort-dropdown" id="property-sort-dropdown" onchange="showUser(this.value)">
                        <option value="10">10 produits</option>
                        <option value="20">20 produits</option>
                        <option value="50">50 produits</option>
                        <option value="100">100 produits</option>
                    </select>
                </div>
                <p class="pull-left layout-view">
                  Vue:
                  <i class="fa fa-th-large selected" data-layout="6"></i>
                  <i class="fa fa-list-ul" data-layout="12"></i> </p>
            </div>
        </div>
    </header>

<!-- breadcrumb     -->
    <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="http://localhost/iea">Accueil</a></li>
                  <li class="breadcrumb-item active">Commercial</li>
                </ol>

            </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-7">
            <div class="row" id="txtHint">

                                            <div class="col-md-6 layout-item-wrap">
                    <article class="property layout-item clearfix">
                        <figure class="feature-image">
                            <a class="clearfix zoom" href="single-property.html">
                                <img data-action="zoom" src="http://localhost/iea/images/Australie-Entrepôt.jpg" alt="..." width="350" height="233">
                            </a>
                        </figure>
                        <div class="property-contents clearfix">
                            <header class="property-header clearfix">
                                <div class="pull-left">
                                    <h6 class="entry-title"><a href="http://localhost/iea/produit/id_ref010-australie-entrepot">Australie - Entrepôt</a></h6>
                                    <span class="property-location"><i class="fa fa-map-marker"></i> Yarrawonga, Palmerston Territoire du Nord 0830, Australie</span>
                                </div>
                                </header>
                                <button class="btn btn-default btn-price pull-right">
                                    <strong>A$ 16 811,00</strong>
                                </button>
                            <div class="property-meta clearfix">
                                <span><i class="fa fa-arrows-alt"></i> 242 m2</span>
                                <span><i class="fa fa-bed"></i> non défini</span>
                                <span><i class="fa fa-bathtub"></i> non défini</span>
                                <span><i class="fa fa-cab"></i> non défini</span>
                            </div>
                            <div class="contents clearfix">
                                <p> Cette propriété est située juste en face de la route d&#039;où le nouveau magasin Bunnings est proposé d&#039;être construit. L&#039;entrepôt a une grande por... </p>
                            </div>
                            <div class="author-box clearfix">
                            </div>
                        </div>
                    </article>
                </div>
                                            <div class="col-md-6 layout-item-wrap">
                    <article class="property layout-item clearfix">
                        <figure class="feature-image">
                            <a class="clearfix zoom" href="single-property.html">
                                <img data-action="zoom" src="http://localhost/iea/images/Newport-Bureau.jpg" alt="..." width="350" height="233">
                            </a>
                        </figure>
                        <div class="property-contents clearfix">
                            <header class="property-header clearfix">
                                <div class="pull-left">
                                    <h6 class="entry-title"><a href="http://localhost/iea/produit/id_ref011-newport-bureau">Newport - Bureau</a></h6>
                                    <span class="property-location"><i class="fa fa-map-marker"></i> Newport 2106, Newport Nouvelle-Galles du Sud, Australie</span>
                                </div>
                                </header>
                                <button class="btn btn-default btn-price pull-right">
                                    <strong>A$ 303 036,00</strong>
                                </button>
                            <div class="property-meta clearfix">
                                <span><i class="fa fa-arrows-alt"></i> 400 m2</span>
                                <span><i class="fa fa-bed"></i> non défini</span>
                                <span><i class="fa fa-bathtub"></i> non défini</span>
                                <span><i class="fa fa-cab"></i> non défini</span>
                            </div>
                            <div class="contents clearfix">
                                <p> C&#039;est une opportunité à ne pas manquer. Travaillez au bord de la mer ... Cette suite bureau au bord de l&#039;eau donnant sur les magnifiques voies navig... </p>
                            </div>
                            <div class="author-box clearfix">
                            </div>
                        </div>
                    </article>
                </div>
                                            <div class="col-md-6 layout-item-wrap">
                    <article class="property layout-item clearfix">
                        <figure class="feature-image">
                            <a class="clearfix zoom" href="single-property.html">
                                <img data-action="zoom" src="http://localhost/iea/images/Melbourne-appartement-loft-vendre.jpg" alt="..." width="350" height="233">
                            </a>
                        </figure>
                        <div class="property-contents clearfix">
                            <header class="property-header clearfix">
                                <div class="pull-left">
                                    <h6 class="entry-title"><a href="http://localhost/iea/produit/id_ref015-melbourne-grand-appartement">Melbourne - Grand Appartement</a></h6>
                                    <span class="property-location"><i class="fa fa-map-marker"></i> Melbourne Victoria 3000, Australie</span>
                                </div>
                                </header>
                                <button class="btn btn-default btn-price pull-right">
                                    <strong>A$ 368 914,00</strong>
                                </button>
                            <div class="property-meta clearfix">
                                <span><i class="fa fa-arrows-alt"></i> 455 m2</span>
                                <span><i class="fa fa-bed"></i> 2 lits</span>
                                <span><i class="fa fa-bathtub"></i> 1 douche</span>
                                <span><i class="fa fa-cab"></i> 1</span>
                            </div>
                            <div class="contents clearfix">
                                <p>  </p>
                            </div>
                            <div class="author-box clearfix">
                            </div>
                        </div>
                    </article>
                </div>

                <!-- pagination -->
                <div class="col-md-12 layout-item-wrap">

                </div>
                <!-- end pagination -->

            </div>
        </div>
        <div class="col-lg-4 col-md-5">
            @include('includes.sidebar')
        </div>
    </div>
</div>
@endsection
