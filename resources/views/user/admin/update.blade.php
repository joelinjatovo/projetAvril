@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <div id="page-content" class="page-content tab-content overflow-y">
        <div id="TabTop1" class="tab-pane padding-bottom30 active fade in">
            @include('includes.notification')
            <div class="page-header">
                <h3>Profil administrateur</h3>
            </div>
            <div class="row-fluid">
                <div class="grider">
                    <div class="widget widget-simple">
                        <div class="widget-header">
                            <h4>Profil administrateur <small>Lire et modifier mon profil</small></h4>
                        </div>
                        <div class="widget-content">
                            <div class="widget-body">
                                    <form id="accounForm" class="form-horizontal" method="post" action="{{$action}}" enctype="multipart/form-data" data-upload-template-id="template-upload-1" data-download-template-id="template-download-1">
                                        {{ csrf_field() }}
                                    <div class="row-fluid">
                                        <div class="span4">
                                            <div class="control-group no-margin-bootom">
                                                <div class="span6">
                                                    <div class="well well-nice inline">
                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                            <div class="fileupload-preview thumbnail" style="width: 96px; height: 96px;">
                                                                <img src="{{storage($item->get_meta('image')?$item->get_meta('image')->value:'')}}">
                                                            </div>
                                                            <div> <span class="btn btn-file"> <span class="fileupload-new">Select image</span> <span class="fileupload-exists">Changer</span>
                                                                <input type="file" name="image" id="file">
                                                                </span> <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Effacer</a> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span12 form-dark">
                                            <fieldset>
                                                <legend>Modifier mon profil</legend>
                                                <ul class="form-list label-left list-bordered dotted">
                                                    <li class="section-form">
                                                        <h4>Mes donnees personnelles</h4>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="accountFirstName" class="control-label">Login</label>
                                                        <div class="controls">
                                                            <input id="name" class="span11" type="text"required="required" disabled value="{{ $item->name }}" >
                                                        </div>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="accountLastName" class="control-label">Email</label>
                                                        <div class="controls">
                                                            <input id="email" class="span11" type="text" disabled required="required" value="{{ $item->email }}" >
                                                        </div>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="accountLastName" class="control-label">Nom</label>
                                                        <div class="controls">
                                                            <input id="email" class="span11" type="text" name="firstname" value="{{ $item->get_meta('firstname')?$item->get_meta('firstname')->value:'' }}" >
                                                        </div>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="accountLastName" class="control-label">Prenom</label>
                                                        <div class="controls">
                                                            <input id="email" class="span11" type="text" name="lastname" value="{{ $item->get_meta('lastname')?$item->get_meta('lastname')->value:'' }}" >
                                                        </div>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="nouveauMotDePasse" class="control-label">Nouveau mot de passe</label>
                                                        <div class="controls">
                                                            <input id="password" class="span11" type="password" name="password" placeholder="Mot de passe">
                                                        </div>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="confirmationMotDePasse" class="control-label">Confirmer mot de passe</label>
                                                        <div class="controls">
                                                            <input id="password_confirmation" class="span11" type="password" name="password_confirmation" placeholder="Confirmation de mot de passe">
                                                        </div>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="genre" class="control-label">Genre</label>
                                                        <div class="controls">
                                                            <div id="genreListe" class="btn-group change" data-toggle="buttons-radio" data-target="genre">
                                                                <button type="button" class="btn" class-toggle="btn-green" name="genre" value="homme">&nbsp; Homme &nbsp;</button>
                                                                <button type="button" class="btn" class-toggle="btn-green" name="genre" value="femme">Femme</button>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="section-form">
                                                        <h4>Information sur contact</h4>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="telephone" class="control-label">Telephone
                                                            <span class="required">*</span>
                                                        </label>
                                                        <div class="controls controls-row">
                                                            <input id="telephone" class="span6" type="tel" name="phone" value="{{$item->get_meta('phone')?$item->get_meta('phone')->value:'' }}" >
                                                        </div>
                                                    </li>
                                                    <!-- // form item -->
                                                </ul>
                                            </fieldset>

                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-blue">Valider</button>
                                                <button class="btn cancel">Annuler</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

