@extends('layouts.backend')

@section('subcontent')

 <div class="widget widget-simple widget-table">
     <table class="table boo-table table-striped table-hover">
         <thead>
             <tr>
                 <th scope="col">ID <span class="column-sorter"></span></th>
                 <th scope="col">Photo <span class="column-sorter"></span></th>
                 <th scope="col">Title/Description <span class="column-sorter"></span></th>
                 <th scope="col">Prix/TMA <span class="column-sorter"></span></th>
                 <th scope="col">Date <span class="column-sorter"></span></th>
                 <th scope="col">Statut <span class="column-sorter"></span></th>
                 <th scope="col">Vendeur <span class="column-sorter"></span></th>
                 <th scope="col">Auteur <span class="column-sorter"></span></th>
             </tr>
         </thead>
         <tbody>
             @foreach($items as $item)
             <tr>
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
             </tr>
             @endforeach
         </tbody>
     </table>
     <!-- // DATATABLE - DTA -->
 </div>
@endsection
