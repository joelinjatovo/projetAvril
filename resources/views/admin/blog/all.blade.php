@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    @include('includes.notification')
    <div class="row-fluid page-head">
        <h2 class="page-title"><i class="fontello-icon-monitor"></i> Gestion du Blog <small> Tableau de bord de la gestion du Blog</small></h2>
        <div class="page-bar">
            <div class="btn-toolbar"> </div>
        </div>
    </div>
    <!-- // page head -->

    <div id="page-content" class="page-content">
        <section>
            <div class="page-header">
                <h3><i class="fontello-icon-picture-2"></i> Listes de tous les articles du Blog </h3>
                <p>Ceci est la liste de tous les articles publiés dans la partie Blog. Vous pouvez supprimer avec le bouton <b>"Delete"</b> ou modifier avec le bouton <b>"Edit"</b> ou les mettre à la Une grâce au bouton <b>"Favoris"</b>. </p>
            </div>
            @include('includes.alerts')
            <ul class="thumbnails equal-height">
                <!-- item -->
                @foreach($items as $item)
                <li class="span4">
                    <div class="thumbnail bg-gray-light text-center">
                        <div class="equalize">
                            <div class="well well-nice"> <a href="#"><img class="radius3" src="{{$item->imageUrl()}}" width="640" height="320"></a>
                            </div>
                            <div class="caption text-center">
                                <p><b>{{$item->title}}</b></p>
                                <p>
                                     <a href="{{route('admin.blog.list', ['filter'=>$item->status])}}">
                                     @if($item->status=='published')
                                     <span class="label label-success">{{$item->status}}</span>
                                     @else
                                     <span class="label label-warning">{{$item->status}}</span>
                                     @endif
                                     </a>
                                </p>
                                <p class="img-desc">{{$item->excerpt()}}</p>
                            </div>
                        </div>
                        <p class="action"> 
                         @if($item->status=='pinged' || $item->status=='archived')
                            <a href="{{route('admin.blog.publish', $item)}}" class="btn btn-small btn-info btn-publish">Publier</a>
                            <a data-dismiss="modal" data-toggle="modal" data-target="#modal-trash-{{$item->id}}" class="btn btn-small btn-warning btn-trash">Trash</a>
                         @elseif($item->status=='trashed')
                            <a href="{{route('admin.blog.restore', $item)}}" class="btn btn-small btn-info btn-restore">Restore</a>
                         @endif
                         @if($item->status=='published')
                            <a data-dismiss="modal" data-toggle="modal" data-target="#modal-archive-{{$item->id}}" class="btn btn-small btn-warning  btn-archive">Archiver</a>
                            <a data-dismiss="modal" data-toggle="modal" data-target="#modal-trash-{{$item->id}}" class="btn btn-small btn-warning btn-trash">Trash</a>
                         @endif
                            <a data-dismiss="modal" data-toggle="modal" data-target="#modal-delete-{{$item->id}}" class="btn btn-small btn-warning btn-delete">Supprimer</a>
                            <a class="btn btn-small" href="{{route('admin.blog.star',$item)}}"><i class="fontello-icon-star-1"></i> Favoris</a> 
                        </p>
                    </div>
                    <div id="modal-archive-{{$item->id}}" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Archiver un article</h4>
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
                    <div id="modal-trash-{{$item->id}}" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Ajouter un article aux corbeilles</h4>
                          </div>
                          <div class="modal-body">
                            <p>Voulez vous vraiment ajouter l'article aux corbeilles<br><b>{{ucfirst($item->title)}}</b>  </p>
                          </div>
                          <div class="modal-footer">
                            <a type="button" class="btn btn-primary" href="{{route('admin.blog.trash',$item)}}">Archiver</a>
                            <button type="reset" class="btn btn-default" data-dismiss="modal">annuler</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div id="modal-delete-{{$item->id}}" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Supprimer un article</h4>
                          </div>
                          <div class="modal-body">
                            <p>Voulez vous vraiment supprimer l'article definitivement <br><b>{{ucfirst($item->title)}}</b>  </p>
                          </div>
                          <div class="modal-footer">
                            <a type="button" class="btn btn-primary" href="{{route('admin.blog.delete',$item)}}">Archiver</a>
                            <button type="reset" class="btn btn-default" data-dismiss="modal">annuler</button>
                          </div>
                        </div>
                      </div>
                    </div>
                </li>
                <!-- // item -->
                @endforeach
            </ul>
        </section>
    </div>
    <!-- // page content --> 
</div>
@endsection
