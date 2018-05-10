@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <div class="row-fluid page-head">
        <h2 class="page-title"> @lang('app.admin.chat.list') </h2>
    </div>
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
                                <th scope="col">Auteur 1<span class="column-sorter"></span></th>
                                <th scope="col">Auteur 2<span class="column-sorter"></span></th>
                                <th scope="col">Date<span class="column-sorter"></span></th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($items as $item) 
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->userone->name}} <span class="badge badge-info">{{$item->userone->role}}</span></td>
                                <td>{{$item->usertwo->name}} <span class="badge badge-info">{{$item->usertwo->role}}</span></td>
                                <td>{{$item->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{route('admin.thread.show', $item)}}"  class="btn btn-small btn-info">@lang('app.btn.view')</a>
                                    <a href="{{route('admin.thread.delete', $item)}}" class="btn btn-small btn-warning btn-delete">@lang('app.btn.delete')</a>
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
