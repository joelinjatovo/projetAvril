@extends('layouts.backend')

@section('subcontent')
<section>
    <div class="page-header">
        <h3>{{$title}}</h3>
    </div>
    <div class="row-fluid">
        <div class="col-md-12">
            @if($product = $item->product)
            <p><strong>Prix du produit: </strong>{{$product->price}}</p>
            <p><strong>Status de la commande: </strong>{{$item->status=='ordered'?'En cours':$item->status=='paid'?'Payé':'-'}}</p>
            <table class="table table-stripped">
                <tbody>
                    <tr>
                        <th>Client</th>
                        <td>
                            @if($item->author)
                            {{$item->author->name()}}
                            @endif
                        </td>
                        <th>Reservation</th>
                        <td>{{$item->reservation}}</td>
                        <th>Date</th>
                        <td>{{$item->reserved_at}}</td>
                    </tr>
                    <tr>
                        <th>Vendeur</th>
                        <td>
                            @if($product->seller)
                            {{$product->seller->name()}}
                            @endif
                        </td>
                        <th>Montant CSV</th>
                        <td>{{$item->tma}}</td>
                        <th>Date</th>
                        <td>{{$item->tma_paid_at}}</td>
                    </tr>
                    <tr>
                        <th>AFA</th>
                        <td>
                            @if($item->afa)
                            {{$item->afa->name()}}
                            @endif
                        </td>
                        <th>Montant CPC</th>
                        <td>{{$item->afa_amount}}</td>
                        <th>Date</th>
                        <td>{{$item->afa_paid_at}}</td>
                    </tr>
                    <tr>
                        <th>APL</th>
                        <td>
                            @if($item->apl)
                            {{$item->apl->name()}}
                            @endif
                        </td>
                        <th>Montant Com MIO</th>
                        <td>{{$item->apl_amount}}</td>
                        <th>Date</th>
                        <td>{{$item->apl_paid_at}}</td>
                    </tr>
                </tbody>
            </table>
            @endif
        </div>
    </div>
</section>
@endsection
