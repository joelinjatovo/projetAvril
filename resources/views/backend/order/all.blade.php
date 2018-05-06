@extends('layouts.backend')

@section('subcontent')
<section>
    <div class="page-header">
        <h3>Listes des commandes</h3>
    </div>
    <div class="row-fluid">
        <div class="col-md-12">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID <span class="column-sorter"></span></th>
                        <th scope="col">Total<span class="column-sorter"></span></th>
                        <th scope="col">Quantite<span class="column-sorter"></span></th>
                        <th scope="col">Date <span class="column-sorter"></span></th>
                        <th scope="col">Action <span class="column-sorter"></span></th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($items as $item) 
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>${{$item->cart?$item->cart->totalTma:'0'}}</td>
                        <td>{{$item->cart?$item->cart->totalQuantity:'0'}}</td>
                        <td>{{$item->created_at->diffForHumans()}}</td>
                        <td><a href="{{route('member.order', $item)}}" class="btn btn-success">@lang('app.view')</a></td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
