@extends('layouts.app')

@section('content')
@component('includes.breadcrumb')
    Dashboard
@endcomponent
<div class="page-content">
    <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="sidebar content-box" style="display: block;">
                <ul class="nav nav-side">
                    <li><a href="{{url(Auth::user()->role)}}"><i class="fa fa-tachometer" aria-hidden="true"></i> Tableau de bord</a></li>
                    <li><a href="{{url('profile/edit')}}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Mise à jour Profil</a></li>
                    @If(Auth::user()->hasRole('member'))
                    <li><a href="{{url('cart')}}"><i class="fa fa-tasks" aria-hidden="true"></i> Cartes</a></li>
                    <li><a href="{{url('member/starred')}}"><i class="fa fa-gratipay" aria-hidden="true"></i> Favoris</a></li>
                    <li><a href="{{url('member/saved')}}"><i class="fa fa-bookmark" aria-hidden="true"></i> Sauvegardes</a></li>
                    <li><a href="{{url('member/order')}}"><i class="fa fa-tasks" aria-hidden="true"></i> Commandes</a></li>
                    <li><a href="{{url('member/order/payed')}}"><i class="fa fa-tasks" aria-hidden="true"></i> Achats</a></li>
                    @elseif(!Auth::user()->isAdmin())
                    <li><a href="{{url(Auth::user()->role.'/products')}}"><i class="fa fa-gratipay" aria-hidden="true"></i> Produits</a></li>
                    <li><a href="{{url(Auth::user()->role.'/starred')}}"><i class="fa fa-gratipay" aria-hidden="true"></i> Favoris</a></li>
                    <li><a href="{{url(Auth::user()->role.'/saved')}}"><i class="fa fa-bookmark" aria-hidden="true"></i> Sauvegardes</a></li>
                    @endif
                    @If(Auth::user()->hasRole('afa'))
                    @endif
                    @If(Auth::user()->hasRole('apl'))
                    <li><a href="{{url(Auth::user()->role.'/clients')}}"><i class="fa fa-gratipay" aria-hidden="true"></i> Clients</a></li>
                    @endif
                    <li><a href="{{route('logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> Deconnexion</a></li>
                </ul>
             </div>
          </div>
          <div class="col-md-8">
              @include('includes.alerts')
              @yield('subcontent')
          </div>
      </div>
  </div>
</div>
@endsection
