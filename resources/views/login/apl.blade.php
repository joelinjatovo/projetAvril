@extends('layouts.app')

@section('style')
<style>
.modal {
    display: none;
    overflow: scroll;
    position: fixed;
    top: 0px;
}
</style>
@endsection

@section('content')
<div id="site-header-top"></div>
<div id="property-single">
    <h1 class="page-title aligncenter">Formulaire d'inscription d'Agence Partenaire Locale</h1>
</div>

<div class="container">
    <div class="row">
            <div class="col-md-12">
                <div id="content">
                    <div role="main">
                        <div id="breadcrumbs" class="group font-size-14">
                            <div class="breadcrumb">
                                <a href="https://www.propertyhq.com.au/">Accueil</a>
                                <span class="aquo">&gt;</span> Formulaire d'inscription d'Agence Partenaire Locale
                            </div>
                        </div>
                        <div id="entry" class="group">
                            <h4 class="page-title aligncenter">Formulaire d'inscription </h4><br>
                            <div class="hasfloat">

                                <form class="zoowidget-form" method="post" action="/inscrire" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type="hidden" name="type" value="APL">
                                    <fieldset>
                                        <legend>Details de l'APL</legend>
                                        <ol>
                                          <li>
                                            <label for="form_agency_name">Nom de l'APL</label>
                                            <input type="text" name="nom" id="form_agency_name" value="" required>
                                          </li>
                                          <li>
                                            <label for="form_street_address">Adresse de l'APL</label>
                                            <input type="text" name="adresse" id="form_street_address" value="" required>
                                          </li>
                                          <li>
                                            <label for="form_suburb">Ville</label>
                                            <input type="text" name="ville" id="form_suburb" value="" required>
                                          </li>
                                          <li>
                                            <label for="form_state">si Etat fédéral</label>
                                            <input type="text" name="etat" id="form_state" value="" required>
                                          </li>
                                          <li>
                                            <label for="form_postcode">code postal</label>
                                            <input type="text" name="codePostal" id="form_postcode" value="" required>
                                          </li>
                                          <li>
                                            <label for="form_agency_email">Email de l'Entreprise</label>
                                            <input type="text" name="email" id="form_agency_email" value="" required>
                                          </li>
                                          <li>
                                            <label for="form_agency_phone">Business Phone</label>
                                            <input type="text" name="telephone" id="form_agency_phone" value="" required>
                                          </li>
                                          <li>
                                            <label for="form_agency_logo">Business Logo</label>
                                            <input type="file" name="logo" id="form_agency_logo" value="">
                                          </li>
                                        </ol>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Contacts de l'Entreprise</legend>
                                        <ol>
                                          <li>
                                            <label for="form_contact_name">Nom du Contact</label>
                                            <input type="text" name="nomContact" id="form_contact_name" value="" required>
                                          </li>
                                          <li>
                                            <label for="form_contact_email">Email du Contact</label>
                                            <input type="text" name="emailContact" id="form_contact_email" value="" required>
                                          </li>
                                          <li>
                                            <label for="form_contact_mobile">Tel Mobile</label>
                                            <input type="text" name="telContact" id="form_contact_mobile" value="" required>
                                          </li>
                                        </ol>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Pays :</legend>
                                        <ol>
                                            <li>
                                                <select name="pays" id="">
                                                <?php   for( $i=0; $i< count($pays) ; $i++){  ?>
                                                    <option value="<?php echo $pays[$i]; ?>"> <?php echo $pays[$i]; ?></option>
                                                <?php  } ?>
                                                </select>
                                            </li>
                                        </ol>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Language :</legend>
                                        <ol>
                                            <li>
                                                <select name="langue" >
                                                    <option value="fr"> &nbsp; Français</option>
                                                    <option value="eng"> &nbsp; Anglais</option>
                                                </select>
                                            </li>
                                        </ol>
                                    </fieldset>
                                        <fieldset>
                                          <legend>Opérabilité : </legend>
                                          <ol>
                                            <li>
                                                <select name="operabilite">
                                                    <option value="10"> &nbsp; 10 km</option>
                                                    <option value="25"> &nbsp; 25 km</option>
                                                    <option value="50"> &nbsp; 50 km</option>
                                                    <option value="100"> &nbsp; 100 km</option>
                                                    <option value="250"> &nbsp; 250 km</option>
                                                    <option value="all"> &nbsp; Dans tous les territoires et Etats légales</option>
                                                </select>
                                            </li>
                                          </ol>
                                        </fieldset>
                                        <fieldset>
                                          <legend>Présentation de l'A.P.L : </legend>
                                          <ol>
                                            <li>
                                                <textarea class="form-control" name="presentationAPL" onkeyup="textLimit(this, 2000);">

                                                </textarea>
                                            </li>
                                          </ol>
                                        </fieldset>
                                        <fieldset>
                                          <legend>Réference bancaire</legend>
                                          <ol>
                                            <li>
                                              <label for="form_crm_name">Compte bancaire IBAN</label>
                                              <input type="text" name="refBancaire" id="form_crm_name" value="" required>
                                            </li>
                                            <li>
                                              <label for="form_crm_email">Code BIC</label>
                                              <input type="text" name="codeBIC" id="form_crm_email" value="" required>
                                            </li>
                                          </ol>
                                          </fieldset>
                                          <fieldset>
                                          <ol>
                                              <li><input type="submit" name="btnContinuer" id="form_submit" value="Continuer"></li>
                                              <li><button id="btnRetour">Retour</button></li>
                                          </ol>
                                           <ol>
                                              <li><a href="actif.php">[Page] Si le droit d'inscription APL est actif</a></li>
                                              <li><a href="confirmation.php">[Page] Si le droit d'inscription APL n'est pas actif</a></li>
                                          </ol>
                                        </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="{{asset('js/myJs.js')}}"></script>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
    //fermeture du modal
    $("#custom-close").on('click', function() {
        $('#myModal').modal('hide');
    });
</script>
<script type="text/javascript">
    $('body').scrollspy({
        target: '#navbar-collapsible',
        offset: 50
    });
    $('a[href*=#]:not([href=#])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top - 50
                }, 1000);
                return false;
            }
        }
    });
</script>
@endsection
