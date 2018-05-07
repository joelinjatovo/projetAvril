@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
<div class="row-fluid page-head">
    <h2 class="page-title"><i class="fa fa-registered" aria-hidden="true"></i> Messages </h2>
</div>
<!-- // page head -->
<div id="page-content" class="page-content">
    <section>
        <div class="page-header">
        </div>
        <div class="row-fluid">
            <div class="span12">
                @include('includes.alerts')
                <table id="exampleDT" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID <span class="column-sorter"></span></th>
                            <th scope="col">Message<span class="column-sorter"></span></th>
                            <th scope="col">Auteur<span class="column-sorter"></span></th>
                            <th scope="col">Destinateur<span class="column-sorter"></span></th>
                            <th scope="col">Date<span class="column-sorter"></span></th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($items as $item) 
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->message}}</td>
                            <td>{{$item->author->name}} <span class="badge badge-info">{{$item->author->role}}</span></td>
                            <td>{{$item->dest->name}} <span class="badge badge-info">{{$item->dest->role}}</span></td>
                            <td>{{$item->created_at->diffForHumans()}}</td>
                            <td>
                                <a href="{{route('admin.chat.delete', $item)}}" class="btn btn-small btn-warning btn-delete">@lang('app.btn.delete')</a>
                            </td>
                        </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
</div>
@endsection
