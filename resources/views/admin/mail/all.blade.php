@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <div class="row-fluid page-head">
        <h2 class="page-title"> @lang('app.admin.mail.list') </h2>
    </div>
    <div id="page-content" class="page-content">
        <section>
            <div class="page-header">
            </div>
            <div class="row-fluid">
                <div class="span12">
                    @include('includes.alerts')
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID <span class="column-sorter"></span></th>
                                <th scope="col">Subject<span class="column-sorter"></span></th>
                                <th scope="col">Contenu<span class="column-sorter"></span></th>
                                <th scope="col">Sender<span class="column-sorter"></span></th>
                                <th scope="col">Receiver<span class="column-sorter"></span></th>
                                <th scope="col">Date<span class="column-sorter"></span></th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($items as $item) 
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->subject}}</td>
                                <td>{{$item->content}}</td>
                                <td>{{$item->sender->name}} <span class="badge badge-info">{{$item->sender->role}}</span></td>
                                <td>{{$item->receiver->name}} <span class="badge badge-info">{{$item->receiver->role}}</span></td>
                                <td>{{$item->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{route('admin.mail.show', $item)}}"  class="btn btn-small btn-info">@lang('app.btn.view')</a>
                                    <a href="{{route('admin.mail.delete', $item)}}" class="btn btn-small btn-warning btn-delete">@lang('app.btn.delete')</a>
                                </td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
                {{$items->links()}}
            </div>
        </section>
    </div>
</div>
@endsection
