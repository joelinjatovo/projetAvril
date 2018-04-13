@extends('layouts.admin')

@section('content')
<div class="main-content container-fluid">
    <div id="page-content" class="page-content">
        <section>
            <div class="page-header">
                <h3>Gestion des pages statiques </h3>
            </div>
            <div class="row-fluid margin-bottom16">
                <div class="span12">
                    <div class="widget widget-simple widget-table">
                        <table id="exampleDTA" class="table boo-table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID <span class="column-sorter"></span></th>
                                    <th scope="col">Titre de la page<span class="column-sorter"></span></th>
                                    <th scope="col">Lien de la page<span class="column-sorter"></span></th>
                                    <th scope="col">Statuts/Détails <span class="column-sorter"></span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->title}}</td>
                                    <td><a href="#">{{ public_path().$item->link }}</a></td>
                                    <td>
                                        <a class="btn btn-warning" href="{{ route('page.index',$item->params) }}">Modifier</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection