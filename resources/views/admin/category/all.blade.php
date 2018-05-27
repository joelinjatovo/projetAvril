@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <div class="row-fluid page-head">
        <h2 class="page-title">{{$title}}</h2>
    </div>
    <div>
        <h4>@lang('app.search.filter')</h4>
        <form method="get" action="">
            <div class="col-md-3">
                <input id="q" type="text" class="form-control" name="q" placeholder="@lang('app.search')" title="@lang('app.search')" value="{{$q}}">
            </div>
            <div class="col-md-3">
                <input id="number" type="number" class="form-control" name="record" title="Nombre par page" placeholder="Nombre par page" min="10" value="{{$record}}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-success">@lang('app.btn.search')</button>
            </div>
        </form>
    </div>
    <br>
    <br>
    <div id="page-content" class="page-content">
        <section>
            <div class="row-fluid">
                <div class="span12">
                    @include('includes.alerts')
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID <span class="column-sorter"></span></th>
                                <th scope="col">Titre <span class="column-sorter"></span></th>
                                <th scope="col">Date de publication <span class="column-sorter"></span></th>
                                <th scope="col">Produits/SubProduits<span class="column-sorter"></span></th>
                                <th scope="col">Blogs<span class="column-sorter"></span></th>
                                <th scope="col">Auteur<span class="column-sorter"></span></th>
                                <th scope="col">Actions<span class="column-sorter"></span></th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($items as $item) 
                            <tr>
                                <td>{{$item->id}}</td>
                                <td><a href="{{route('admin.category.show', $item)}}">{{$item->title}}</a></td>
                                <td>{{$item->created_at->diffForHumans()}}</td>
                                <td>{{count($item->products)}} / {{count($item->subProducts)}}</td>
                                <td>{{count($item->blogs)}}</td>
                                <td><a href="{{route('admin.user.show', $item->author)}}">{{$item->author->name}}</a></td>
                                <td>
                                    <a href="{{route('admin.category.edit', $item)}}" class="btn btn-small btn-info btn-update">Modifier</a>
                                    <a href="{{route('admin.category.delete', $item)}}" class="btn btn-small btn-warning btn-delete">Supprimer</a>
                                </td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{$items->links()}}
        </section>
    </div>
</div>
@endsection
