@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
@if(Session::has('success')) 
<div class="alert alert-success">
    <strong>Information ! </strong> {{Session::get('success')}}
</div>
@endif
<div class="row-fluid page-head">
    <h2 class="page-title"><i class="fa fa-registered" aria-hidden="true"></i> Registres </h2>
    <p class="pagedesc">Gestionnaire de registres des articles et blogs </p>
    <div class="page-bar">
        <div class="btn-toolbar"> </div>
    </div>
</div>
<!-- // page head -->

<div id="page-content" class="page-content">
    <section>
        <div class="page-header">
            <h3><i class="fa fa-list-ol" aria-hidden="true"></i><small>Gestion des registres</small></h3>
            <p>Classement des articles <code> disponibles</code> et <code> archivés </code> dans le plateforme <code> Investir en Australie </code> </p>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <table id="exampleDT" class="table table-striped table-hover">
                    <caption>
                    Listes des articles <span>avec catégories</span>
                    </caption>
                    <thead>
                        <tr>
                            <th scope="col">ID <span class="column-sorter"></span></th>
                            <th scope="col">Titre <span class="column-sorter"></span></th>
                            <th scope="col">tag <span class="column-sorter"></span></th>
                            <th scope="col">Statut <span class="column-sorter"></span></th>
                            <th scope="col">Date de publication <span class="column-sorter"></span></th>
                            <th scope="col">Restaurer <span class="column-sorter"></span></th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($items as $item) 
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->title}}</td>
                            <td>{{$item->tag}}</td>
                            <td>{{ $item->state }}</td>
                            <td>{{date('d/m/y',strtotime($item->created_at))}}</td>
                            <td></td>
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
