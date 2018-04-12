@extends('layouts.app')

@section('content')
<div class="main-slider-wrapper clearfix content corps">
    @include('includes.breadcrumb')
</div>

<div class="container">
    <div class="col-sm-8"> 
        <article class="blog-post single-post"> 
            <figure class="feature-image"> 
                <img data-action="zoom" src="http://localhost/iea/images/tout-savoir-contrat.jpg" alt="Blog Image"> 
            </figure>                         
            <div class="post-footer post-meta clearfix">
                <time class="updated btn btn-warning" datetime="2017-02-01T13:58Z">
                    <p>12 April</p>
                </time>                             
                <h4 class="entry-title">Tout savoir sur l’assurance pour un prêt immobilier</h4> 
                <span class="author">Publié par&nbsp;<a href="#">Admin</a> </span> 
                <span>Commentaire<a href="#" style="font-size: inherit; background-color: rgb(255, 255, 255);">&nbsp;23</a><span style="float: none;">&nbsp;</span></span>
            </div>                         
            <div class="contents clearfix"> 
                <p>Lorsque vous prenez un crédit immobilier, votre banquier vous parlera surement de l’assurance prêt immobilier. Votre banquier peut vous le réclamer pour un prêt à taux zéro, pour un prêt relais ou pour tout autre type de prêt immobilier. Vous pouvez entendre et lire que cette assurance est obligatoire, ce qui n’est pas le cas. Nous allons vous apporter dans ce dossier plusieurs informations par rapport à ce sujet et vous présenter si elle est vraiment indispensable pour votre prêt.</p>
    <p>Lorsqu’on contracte un crédit immobilier et qu’on évoque l’assurance prêt immobilier ou l’assurance emprunteur correspondante, on se demande si elle est obligatoire. Nous tenons à souligner que contrairement à l’assurance auto ou l’assurance habitation, elle n’est pas légalement obligatoire, mais certains établissements bancaires et établissements financiers peuvent vous l’exiger.</p>
    <p>Depuis 2010 avec l’entrée en vigueur de la loi Lagarde, vous n’êtes pas obligé de prendre l’offre d’assurance proposée par votre prêteur, ce qui vous offre un libre choix de l’assurance-crédit qui vous convient, et ce, auprès d’un autre établissement. Dans certains cas, notamment ceux qui ont un patrimoine important, il est possible de contourner cette obligation de l’assurance prêt immobilier en mettant en garantie vos biens</p>
    <p>A quoi sert-elle ?</p>
    <p>Si certains établissements bancaires ou institutions financières exigent l’assurance crédit immobilier, c’est pour se protéger de toute défaillance de remboursement de son client. Il faut noter que cette assurance ne protège pas que l’organisme prêteur, car il couvre également le souscripteur de crédit.</p>                                                          
            </div>                         
            <footer class="post-footer post-footer-meta clearfix"> 
                <div class="tags pull-left">
                    <span>Tags:</span> 
                    Appartement, Grenier, Villa, Maison
                </div>                             
                <nav class="social-share">
                    <span>Partagé:</span> 
                    <ul class="social-icons clearfix"> 
                        <li>
                            <a href="https://twitter.com/intent/tweet/?url=http://localhost/iea/blog/detail/artcl7-tout-savoir-sur-lassurance-pour-un-pret-immobilier&text=Tout savoir sur l’assurance pour un prêt immobilier&via=investirenaustralie.com" target="_blank"><i class="fa fa-twitter"></i></a>
                        </li>                                     
                        <li>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=http://localhost/iea/blog/detail/artcl7-tout-savoir-sur-lassurance-pour-un-pret-immobilier" target="_blank"><i class="fa fa-facebook"></i></a>
                        </li>                                     
                        <li>
                            <a href="https://pinterest.com/pin/create/button/?url=http://localhost/iea/blog/detail/artcl7-tout-savoir-sur-lassurance-pour-un-pret-immobilier&media=http://localhost/iea/images/tout-savoir-contrat.jpg&description=Tout savoir sur l’assurance pour un prêt immobilier" target="_blank"><i class="fa fa-pinterest"></i></a>
                        </li>                                     
                        <li>
                            <a href="https://plus.google.com/share?url=http://localhost/iea/blog/detail/artcl7-tout-savoir-sur-lassurance-pour-un-pret-immobilier&hl=fr"><i class="fa fa-google"></i></a>
                        </li>                                     
                    </ul>
                </nav>                             
            </footer>                         
        </article>  

        <section id="comments"> 
            <h4 id="comments-title">Commentaires</h4>
            <ol class="commentlist">
                <li>@include('comment.index')</li>
                <li>@include('comment.index')</li>
            </ol>
            @include('comment.form')
            <!-- #respond -->                         
        </section>                     
    </div>
    <div class="col-lg-4 col-md-4"> 
        @include('includes.sidebar')
    </div>
    </div> 


@endsection
