@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
<div class="row-fluid page-head">
    <h2 class="page-title"><i class="fa fa-registered" aria-hidden="true"></i> Pages </h2>
    <p class="pagedesc">Gestionnaire de pages </p>
    <div class="page-bar">
        <div class="btn-toolbar"> </div>
    </div>
</div>
<!-- // page head -->
<div id="page-content" class="page-content">
    <section>
        <div class="page-header">
            <h3><i class="fa fa-list-ol" aria-hidden="true"></i><small>Gestion des pages</small></h3>
            <p>Classement des pages <code> disponibles</code> et <code> archivés </code> dans le plateforme <code> Investir en Australie </code> </p>
        </div>
        <div class="row-fluid">
            <div class="span12">
                @include('includes.alerts')
                <table id="exampleDT" class="table table-striped table-hover">
                    <caption>
                    Listes des publicites
                    </caption>
                    <thead>
                        <tr>
                            <th scope="col">ID <span class="column-sorter"></span></th>
                            <th scope="col">Titre<span class="column-sorter"></span></th>
                            <th scope="col">Path<span class="column-sorter"></span></th>
                            <th scope="col">Parent<span class="column-sorter"></span></th>
                            <th scope="col">Ordre<span class="column-sorter"></span></th>
                            <th scope="col">Auteur<span class="column-sorter"></span></th>
                            <th scope="col">Date de publication <span class="column-sorter"></span></th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($items as $item) 
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>
                                <a href="{{route('admin.page.show', $item)}}">{{$item->title}}</a><br>
                                {{$item->excerpt()}}
                            </td>
                            <td>{{$item->path}}</td>
                            <td>@if($item->parent)<a href="{{route('admin.page.show', $item->parent)}}">{{$item->parent->title}}</a>@endif</td>
                            <td>{{$item->page_order}}</td>
                            <td>@if($item->author)<a href="{{route('admin.user.show', $item->author)}}">{{$item->author->name}}</a>@endif</td>
                            <td>{{$item->created_at->diffForHumans()}}</td>
                            <td>
                                <a href="{{route('admin.page.edit', $item)}}" class="btn btn-small btn-info btn-update">Modifier</a>
                                <a href="{{route('admin.page.delete', $item)}}" class="btn btn-small btn-warning btn-delete">Supprimer</a>
                            </td>
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
