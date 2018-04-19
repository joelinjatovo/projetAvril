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
                        <div class="content-box-large">
                            <div class="panel-heading">
                                <div class="panel-title">Formulaire d'inscription </div>
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" id="particulierForm" action="{{$action}}" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type="hidden" name="type" value="APL">
                                    <fieldset>
                                        <legend>Details de l'APL</legend>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="name">Login *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Votre nom d'utilisateur" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="email">Adresse Email *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="email" name="email" placeholder="you@exemple.com" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="apl_name">Nom de l'APL *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="apl_name" name="apl_name" placeholder="you@exemple.com" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="address">Adresse de l'APL *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="address" name="address" placeholder="Adresse de l'APL" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="contact_mobile">Pays *</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="country" id="" required>
                                                <?php   for( $i=0; $i< count($pays) ; $i++){  ?>
                                                    <option value="<?php echo $pays[$i]; ?>"> <?php echo $pays[$i]; ?></option>
                                                <?php  } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="city">Ville *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="city" name="city" placeholder="Ville" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="state">Etat</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="state" name="state" placeholder="Si Etat fédéral">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="postalCode">Code Postal *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="postalCode" name="postalCode" placeholder="Code Postal" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="postalCode">Business Phone</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Business Phone">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="postalCode">Logo</label>
                                            <div class="col-sm-9">
                                                <input type="file" class="btn btn-default" id="image" name="image">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Contacts de l'Entreprise</legend>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="contact_name">Nom du Contact</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="contact_name" name="contact_name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="contact_email">Email du Contact</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="contact_email" name="contact_email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="contact_mobile">Tel du Contact</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="contact_mobile" name="contact_mobile">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label for="language" class="col-sm-3 control-label" for="language">Langage *</label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="language">
                                                    <option value="fr">Français</option>
                                                    <option value="en">Anglais</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label for="language" class="col-sm-3 control-label" for="language">Opérabilité : </label>
                                            <div class="col-md-9">
                                                <select  class="form-control"  name="operabilite">
                                                    <option value="10"> &nbsp; 10 km</option>
                                                    <option value="25"> &nbsp; 25 km</option>
                                                    <option value="50"> &nbsp; 50 km</option>
                                                    <option value="100"> &nbsp; 100 km</option>
                                                    <option value="250"> &nbsp; 250 km</option>
                                                    <option value="all"> &nbsp; Dans tous les territoires et Etats légales</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                      <legend>Présentation de l'A.P.L : </legend>
                                        <div class="col-md-12">
                                            <textarea class="form-control" name="presentationAPL" onkeyup="textLimit(this, 2000);"></textarea>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Réference bancaire</legend>
                                        <div class="form-group">
                                            <label for="language" class="col-sm-3 control-label" for="iban">Compte bancaire IBAN</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="iban" name="iban">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="language" class="col-sm-3 control-label" for="bic">Code BIC</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="bic" name="bic">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <button type="submit" class="btn btn-primary">Valider mon inscription</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
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
