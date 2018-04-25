@extends('layouts.app')

@section('content')
@include('includes.slider')

<div class="container">
    <header class="section-header text-center">
        <div class="container"><br><br>
            <h3 class="pull-left">Résidentiel - <small> 6 produits enregistrées </small></h3>
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
              <li class="breadcrumb-item active">Résidentiel</li>
            </ol>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-7">
            <div class="row" id="txtHint">
                @foreach($items as $item)
                <div class="col-md-6 layout-item-wrap">
                    <article class="property layout-item clearfix">
                        <figure class="feature-image">
                            <a class="clearfix zoom" href="single-property.html">
                                <img data-action="zoom" src="http://localhost/iea/images/Surfers_Paradise.jpg" alt="..." width="350" height="233">
                            </a>
                        </figure>
                        <div class="property-contents clearfix">
                            <header class="property-header clearfix">
                                <div class="pull-left">
                                    <h6 class="entry-title"><a href="{{route('product.index',['product'=>$item])}}">Surfers Paradise - Appartement</a></h6>
                                    <span class="property-location"><i class="fa fa-map-marker"></i> 9 Hamilton Ave, Surfers Paradise QLD 4217, Australie</span>
                                </div>
                                </header>
                                <button class="btn btn-default btn-price pull-right">
                                    <strong>A$ 2 265 000,00</strong>
                                </button>
                            <div class="property-meta clearfix">
                                <span><i class="fa fa-arrows-alt"></i> 265 m2</span>
                                <span><i class="fa fa-bed"></i> 3 lits</span>
                                <span><i class="fa fa-bathtub"></i> 2 douche</span>
                                <span><i class="fa fa-cab"></i> non défini</span>
                            </div>
                            <div class="contents clearfix">
                                <p> Surfers Paradise - Appartement &amp; loft à vendre
                                    Australie&gt; Queensland&gt; Surfers Paradise
                                    1 500 000 EUR
                                    Appartement &amp; Loft (Vente)
                                    3 ch 2 sdb 265 ... </p>
                            </div>
                            <div class="author-box clearfix">
                            </div>
                        </div>
                    </article>
                </div>
                @endforeach
                <div class="col-md-12 layout-item-wrap">
                    {{$items->links()}}
                </div>

            </div>
        </div>
        <div class="col-lg-4 col-md-5">
            @include('includes.sidebar')
        </div>
    </div>
</div>

@endsection