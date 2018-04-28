@extends('layouts.app')

@section('content')
@include('includes.slider')
<div class="container">
    <header class="section-header text-center">
        <div class="container">
            <h3 class="pull-left">Résidentiel - <small> 6 produits enregistrées </small></h3>
            <div class="pull-right">
                <div class="property-sorting pull-left">
                    <label for="property-sort-dropdown"> Nombre de produits à afficher:   </label>
                    <select name="property-sort-dropdown" id="property-sort-dropdown" onchange="showUser(this.value)">
                        <option value="10">10 produits</option>
                        <option value="20">20 produits</option>
                        <option value="50">50 produits</option>
                        <option value="100">100 produits</option>
                    </select>
                </div>
                <p class="pull-left layout-view">
                  Vue:
                  <i class="fa fa-th-large selected" data-layout="6"></i>
                  <i class="fa fa-list-ul" data-layout="12"></i> </p>
            </div>
        </div>
    </header>

    <!-- breadcrumb     -->
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Accueil</a></li>
              <li class="breadcrumb-item active">Résidentiel</li>
            </ol>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-8 col-md-7">
            @php $i = 0; @endphp
            @foreach($items as $item)
                @if($i%2 === 0)
                    <div class="row" id="txtHint">
                @endif
                <div class="col-md-6 layout-item-wrap">
                    @include('product.single', ['item'=>$item])
                </div>
                @php $i++; @endphp
                @if($i%2 === 0)
                    </div>
                @endif
            @endforeach
            @if((($i%2) > 0))
            </div>
            @endif
            <div class="col-md-12 layout-item-wrap">
                {{$items->links()}}
            </div>
        </div>
        <div class="col-lg-4 col-md-5">
            @include('includes.sidebar')
        </div>
    </div>
</div>

@endsection