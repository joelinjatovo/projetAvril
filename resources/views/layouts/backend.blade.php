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
                    <li class="current"><a href="{{url(Auth::user()->role)}}"><i class="fa fa-tachometer" aria-hidden="true"></i> Tableau de bord</a></li>
                    <li><a href="{{url(Auth::user()->role.'/edit')}}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Mise à jour Profil</a></li>
                    <li><a href="{{url('member/starred')}}"><i class="fa fa-gratipay" aria-hidden="true"></i> Favoris</a></li>
                    <li><a href="{{url('member/saved')}}"><i class="fa fa-bookmark" aria-hidden="true"></i> Sauvegardes</a></li>
                    <li><a href="{{url('cart')}}"><i class="fa fa-tasks" aria-hidden="true"></i> Cartes</a></li>
                    <li><a href="{{url('member/order')}}"><i class="fa fa-tasks" aria-hidden="true"></i> Commandes</a></li>
                    <li><a href="{{url('member/order/payed')}}"><i class="fa fa-tasks" aria-hidden="true"></i> Achats</a></li>
                    <li class="submenu">
                     <a href="#">
                        <i class="fa fa-comments-o" aria-hidden="true"></i> Messagerie
                        <span class="caret pull-right"></span>
                     </a>
                     <ul>
                        <li><a href="reception.php">Boite de réception</a></li>
                        <li><a href="redaction.php">Boite de rédaction</a></li>
                        <li><a href="archive.php">Boite des archives</a></li>
                     </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-sign-out" aria-hidden="true"></i> Deconnexion</a></li>
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
