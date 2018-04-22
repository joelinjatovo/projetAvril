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
                     <div class="widget widget-simple widget-table">
                         <table id="exampleDTA" class="table boo-table table-striped table-hover">
                             <thead>
                                 <tr>
                                   <th scope="col">
                                     <label class="checkbox">
                                         <input class="checkbox" type="checkbox" value="option1">
                                     </label>
                                   </th>
                                     <th scope="col">Rang <span class="column-sorter"></span></th>
                                     <th scope="col">Photo <span class="column-sorter"></span></th>
                                     <th scope="col">Title <span class="column-sorter"></span></th>
                                     <th scope="col">Description <span class="column-sorter"></span></th>
                                     <th scope="col">Prix <span class="column-sorter"></span></th>
                                     <th scope="col">Categories <span class="column-sorter"></span></th>
                                     <th scope="col">TMA <span class="column-sorter"></span></th>
                                     <th scope="col">Statut <span class="column-sorter"></span></th>
                                     <th scope="col">Auteur <span class="column-sorter"></span></th>
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
                                     <td><img class="thumb" src="{{$item->imageUrl()}}" width="50"></td>
                                     <td>{{$item->title}}</td>
                                     <td>{{$item->content}}</td>
                                     <td>{{$item->price}}</td>
                                     <td>Category</td>
                                     <td>{{$item->tma}}</td>
                                     <td>{{$item->status}}</td>
                                     <td>{{$item->author->name}}</td>
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
