@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <!-- // page head -->
    <div id="page-content" class="page-content tab-content overflow-y">
        <div class="tab-pane padding-bottom30 active fade in">
            @include('includes.alerts')
            @if($product = $item->product)
            <div class="page-header">
                <h3>{{$product->title}}</h3>
            </div>
            <div class="row-fluid">
                <div class="grider">
                    <div class="widget widget-simple">
                        <div class="widget-content">
                            <div class="widget-body">
                                <div class="col-md-3">
                                    <img src="{{$item->product->imageUrl(true)}}" style="width:100%;">
                                </div>
                                <div class="col-md-9">
                                    <p><strong>Prix du produit: </strong>{{$product->price}}</p>
                                    <p><strong>Status de la commande: </strong>{{$item->status=='ordered'?'En cours':$item->status=='paid'?'Payé':'-'}}</p>
                                    <table class="table table-stripped">
                                        <tbody>
                                            <tr>
                                                <th>Client</th>
                                                <td>
                                                    @if($item->author)
                                                    <a href="{{route('admin.user.show', $item->author)}}">
                                                    {{$item->author->name}}
                                                    </a>
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
                                                    <a href="{{route('admin.user.show', $product->seller)}}">
                                                    {{$product->seller->name}}
                                                    </a>
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
                                                    <a href="{{route('admin.user.show', $item->afa)}}">
                                                    {{$item->afa->name}}
                                                    </a>
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
                                                    <a href="{{route('admin.user.show', $item->apl)}}">
                                                    {{$item->apl->name}}
                                                    </a>
                                                    @endif
                                                </td>
                                                <th>Montant Com MIO</th>
                                                <td>{{$item->apl_amount}}</td>
                                                <th>Date</th>
                                                <td>{{$item->apl_paid_at}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
