@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
<div class="row-fluid page-head">
    <h2 class="page-title">Listes des cartes </h2>
</div>
<!-- // page head -->
<div id="page-content" class="page-content">
    <section>
        <div class="page-header">
            <h3></h3>
        </div>
        <div class="row-fluid">
            <div class="span12">
                @include('admin.table.cart', ['carts'=>$items])
            </div>
        </div>
    </section>
</div>
</div>
@endsection
