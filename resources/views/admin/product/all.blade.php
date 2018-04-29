@extends('layouts.admin')

@section('content')
<div class="main-content container-fluid">
    <div id="page-content" class="page-content">
        <section>
            <div class="page-header">
                <h3>Produits. <small>Tous les utilisateurs </small></h3>
            </div>
             <div class="row-fluid margin-bottom16">
                 <div class="span12">
                 @include('includes.alerts')
                     <div class="widget widget-simple widget-table">
                         <table id="exampleDTA" class="table boo-table table-striped table-hover">
                             <thead>
                                 <tr>
                                   <th scope="col">
                                     <label class="checkbox">
                                         <input class="checkbox" type="checkbox" value="option1">
                                     </label>
                                   </th>
                                     <th scope="col">ID <span class="column-sorter"></span></th>
                                     <th scope="col">Photo <span class="column-sorter"></span></th>
                                     <th scope="col">Title/Description <span class="column-sorter"></span></th>
                                     <th scope="col">Prix/TMA <span class="column-sorter"></span></th>
                                     <th scope="col">Date <span class="column-sorter"></span></th>
                                     <th scope="col">Statut <span class="column-sorter"></span></th>
                                     <th scope="col">Vendeur <span class="column-sorter"></span></th>
                                     <th scope="col">Auteur <span class="column-sorter"></span></th>
                                     <th scope="col">Actions </th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach($items as $item)
                                 <tr>
                                     <td>
                                       <label class="checkbox">
                                           <input class="checkbox" type="checkbox" value="option1">
                                       </label>
                                     </td>
                                     <td>{{$item->id}}</td>
                                     <td><a href="{{route('admin.product.show', ['product'=>$item])}}"><img class="thumb" src="{{$item->imageUrl()}}" width="50"></a></td>
                                     <td>
                                         <a href="{{route('admin.product.show', ['product'=>$item])}}">{{$item->title}}</a><br>
                                         {{$item->excerpt()}}
                                     </td>
                                     <td>{{$item->currency}} {{$item->price}} / {{$item->tma}}</td>
                                     <td>{{$item->created_at->diffForHumans()}}</td>
                                     <td>
                                         <a href="{{route('admin.product.list', ['filter'=>$item->status])}}">
                                         @if($item->status=='published')
                                         <span class="label label-success">{{$item->status}}</span>
                                         @else
                                         <span class="label label-warning">{{$item->status}}</span>
                                         @endif
                                         </a>
                                     </td>
                                     <td>@if($item->seller)<a href="{{route('admin.user.show', $item->seller)}}">{{$item->seller->name}}</a>@endif</td>
                                     <td><a href="{{route('admin.user.show', $item->author)}}">{{$item->author->name}}</a></td>
                                     <td>
                                     @if($item->status=='pinged' || $item->status=='archived')
                                        <a href="{{route('admin.product.publish', $item)}}" class="btn btn-small btn-info btn-publish">Publier</a>
                                        <a href="{{route('admin.product.trash', $item)}}" class="btn btn-small btn-info btn-trash">Trash</a>
                                     @elseif($item->status=='trashed')
                                        <a href="{{route('admin.product.restore', $item)}}" class="btn btn-small btn-info btn-restore">Restore</a>
                                     @endif
                                     @if($item->status=='published')
                                        <a href="{{route('admin.product.archive', $item)}}" class="btn btn-small btn-warning  btn-archive">Archiver</a>
                                        <a href="{{route('admin.product.trash', $item)}}" class="btn btn-small btn-warning btn-trash">Trash</a>
                                     @endif
                                        <a href="{{route('admin.product.delete', $item)}}" class="btn btn-small btn-warning btn-delete">Supprimer</a>
                                     </td>
                                 </tr>
                                 @endforeach
                             </tbody>
                         </table>
                         <!-- // DATATABLE - DTA -->
                     </div>
                     <!-- // Column -->
                 </div>
                 <!-- // Column -->
             </div>
       <!-- // Example row -->
        </section>
    </div>
</div>
@endsection
