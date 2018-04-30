@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
<div class="row-fluid page-head">
    <h2 class="page-title"><i class="fa fa-registered" aria-hidden="true"></i> Publicites </h2>
    <p class="pagedesc">Gestionnaire de publicite </p>
    <div class="page-bar">
        <div class="btn-toolbar"> </div>
    </div>
</div>
<!-- // page head -->
<div id="page-content" class="page-content">
    <section>
        <div class="page-header">
            <h3><i class="fa fa-list-ol" aria-hidden="true"></i><small>Gestion des publicites</small></h3>
            <p>Classement des publicites <code> disponibles</code> et <code> archivés </code> dans le plateforme <code> Investir en Australie </code> </p>
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
                            <th scope="col">Image<span class="column-sorter"></span></th>
                            <th scope="col">Titre<span class="column-sorter"></span></th>
                            <th scope="col">Description<span class="column-sorter"></span></th>
                            <th scope="col">Liens<span class="column-sorter"></span></th>
                            <th scope="col">Pages<span class="column-sorter"></span></th>
                            <th scope="col">Date de publication <span class="column-sorter"></span></th>
                            <th scope="col">Auteur <span class="column-sorter"></span></th>
                            <th scope="col">Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($items as $item) 
                        <tr>
                            <td>{{$item->id}}</td>
                             <td>
                                 <a href="{{route('admin.pub.show', $item)}}"><img class="thumb" src="{{$item->imageUrl()}}" width="50"></a>
                             </td>
                            <td>{{$item->title}}</td>
                            <td>{{$item->content}}</td>
                            <td>{{$item->links}}</td>
                            <td>{{count($item->pages)}}</td>
                            <td>{{$item->created_at->diffForHumans()}}</td>
                            <td><a href="{{route('admin.user.show', $item->author)}}">{{$item->author->name}}</a></td>
                            <td>
                                <a href="{{route('admin.pub.edit', $item)}}" class="btn btn-small btn-info btn-update">Modifier</a>
                                <a href="{{route('admin.pub.delete', $item)}}" class="btn btn-small btn-warning btn-delete">Supprimer</a>
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
