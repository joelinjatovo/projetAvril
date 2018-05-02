@extends('layouts.backend')

@section('subcontent')
<section>
    <div class="page-header">
        <h3><i class="fa fa-list-ol" aria-hidden="true"></i>
                Listes des commandes</h3>
    </div>
    <div class="row-fluid">
        <div class="col-md-12">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID <span class="column-sorter"></span></th>
                        <th scope="col">Cartes<span class="column-sorter"></span></th>
                        <th scope="col">Client<span class="column-sorter"></span></th>
                        <th scope="col">Date <span class="column-sorter"></span></th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($items as $item) 
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->cart?$item->cart->id:'0'}}</td>
                        <td>{{$item->author?$item->author->name:''}}</td>
                        <td>{{date('d/m/Y h:i:s',strtotime($item->created_at))}}</td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
