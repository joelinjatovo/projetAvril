@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <!-- // page head -->
    <div id="page-content" class="page-content tab-content overflow-y">
        <div id="TabTop1" class="tab-pane padding-bottom30 active fade in">
            <div class="page-header">
                <h3>Profil client</h3>
            </div>
            <div class="row-fluid">
                <div class="grider">
                    <div class="widget widget-simple">
                        <div class="widget-header">
                            <h4><small>Lire et modifier profil client</small></h4>
                        </div>
                        <div class="widget-content">
                            <div class="widget-body">
                                <form id="accounForm" class="form-horizontal" method="" action="">
                                    <div class="row-fluid">
                                        <div class="span12">
                                            <div class="control-group no-margin-bootom">
                                                <label class="control-label label-left">
                                                    <img src="{{$item->imageUrl(true)}}" class="thumbnail" width="96" height="96">
                                                </label>
                                                <div class="controls">
                                                    <h2>{{$item->name}}</h2>
                                                    <strong>{{$item->role}}</strong> at <strong><a href="#">IEA</a></strong><br> 
                                                    <abbr title="Work email">e-mail:</abbr> <a href="mailto:#">{{$item->email}}</a><br> 
                                                    <abbr title="Work Phone">Telephone: +261 34 40 804 03</abbr>
                                                </div>
                                                <a class="btn btn-danger" href="javascript:void(0);">Supprimer</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span12 form-dark">
                                            <fieldset>
                                                <legend>Modifier son profil</legend>
                                                <ul class="form-list label-left list-bordered dotted">
                                                    <li class="section-form">
                                                        <h4>Informations personnelles</h4>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="nom" class="control-label">Nom
                                                        </label>
                                                        <div class="controls">
                                                            {{$item->get_meta('firstname')?$item->get_meta('firstname')->value:''}}
                                                        </div>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="prenom" class="control-label">Prenom
                                                            <span class="required">*</span>
                                                        </label>
                                                        <div class="controls">
                                                            {{$item->get_meta('lastname')?$item->get_meta('lastname')->value:''}}
                                                        </div>
                                                    </li>
                                                    <li class="section-form">
                                                        <h4>Information sur la contact</h4>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="telephone" class="control-label">Telephone
                                                            <span class="required">*</span>
                                                        </label>
                                                        <div class="controls controls-row">
                                                            {{$item->get_meta('phone')?$item->get_meta('phone')->value:''}}
                                                        </div>
                                                    </li>
                                                    <li class="section-form">
                                                        <h4>Informations compte</h4>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="referenceBancaire" class="control-label">Référence bancaire</label>
                                                        <div class="controls">
                                                            <input id="referenceBancaire" class="span11" type="text" name="referenceBancaire" value="">
                                                        </div>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="observation" class="control-label">Observation</label>
                                                        <div class="controls">
                                                            <textarea class="input-block-level" rows="3" name="observation" id="observation"></textarea>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </fieldset>
                                            <fieldset>
                                                <legend class="section-form">Addresse</legend>
                                                <ul class="form-list label-left list-bordered dotted">
                                                    <li class="control-group">
                                                        <label for="adresse" class="control-label">Address
                                                        </label>
                                                        <div class="controls controls-row">
                                                            {{$item->location?$item->location->address:''}}
                                                        </div>
                                                        <div class="controls margin-s0">
                                                        </div>
                                                    </li>
                                                    <!-- // form item -->
                                                    <li class="control-group">
                                                        <label for="cite" class="control-label">City
                                                        </label>
                                                        <div class="controls">
                                                            {{$item->location?$item->location->city:''}}
                                                        </div>
                                                    </li>
                                                    <!-- // form item -->
                                                    <li class="control-group">
                                                        <label for="paysList" class="control-label">Pays
                                                        </label>
                                                        <div class="controls">
                                                            {{$item->location?$item->location->country:''}}
                                                        </div>
                                                    </li>
                                                    <!-- // form item -->
                                                    <li class="control-group">
                                                        <label for="etatList" class="control-label">Etat
                                                        </label>
                                                        <div class="controls">
                                                            {{$item->location?$item->location->state:''}}
                                                        </div>
                                                    </li>
                                                    <!-- // form item -->
                                                    <li class="control-group">
                                                        <label for="zipCode" class="control-label">Zip / Code postal
                                                        </label>
                                                        <div class="controls">
                                                            {{$item->location?$item->location->postCode:''}}
                                                        </div>
                                                    </li>

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
                        <legend class="section-form">Liste des produits rattachés au client</legend>
                        <div class="widget widget-simple widget-table">
                            <table id="exampleDTA" class="table boo-table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Id produit <span class="column-sorter"></span></th>
                                        <th scope="col">Nom de l'APL rattaché</th>
                                        <th scope="col">Date de la vente <span class="column-sorter"></span></th>
                                        <th scope="col">Image produit <span class="column-sorter"></span></th>
                                        <th scope="col">Prix<span class="column-sorter"></span></th>
                                        <th scope="col">Type de bien<span class="column-sorter"></span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($item->clientProductLabeled as $product)
                                    <tr>
                                        <td>PdtRes004</td>
                                        <td>APL	test</td>
                                        <td>24/05/16</td>
                                        <td>
                                            <img class="thumb" width="50" src="{{$product->imageUrl()}}">
                                        </td>
                                        <td>{{$product->title}}</td>
                                        <td>Appartement</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- // DATATABLE - DTA -->
                        </div>
                    </div>
                    <!-- // Widget -->
                </div>
                <!-- // Column -->
                <!-- // Column -->
            </div>
            <!-- // Example row -->
        </div>

    </div>
    <!-- // page content -->
</div>
<!-- // main-content -->

@endsection

