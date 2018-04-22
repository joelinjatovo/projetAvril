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
            <h3><i class="fa fa-list-ol" aria-hidden="true"></i><small>Gestion des publicites</small></h3>
            <p>Classement des publicites <code> disponibles</code> et <code> archivés </code> dans le plateforme <code> Investir en Australie </code> </p>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <table id="exampleDT" class="table table-striped table-hover">
                    <caption>
                    Listes des publicites
                    </caption>
                    <thead>
                        <tr>
                            <th scope="col">ID <span class="column-sorter"></span></th>
                            <th scope="col">Produit<span class="column-sorter"></span></th>
                            <th scope="col">Prix<span class="column-sorter"></span></th>
                            <th scope="col">Quantite<span class="column-sorter"></span></th>
                            <th scope="col">AFA<span class="column-sorter"></span></th>
                            <th scope="col">Client<span class="column-sorter"></span></th>
                            <th scope="col">Date <span class="column-sorter"></span></th>
                        </tr>
                    </thead>
                    <tbody>
                      @if($item->cart) 
                      @foreach($item->cart->items as $cartItem) 
                        <tr>
                            <td>{{$cartItem->id}}</td>
                            <td>{{$cartItem->product?$item->product->title:'0'}}</td>
                            <td>{{$cartItem->product?$item->product->price:'0'}}</td>
                            <td>{{$cartItem->quantity?$item->product->quantity:'0'}}</td>
                            <td>{{$cartItem->afa?$item->afa->name:'0'}}</td>
                            <td>{{$item->author?$item->author->name:''}}</td>
                            <td>{{date('d/m/Y h:i:s',strtotime($item->created_at))}}</td>
                        </tr>
                       @endforeach
                       @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
</div>
@endsection
