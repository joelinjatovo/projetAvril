@extends('layouts.app')

@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="row">
              <div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
                  <div class="modal-dialog">

                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title">Message d'information</h4>
                          </div>
                          <div class="modal-body">
                              <p>Merci de votre intention de vous inscrire en qualité de Membre sur le site "Investir en Australie".
                                  En plus de pouvoir, comme tout Visiteur, voir dans le détail les produits et opérer des sélections
                                  multicritères, votre inscription vous permettra d'enregistrer vos recherches multicritères,
                                  d'enregistrer les produits qui vous intéressent dans vos "favoris", de partager des produits avec
                                  vos amis par emails et sur les réseaux sociaux, d'échanger avec une Agence Francophone Australienne
                                  située à proximité du bien qui vous intéresse. Lorsque vous aurez pris la décision d'acheter vous
                                  pourrez lancer la procédure d'acquisition en ligne. Au cours de cette procédure il vous sera proposé
                                  les services de certains de nos partenaires australiens francophones auxquels vous pourriez faire appel
                                  si vous en aviez besoin.</p>
                          </div>
                          <div class="modal-footer">
                              <a type="button" class="pull-left btn btn-primary" href="javascript:history.back()">Abandonner</a>
                              <a type="button" class="btn btn-primary" href="#section1" id="custom-close">Continuer</a>
                          </div>
                      </div>
                  </div>
              </div>

              <div style="margin-top: 50px">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12" id="section1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="accueil.php">Accueil</a></li>
                                <li class="breadcrumb-item active">Inscription en qualité de Membre</li>
                            </ol>
                        </div>
                    </div>




                    <div class="content-box-large">
                        <div class="panel-heading">
                            <div class="panel-title">Inscription en Qualité de Membre</div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <label for="inputEmail3" class="col-sm-3 control-label">Type de membre *</label>
                                <div class="col-md-3">
                                    <select class="form-control" id="typeMembre" style="background-color:#ebeee7;" required>
                                        <option value="Particulier" selected>Particulier</option>
                                        <option value="Organisation">Organisation</option>
                                    </select>
                                </div>
                            </div>
                            <br>


                            <form class="form-horizontal" role="form" id="particulierForm" action="{!! url('/inscrire') !!}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <input type="hidden" name="type" value="MEMBRE">
                                <input type="hidden" name="typeMembre" value="Particulier">
                                <div class="form-group">
                                    <label for="nomParticulier" class="col-sm-3 control-label">Nom *</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nomParticulier" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="prenomParticulier">Prénom *</label>

                                    <div class="col-sm-9">
                                        <input type="text" class="form-control"  name="prenomParticulier" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="paysParticulier" class="col-sm-3 control-label">Pays *</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="paysParticulier">

                                        <?php   for( $i=0; $i< count($pays) ; $i++){  ?>
                                            <option value="<?php echo $pays[$i]; ?>"> <?php echo $pays[$i]; ?></option>
                                        <?php  } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="emailParticulier">Adresse Email *</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="inputEmail3" name="emailParticulier" placeholder="you@exemple.com" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="avatar">Avatar</label>
                                    <div class="col-md-9">
                                        <input type="file" class="btn btn-default" name="avatar" id="avatar">
                                        <p class="help-block">
                                            Choisissez un avatar pour représenter votre profil
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <div class="checkbox">
                                            <p class="help-block">
                                                <em>(*) Champ obligatoire</em>
                                            </p>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="newsletterPart" id="newsletterPart" checked="checked"> M'inscrire à la Newsletter
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="partageDonnePart" id="partageDonnePart"> J'autorise le partage et la commercialisation de mes information avec les partenaires du site www.investirenaustralie.com
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-primary">Valider mon inscription</button>
                                    </div>
                                </div>
                            </form>


                            <form class="form-horizontal" role="form" action="{!! url('/inscrire') !!}" id="organisationForm" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <input type="hidden" name="type" value="MEMBRE">
                                <input type="hidden" name="typeMembre" value="Organisation">
                                <div class="form-group">
                                    <label for="nomOrg" class="col-sm-3 control-label">Nom de l'organisation</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control"  name="nomOrg" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="adresseOrg">Adresse *</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="adresseOrg" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="villeOrg">Ville *</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="villeOrg" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="paysOrg" class="col-sm-3 control-label">Pays *</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="paysOrg">
                                            <?php   for( $i=0; $i< count($pays) ; $i++){  ?>
                                            <option value="<?php echo $pays[$i]; ?>"> <?php echo $pays[$i]; ?></option>
                                            <?php  } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="etatOrg">Etat (Si fédéral)</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="etatOrg" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="codePostalOrg">Code postal *</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="codePostalOrg" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="emailOrg">Adresse Email *</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="emailOrg" placeholder="you@exemple.com" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Contact Mobile *</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="prefixPhone">
                                            <?php   for( $i=0; $i< count($tels) ; $i++){  ?>
                                            <option value="<?php echo $tels[$i]; ?>"> <?php echo $tels[$i]; ?></option>
                                            <?php  } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control"  name="phoneNumber" placeholder="3-333-333" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="langageOrganisations" class="col-sm-3 control-label" for="langOrg">Langage *</label>
                                    <div class="col-md-3">
                                        <select class="form-control" name="langOrg">
                                            <option value="fr">Français</option>
                                            <option value="eng">Anglais</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="presentationOrg" >Présentation de l'organisation *</label>
                                    <div class="col-sm-9">
                                        <textarea  class="form-control" name="presentationOrg" required></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="logo">Logo de l'organsation *</label>
                                    <div class="col-md-9">
                                        <input type="file" class="btn btn-default" name="logo">
                                        <p class="help-block">
                                            Choisissez le logo de votre organisation
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <div class="checkbox">
                                            <p class="help-block">
                                                <em>(*) Champ obligatoire</em>
                                            </p>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="newsletterOrg" name="newsletterOrg" checked="checked"> M'inscrire à la Newsletter
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="partageDonneOrg" name="partageDonneOrg"> J'autorise le partage et la commercialisation de mes information avec les partenaires du site www.investirenaustralie.com
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-primary">Valider mon inscription</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="content-box-header">
                                <div class="panel-title">Espaces publicitaires</div>
                            </div>
                            <div class="content-box-large box-with-header">
                                <img src="{{asset('images/announcement-bg.jpg')}}" class="img-rounded" alt="Cinque Terre" width="604" height="236">
                                <br /><br />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="content-box-header">
                                <div class="panel-title">Espaces publicitaires</div>
                            </div>
                            <div class="content-box-large box-with-header">
                                <img src="{{asset('images/announcement-bg.jpg')}}" class="img-rounded" alt="Cinque Terre" width="604" height="236">
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
        <div class="col-md-1"></div>
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
