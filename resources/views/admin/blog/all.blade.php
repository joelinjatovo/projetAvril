@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <div class="row-fluid page-head">
        <h2 class="page-title"><i class="fontello-icon-monitor"></i> @lang('app.admin.blog.list')</h2>
    </div>
    <div class="page-content">
        <section  class="span12">
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
                            <a href="{{route('admin.blog.publish', $item)}}" class="btn btn-small btn-info btn-publish">@lang('app.btn.publish')</a>
                            <a data-dismiss="modal" data-toggle="modal" data-target="#modal-trash-{{$item->id}}" class="btn btn-small btn-warning btn-trash">@lang('app.btn.trash')</a>
                         @elseif($item->status=='trashed')
                            <a href="{{route('admin.blog.restore', $item)}}" class="btn btn-small btn-info btn-restore">@lang('app.btn.restore')</a>
                         @endif
                         @if($item->status=='published')
                            <a data-dismiss="modal" data-toggle="modal" data-target="#modal-archive-{{$item->id}}" class="btn btn-small btn-warning  btn-archive">@lang('app.btn.archive')</a>
                            <a data-dismiss="modal" data-toggle="modal" data-target="#modal-trash-{{$item->id}}" class="btn btn-small btn-warning btn-trash">@lang('app.btn.trash')</a>
                         @endif
                            <a data-dismiss="modal" data-toggle="modal" data-target="#modal-delete-{{$item->id}}" class="btn btn-small btn-warning btn-delete">@lang('app.btn.delete')</a>
                            <a class="btn btn-small" href="{{route('admin.blog.star',$item)}}"><i class="fontello-icon-star-1"></i> @lang('app.btn.star')</a> 
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
                            <a type="button" class="btn btn-primary" href="{{route('admin.blog.archive',$item)}}">@lang('app.btn.archive')</a>
                            <button type="reset" class="btn btn-default" data-dismiss="modal">@lang('app.btn.reset')</button>
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
                            <a type="button" class="btn btn-primary" href="{{route('admin.blog.trash',$item)}}">@lang('app.btn.trash')</a>
                            <button type="reset" class="btn btn-default" data-dismiss="modal">@lang('app.btn.reset')</button>
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
                            <a type="button" class="btn btn-primary" href="{{route('admin.blog.delete',$item)}}">@lang('app.btn.delete')</a>
                            <button type="reset" class="btn btn-default" data-dismiss="modal">@lang('app.btn.reset')</button>
                          </div>
                        </div>
                      </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </section>
        {{$items->links()}}
    </div>
</div>
@endsection
