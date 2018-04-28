@extends('layout.app')

@section('content')
<div class="main-slider-wrapper clearfix content corps">
    <div id="site-banner" class="text-center clearfix">
        <div class="container">
            <h1 class="title wow slideInLeft">Tableau de bord</h1>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="row">
      <div class="col-md-3">
        <div class="sidebar content-box" style="display: block;">
            <ul class="nav nav-side">
                <li class="current"><a href="{!! route('dashboard')  !!}"><i class="fa fa-tachometer" aria-hidden="true"></i> Tableau de bord</a></li>
                <li><a href="{!! route('maj')  !!}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Mise à jour Profil</a></li>
                <li><a href="{!! route('favoris') !!}"><i class="fa fa-gratipay" aria-hidden="true"></i> Favoris</a></li>
                <li><a href="{!! route('recherche-sauvegardees') !!}"><i class="fa fa-bookmark" aria-hidden="true"></i> Recherches sauvegardées</a></li>
                <li><a href="encours-dachat.php"><i class="fa fa-tasks" aria-hidden="true"></i> Produits en cours d'achats</a></li>
                <li><a href="achetees-precedemment.php"><i class="fa fa-money" aria-hidden="true"></i> Produits achetés précedemment</a></li>
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
                <li><a href="accueil.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Deconnexion</a></li>
            </ul>
         </div>
      </div>
      <div class="col-md-8">
          @yield('subcontent')
      </div>
  </div>
</div>
@endsection
