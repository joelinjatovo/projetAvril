@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    @include('includes.notification')
    <div class="row-fluid page-head">
        <h2 class="page-title"><i class="fontello-icon-monitor"></i> Gestion de produit <small> Tableau de bord de la gestion du produit</small></h2>
        <div class="page-bar">
            <div class="btn-toolbar"> </div>
        </div>
    </div>
    <!-- // page head -->

    <div id="page-content" class="page-content">
        <section>
            <div class="page-header">
                <h3><i class="fontello-icon-picture-2"></i> Listes de tous les produits </h3>
                <p>Ceci est la liste de tous les produits publiés. Vous pouvez supprimer avec le bouton <b>"Delete"</b> ou modifier avec le bouton <b>"Edit"</b> ou les mettre à la Une grâce au bouton <b>"Favoris"</b>. </p>
            </div>
            <ul class="thumbnails equal-height">
                <!-- // item -->
                @php $i=0 @endphp
                @foreach($items as $item)
                <li class="span3">
                    <div class="thumbnail bg-gray-light text-center">
                        <div class="equalize">
                            <div class="well well-nice"> <a href="#"><img class="radius3" src="{{thumbnail($item->image)}}" width="640" height="320"></a>
                            </div>
                            <div class="caption text-center">
                                <p><b>{{$item->title}}</b></p>
                                <p class="img-desc">{!! $item->content!!}</p>
                            </div>
                        </div>
                        <p class="action"> 
                            <a class="btn btn-small" href="{{route('admin.product.edit',$item)}}"><i class="fontello-icon-edit"></i> Edit</a> 
                            <a class="btn btn-small" data-dismiss="modal" data-toggle="modal" data-target="#dynamicModal{{$i}}">Archiver</a> 
                            <a class="btn btn-small" href="{{route('admin.product.star',$item)}}"><i class="fontello-icon-star-1"></i> Favoris</a> 
                        </p>
                    </div>
                     <!-- Modal -->
                        <div id="dynamicModal{{$i}}" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Suppression article</h4>
                              </div>
                              <div class="modal-body">
                                <p>Voulez vous vraiment archiver l'article <br><b>{{ucfirst($item->title)}}</b>  </p>
                              </div>
                              <div class="modal-footer">
                                <a type="button" class="btn btn-primary" href="{{route('admin.blog.archive',$item)}}">Archiver</a>
                                <button type="reset" class="btn btn-default" data-dismiss="modal">annuler</button>
                              </div>
                            </div>

                          </div>
                        </div>
                </li>
                <!-- // item -->
                @php $i++ @endphp
                @endforeach
            </ul>
            <div class="row">
                {{$items->links()}}
            </div>
        </section>
    </div>
    <!-- // page content --> 
</div>
@endsection
