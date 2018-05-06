@extends('layouts.backend')

@section('subcontent')

<section>
    <div class="page-header">
        <h3>Listes des produits</h3>
    </div>
    <div class="row-fluid">
        <div class="col-md-12">
            @include('backend.table.product', ['products'=>$items])
        </div>
    </div>
</section>
@endsection
