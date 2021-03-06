@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
@if(Session::has('success')) 
<div class="alert alert-success">
    <strong>Information ! </strong> {{Session::get('success')}}
</div>
@endif
<div class="row-fluid page-head">
    <h2 class="page-title"><i class="fa fa-registered" aria-hidden="true"></i> Produits </h2>
    <p class="pagedesc">Gestionnaire de produit enregistre/favoris </p>
    <div class="page-bar">
        <div class="btn-toolbar"> </div>
    </div>
</div>
<!-- // page head -->
<div id="page-content" class="page-content">
    <section>
        <div class="page-header">
            <h3><i class="fa fa-list-ol" aria-hidden="true"></i><small>Gestion des produits</small></h3>
            <p>Classement des produits <code> disponibles</code> et <code> archivés </code> dans le plateforme <code> Investir en Australie </code> </p>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <table id="exampleDT" class="table table-striped table-hover">
                    <caption>
                    Listes des produits enregistre/favoris
                    </caption>
                    <thead>
                        <tr>
                            <th scope="col">ID <span class="column-sorter"></span></th>
                            <th scope="col">Nom<span class="column-sorter"></span></th>
                            <th scope="col">Type<span class="column-sorter"></span></th>
                            <th scope="col">Date de publication <span class="column-sorter"></span></th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($items as $item) 
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->rowProduct->product->title}}</td>
                            <td>{{$item->label}}</td>
                            <td>{{date('d/m/Y h:i:s',strtotime($item->created_at))}}</td>
                        </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
</div>
@endsection
