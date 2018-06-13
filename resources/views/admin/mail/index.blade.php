@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <div class="row-fluid page-head">
        <h2 class="page-title"> Message de {{$item->sender->name}}</h2>
    </div>
    <div>
        <a href="{{route('admin.mail.compose', $item)}}"  class="btn btn-small btn-success">@lang('app.btn.send')</a>
        <a href="{{route('admin.mail.delete', $item)}}" class="btn btn-small btn-warning btn-delete">@lang('app.btn.delete')</a>
    </div>
    <div id="page-content" class="page-content">
        <section>
            <div class="page-header">
                <h3>{{$item->subject}}</h3>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    @include('includes.alerts')
                    <div class="panel panel-default">
                        <div class="panel-body">
                            {{$item->content}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="page-content tab-content overflow-y">
        <div class="page-header">
            <h3>@lang('app.receivers')</h3>
        </div>
        <div class="row-fluid">
            @include('admin.table.user',['users'=>$item->users])
        </div>
    </div>
</div>
@endsection
