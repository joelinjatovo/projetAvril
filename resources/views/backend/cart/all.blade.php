@extends('layouts.backend')

@section('subcontent')
<section>
    <div class="page-header">
        <h3><i class="fa fa-list-ol" aria-hidden="true"></i><small>Listes des cartes</small></h3>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <table id="exampleDT" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID <span class="column-sorter"></span></th>
                        <th scope="col">Client<span class="column-sorter"></span></th>
                        <th scope="col">Prix Total<span class="column-sorter"></span></th>
                        <th scope="col">Nombre de produit<span class="column-sorter"></span></th>
                        <th scope="col">Date <span class="column-sorter"></span></th>
                        <th scope="col">Status<span class="column-sorter"></span></th>
                        <th scope="col">Action<span class="column-sorter"></span></th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($items as $item) 
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->author?$item->author->name:''}}</td>
                        <td>{{$item->totalPrice}}</td>
                        <td>{{$item->totalQuantity}}</td>
                        <td>{{$item->created_at->diffForHumans()}}</td>
                        <td>{{$item->status}}</td>
                        <td><a href="{{route('member.cart', $item)}}" class="btn btn-success">@lang('app.btn.view')</a></td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
