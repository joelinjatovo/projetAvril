@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
@if(Session::has('success')) 
<div class="alert alert-success">
    <strong>Information ! </strong> {{Session::get('success')}}
</div>
@endif
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
            <h3><i class="fa fa-list-ol" aria-hidden="true"></i><small>Gestion des cartes</small></h3>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <table id="exampleDT" class="table table-striped table-hover">
                    <caption>
                    Carte
                    </caption>
                    <thead>
                        <tr>
                            <th scope="col">ID <span class="column-sorter"></span></th>
                            <th scope="col">Produit<span class="column-sorter"></span></th>
                            <th scope="col">Prix<span class="column-sorter"></span></th>
                            <th scope="col">Quantite<span class="column-sorter"></span></th>
                            <th scope="col">AFA<span class="column-sorter"></span></th>
                            <th scope="col">APL<span class="column-sorter"></span></th>
                            <th scope="col">Client<span class="column-sorter"></span></th>
                            <th scope="col">Date <span class="column-sorter"></span></th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($item->items as $cartItem) 
                        <tr>
                            <td>{{$cartItem->id}}</td>
                            <td>{{$cartItem->product?$cartItem->product->title:'0'}}</td>
                            <td>{{$cartItem->product?$cartItem->product->price:'0'}}</td>
                            <td>{{$cartItem->quantity?$cartItem->product->quantity:'0'}}</td>
                            <td>{{$cartItem->afa?$cartItem->afa->name:'0'}}</td>
                            <td>{{$cartItem->apl?$cartItem->apl->name:'0'}}</td>
                            <td>{{$item->author?$item->author->name:''}}</td>
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
