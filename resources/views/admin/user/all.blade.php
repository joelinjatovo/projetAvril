@extends('layouts.admin')

@section('content')
<div class="main-content container-fluid">
    <div id="page-content" class="page-content">
        <section>
            <div class="page-header">
                <h3>Parties Prenantes. <small>Tous les utilisateurs </small></h3>
            </div>
            <div class="row-fluid margin-bottom16">
                 <div class="span12">
                     <div class="widget widget-simple widget-table">
                         <table id="exampleDTA" class="table boo-table table-striped table-hover">
                             <thead>
                                 <tr>
                                   <th scope="col">
                                     <label class="checkbox">
                                         <input class="checkbox" type="checkbox" value="option1">
                                     </label>
                                   </th>
                                     <th scope="col">Id <span class="column-sorter"></span></th>
                                     <th scope="col">Photo / Avatar <span class="column-sorter"></span></th>
                                     <th scope="col">Nom <span class="column-sorter"></span></th>
                                     <th scope="col">Email <span class="column-sorter"></span></th>
                                     <th scope="col">Date d'inscription <span class="column-sorter"></span></th>
                                     <th scope="col">Role <span class="column-sorter"></span></th>
                                     <th scope="col">Type <span class="column-sorter"></span></th>
                                     <th scope="col">Statut <span class="column-sorter"></span></th>
                                     <th scope="col">Actions <span class="column-sorter"></span></th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach($items as $item)
                                 <tr class="user-item-{{$item->id}}">
                                   <td>
                                       <label class="checkbox">
                                           <input class="checkbox" type="checkbox" value="{{$item->id}}">
                                       </label>
                                   </td>
                                     <td>{{$item->id}}</td>
                                     <td>
                                         <img class="thumb" src="{{asset('administrator/img/profil.png')}}" width="50">
                                     </td>
                                     <td>{{$item->name}}</td>
                                     <td>{{$item->email}}</td>
                                     <td>{{$item->created_at}}</td>
                                     <td>{{$item->role}}</td>
                                     <td>{{$item->type}}</td>
                                     <td>
                                         @if($item->status=='active')
                                         <span class="label label-success">{{$item->status}}</span>
                                         @else
                                         <span class="label label-warning">{{$item->status}}</span>
                                         @endif
                                     </td>
                                     <td>
                                         <a href="{{route('admin.user.edit', $item)}}" class="btn btn-small btn-primary">Modifier</a>
                                         <a href="{{route('admin.user.block', $item)}}" class="btn btn-small btn-info">Bloquer</a>
                                         <a href="{{route('admin.user.active', $item)}}" class="btn btn-small btn-warning">Activer</a>
                                         <a href="{{route('admin.user.disable', $item)}}" class="btn btn-small btn-warning">Desactiver</a>
                                         <a href="{{route('admin.user.disable', $item)}}" class="btn btn-small btn-error">Supprimer</a>
                                     </td>
                                 </tr>
                                 @endforeach
                             </tbody>
                         </table>
                         <!-- // DATATABLE - DTA -->

                     </div>
                     <!-- // Column -->

                 </div>
             </div>
        </section>
    </div>
</div>
@endsection

