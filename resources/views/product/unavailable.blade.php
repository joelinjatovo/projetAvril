@extends('layouts.app')

@section('content')
<section id="home-property-listing" style="margin-top: 160px;">
    <header class="section-header home-section-header text-center">
        <div class="container">
            <h2 class="wow slideInRight">@lang('app.unavailable.title')</h2>
            <p class="wow slideInLeft">{!!__('app.unavailable.content')!!}</p>
            <a href="{{route('shop.index')}}">Voir d'autre produit</a>
        </div>
    </header>
</section>
@endsection