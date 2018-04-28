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
                                                    @if($item->type=='person')
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
                                                        </label>
                                                        <div class="controls">
                                                            {{$item->get_meta('lastname')?$item->get_meta('lastname')->value:''}}
                                                        </div>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="prenom" class="control-label">Telephone
                                                        </label>
                                                        <div class="controls">
                                                            {{$item->get_meta('orga_phone')?$item->get_meta('orga_phone')->value:''}}
                                                        </div>
                                                    </li>
                                                    @else
                                                    <li class="section-form">
                                                        <h4>Informations sur l'organisation</h4>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="orga_name" class="control-label">Nom de l'organisation
                                                        </label>
                                                        <div class="controls">
                                                            {{$item->get_meta('orga_name')?$item->get_meta('orga_name')->value:''}}
                                                        </div>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="orga_presentation" class="control-label">Presentation de l'organisation
                                                        </label>
                                                        <div class="controls">
                                                            {{$item->get_meta('orga_presentation')?$item->get_meta('orga_presentation')->value:''}}
                                                        </div>
                                                    </li>
                                                    @endif
                                                    <li class="section-form">
                                                        <h4>Informations compte</h4>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="referenceBancaire" class="control-label">Référence bancaire</label>
                                                        <div class="controls">
                                                        </div>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="observation" class="control-label">Observation</label>
                                                        <div class="controls">
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
                            <h4><small>Produits achetes</small></h4>
                        </div>
                        @include('admin.table.product',['products'=>$item->boughtProducts])
                    </div>
                    <!-- // Widget -->
                        
                    <div class="widget widget-simple">
                        <div class="widget-header">
                            <h4><small>Produits enregistres</small></h4>
                        </div>
                        @include('admin.table.product',['products'=>$item->savedProducts])
                    </div>
                    <!-- // Widget -->
                        
                    <div class="widget widget-simple">
                        <div class="widget-header">
                            <h4><small>Produits favoris</small></h4>
                        </div>
                        @include('admin.table.product',['products'=>$item->starredProducts])
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

