@extends('layouts.lte')

@section('content')
    @include('admin.invoice.component', [
        'title'=>app_name(),
        'date'=>$item->created_at,
        'cart'=>$item,
    ])

<div id="main-content" class="main-content container-fluid">
    <!-- // page head -->
    <div id="page-content" class="page-content tab-content overflow-y">
        <div class="tab-pane padding-bottom30 active fade in">
            @include('includes.alerts')
            <div class="page-header">
                <h3>Facture client</h3>
            </div>
            <div class="row-fluid">
                <div class="grider">
                    <div class="widget widget-simple">
                        <div class="widget-content">
                            <div class="widget-body">
                                @if($product = $item->product)
                                <div class="col-md-3">
                                    <img src="{{$item->product->imageUrl(true)}}" style="width:100%;">
                                </div>
                                <div class="col-md-9">
                                    <p><strong>Nom du produit: </strong>{{$product->title}}</p>
                                    <p><strong>Prix du produit: </strong>{{$product->price}}</p>
                                    <p><strong>Montant de reservation: </strong>{{$item->reservation}}</p>
                                    <p><strong>Paiement de la reservation: </strong>{!!$item->reserved_at?$item->reserved_at->diffForHumans():'<span class="label label-warning">Pas encore effectué</span>'!!}</p>
                                    <p><strong>Status de la commande: </strong>{{$item->status=='ordered'?'En cours':$item->status=='paid'?'Payé':'-'}}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="tab-pane padding-bottom30 active fade in">
            <div class="page-header">
                <h3>Facture Vendeur</h3>
            </div>
            <div class="row-fluid">
                <div class="grider">
                    <div class="widget widget-simple">
                        <div class="widget-content">
                            <div class="widget-body">
                                @if($product)
                                <div class="col-md-3">
                                    <img src="{{$product->imageUrl(true)}}" style="width:100%;">
                                </div>
                                <div class="col-md-9">
                                    <p><strong>Nom du produit: </strong>{{$product->title}}</p>
                                    <p><strong>Prix du produit: </strong>{{$product->price}}</p>
                                    <p><strong>Montant de la commission sur vente: </strong>{{$item->tma}}</p>
                                    <p><strong>Paiement de la commission sur vente: </strong>{!!$item->tma_paid_at?$item->tma_paid_at->diffForHumans():'<span class="label label-warning">Pas encore effectué</span>'!!}</p>
                                    <p><strong>Status de la commande: </strong>{{$item->status=='ordered'?'En cours':$item->status=='paid'?'Payé':'-'}}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="tab-pane padding-bottom30 active fade in">
            <div class="page-header">
                <h3>Facture Agence Francophone Australienne</h3>
            </div>
            <div class="row-fluid">
                <div class="grider">
                    <div class="widget widget-simple">
                        <div class="widget-content">
                            <div class="widget-body">
                                @if($product)
                                <div class="col-md-3">
                                    <img src="{{$product->imageUrl(true)}}" style="width:100%;">
                                </div>
                                <div class="col-md-9">
                                    <p><strong>Nom du produit: </strong>{{$product->title}}</p>
                                    <p><strong>Prix du produit: </strong>{{$product->price}}</p>
                                    <p><strong>Montant de la commission sur presentation de la clientelle: </strong>{{$item->afa_amount}}</p>
                                    <p><strong>Paiement de la commission sur presentation de la clientelle: </strong>{!!$item->afa_paid_at?$item->afa_paid_at->diffForHumans():'<span class="label label-warning">Pas encore effectué</span>'!!}</p>
                                    <p><strong>Status de la commande: </strong>{{$item->status=='ordered'?'En cours':$item->status=='paid'?'Payé':'-'}}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="tab-pane padding-bottom30 active fade in">
            <div class="page-header">
                <h3>Facture Agence Partenaire Locale</h3>
            </div>
            <div class="row-fluid">
                <div class="grider">
                    <div class="widget widget-simple">
                        <div class="widget-content">
                            <div class="widget-body">
                                @if($product)
                                <div class="col-md-3">
                                    <img src="{{$product->imageUrl(true)}}" style="width:100%;">
                                </div>
                                <div class="col-md-9">
                                    <p><strong>Nom du produit: </strong>{{$product->title}}</p>
                                    <p><strong>Prix du produit: </strong>{{$product->price}}</p>
                                    <p><strong>Montant de la commission MIO: </strong>{{$item->apl_amount}}</p>
                                    <p><strong>Paiement de la commission MIO: </strong>{!!$item->apl_paid_at?$item->apl_paid_at->diffForHumans():'<span class="label label-warning">Pas encore effectué</span>'!!}</p>
                                    <p><strong>Status de la commande: </strong>{{$item->status=='ordered'?'En cours':$item->status=='paid'?'Payé':'-'}}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
