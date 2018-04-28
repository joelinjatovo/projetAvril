@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
  <div id="page-content" class="page-content">
      <!-- /navbar -->
      <div class="row-fluid margin-bottom40">
          <div class="span7 well well-nice">
              <fieldset>
                  <legend>Paiement<small>information</small></legend>
                  <div class="tabbable tabbable-bordered tabs-top">
                      <ul class="nav nav-tabs">
                          <li class="active">
                              <a href="#TabTop1" data-toggle="tab">Paypal</a>
                          </li>
                          <li>
                              <a href="#TabTop2" data-toggle="tab">Carte bancaire</a>
                          </li>
                          <li>
                              <a href="#TabTop3" data-toggle="tab">Virement bancaire</a>
                          </li>
                      </ul>
                      <div class="tab-content">
                          <div class="tab-pane active" id="TabTop1">
                            <form action="" method="">
                              <label for="email">Adrese email</label>
                              <input id="email" class="input-block-level" type="text" name="email">
                              <label for="urlPaypal">URL Paypal</label>
                              <input id="urlPaypal" class="input-block-level" type="text" name="urlPaypal">
                              <label for="nomUserPaypal">Nom utilisateur paypal</label>
                              <input id="nomUserPaypal" class="input-block-level" type="text" name="nomUserPaypal">
                              <label for="motDePassePaypal">Mot de passe paypal</label>
                              <input id="motDePassePaypal" class="input-block-level" type="text" name="motDePassePaypal">
                              <label for="signaturePaypal">Signature paypal</label>
                              <input id="signaturePaypal" class="input-block-level" type="text" name="signaturePaypal">
                              <input type="submit" class="btn btn-green" value="Sauvegarder"/>
                            </form>
                          </div>
                          <div class="tab-pane" id="TabTop2">
                            <form action="" method="">
                              <label for="nomProprietaire">Nom propriétaire</label>
                              <input id="nomProprietaire" class="input-block-level" type="text" name="nomProprietaire">
                              <label for="numero">Numero de carte bancaire</label>
                              <input id="numero" class="input-block-level" type="text" name="numero">
                              <input type="submit" class="btn btn-green" value="Sauvegarder"/>
                            </form>
                          </div>
                          <div class="tab-pane" id="TabTop3">
                            <form action="" method="">
                              <label for="rib">Relevé d’Identité Bancaire</label>
                              <input id="rib" class="input-block-level" type="text" name="rib">
                              <label for="rip">Relevé d’Identité Postale</label>
                              <input id="rip" class="input-block-level" type="text" name="rip">
                              <label for="rice">Relevé d’Identité Caisse d’Epargne</label>
                              <input id="rice" class="input-block-level" type="text" name="rice">
                              <input type="submit" class="btn btn-green" value="Sauvegarder"/>
                            </form>
                          </div>
                      </div>
                  </div>
                  <hr class="margin-xxx">
              </fieldset>
          </div>
        </div>
      </div>
</div>
@endsection
