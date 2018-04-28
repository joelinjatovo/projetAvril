@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
<div class="row-fluid page-head">
    <h2 class="page-title"><i class="fa fa-registered" aria-hidden="true"></i> Categories </h2>
    <p class="pagedesc">Gestionnaire de categories </p>
    <div class="page-bar">
        <div class="btn-toolbar"> </div>
    </div>
</div>
<!-- // page head -->
<div id="page-content" class="page-content">
    <section>
        <div class="page-header">
            <h3><i class="fa fa-list-ol" aria-hidden="true"></i><small>Listes des cartes</small></h3>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <table id="exampleDT" class="table table-striped table-hover">
                    <caption>
                    Listes des cartes en cours ou traites
                    </caption>
                    <thead>
                        <tr>
                            <th scope="col">ID <span class="column-sorter"></span></th>
                            <th scope="col">Client<span class="column-sorter"></span></th>
                            <th scope="col">Prix Total<span class="column-sorter"></span></th>
                            <th scope="col">Nombre de produit<span class="column-sorter"></span></th>
                            <th scope="col">Date <span class="column-sorter"></span></th>
                            <th scope="col">Status<span class="column-sorter"></span></th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($items as $item) 
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->author?$item->author->name:''}}</td>
                            <td>{{$item->totalPrice}}</td>
                            <td>{{$item->totalQuantity}}</td>
                            <td>{{date('d/m/Y h:i:s',strtotime($item->created_at))}}</td>
                            <td>{{$item->status}}</td>
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
