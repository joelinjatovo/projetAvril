@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <!-- // page head -->
    <div id="page-content" class="page-content tab-content overflow-y">
        <div id="TabTop1" class="tab-pane padding-bottom30 active fade in">
            <div class="page-header">
                <h3>Profil du AFA</h3>
            </div>
            <div class="row-fluid">
                <div class="grider">
                    <div class="widget widget-simple">
                        @include('includes.alerts')
                        <div class="widget-content">
                            <div class="widget-body">
                                <div id="accounForm" class="form-horizontal">
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span12 form-dark">
                                            <fieldset>
                                                <ul class="form-list label-left list-bordered dotted">
                                                    <li class="section-form">
                                                        <h4>Informations de l'organisation</h4>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="nom" class="control-label">Nom
                                                        </label>
                                                        <div class="controls">
                                                            {{$item->get_meta('orga_name')?$item->get_meta('orga_name')->value:''}}
                                                        </div>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="prenom" class="control-label">E-mail
                                                        </label>
                                                        <div class="controls">
                                                            {{$item->get_meta('orga_email')?$item->get_meta('orga_email')->value:''}}
                                                        </div>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="prenom" class="control-label">Telephone
                                                        </label>
                                                        <div class="controls">
                                                            {{$item->get_meta('orga_phone')?$item->get_meta('orga_phone')->value:''}}
                                                        </div>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="prenom" class="control-label">Site Web
                                                        </label>
                                                        <div class="controls">
                                                            {{$item->get_meta('orga_website')?$item->get_meta('orga_website')->value:''}}
                                                        </div>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="prenom" class="control-label">Site Web
                                                        </label>
                                                        <div class="controls">
                                                            {{$item->get_meta('orga_operation_state')?$item->get_meta('orga_operation_state')->value:''}}
                                                        </div>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="prenom" class="control-label">Site Web
                                                        </label>
                                                        <div class="controls">
                                                            {{$item->get_meta('orga_operation_range')?$item->get_meta('orga_operation_range')->value:''}}
                                                        </div>
                                                    </li>
                                                    <li class="section-form">
                                                        <h4>Informations sur le contact</h4>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="referenceBancaire" class="control-label">Nom du contact</label>
                                                        <div class="controls">
                                                            {{$item->get_meta('contact_name')?$item->get_meta('contact_name')->value:''}}
                                                        </div>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="referenceBancaire" class="control-label">Email du contact</label>
                                                        <div class="controls">
                                                            {{$item->get_meta('contact_email')?$item->get_meta('contact_email')->value:''}}
                                                        </div>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="referenceBancaire" class="control-label">Telephone du contact</label>
                                                        <div class="controls">
                                                            {{$item->get_meta('contact_phone')?$item->get_meta('contact_phone')->value:''}}
                                                        </div>
                                                    </li>
                                                </ul>
                                            </fieldset>
                                            <fieldset>
                                                <legend class="section-form">CRM Provider Information</legend>
                                                <ul class="form-list label-left list-bordered dotted">
                                                    <li class="control-group">
                                                        <label for="adresse" class="control-label">Nom du CRM
                                                        </label>
                                                        <div class="controls controls-row">
                                                            {{$item->get_meta('crm_name')?$item->get_meta('crm_name')->value:''}}
                                                        </div>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="adresse" class="control-label">Email du CRM
                                                        </label>
                                                        <div class="controls controls-row">
                                                            {{$item->get_meta('crm_email')?$item->get_meta('crm_email')->value:''}}
                                                        </div>
                                                    </li>
                                                </ul>
                                            </fieldset>
                                            <fieldset>
                                                <legend class="section-form">Adresse</legend>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- // Widget -->
                    
                    <div class="widget widget-simple">
                        <div class="widget-header">
                            <h4><small>Observations</small></h4>
                        </div>
                        @include('admin.table.observation',['item'=>$item])
                    </div>
                    <!-- // Widget -->
                    
                    <div class="widget widget-simple">
                        <div class="widget-header">
                            <h4><small>Produits traites par l'agence</small></h4>
                        </div>
                        @include('admin.table.product',['products'=>$item->selledProducts])
                    </div>
                    <!-- // Widget -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

