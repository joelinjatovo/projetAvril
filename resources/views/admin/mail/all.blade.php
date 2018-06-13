@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <div class="row-fluid page-head">
        <h2 class="page-title"> @lang('app.admin.mail.list') </h2>
    </div>
    <div>
        <h4>@lang('app.search.filter')</h4>
        <form method="get" action="">
            <div class="col-md-3">
                <input id="q" type="text" class="form-control" name="q" placeholder="@lang('app.search')" title="@lang('app.search')" value="{{$q}}">
            </div>
            <div class="col-md-3">
                <select class="form-control" name="receiver">
                    <option value="0">@lang('app.select_user')</option>
                    @foreach($users as $user)
                        <option {{$receiver==$user->id?'selected':''}} value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input id="number" type="number" class="form-control" name="record" title="Nombre par page" placeholder="Nombre par page" min="10" value="{{$record}}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-success">@lang('app.btn.search')</button>
            </div>
        </form>
    </div>
    <br>
    <br>
    <div id="page-content" class="page-content">
        <div class="row-fluid">
            <div class="span12">
                <a href="{{route('admin.mail.compose')}}" class="btn btn-green btn-glyph" >@lang('app.btn.compose')</a>
            </div>
        </div>
        <br>
        <section>
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
                                <th scope="col">Status<span class="column-sorter"></span></th>
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
                                <td>{{$item->sender?$item->sender->name:''}} <span class="badge badge-info">{{$item->sender?$item->sender->role:''}}</span></td>
                                <td>{{$item->status}}</span></td>
                                <td>{{$item->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{route('admin.mail.index', $item)}}"  class="btn btn-small btn-info">@lang('app.btn.view')</a>
                                    <a href="{{route('admin.mail.compose', $item)}}"  class="btn btn-small btn-success">@lang('app.btn.send')</a>
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
