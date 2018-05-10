@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <div class="row-fluid page-head">
        <h2 class="page-title"> Discussion entre {{$item->userone->name}} et {{$item->usertwo->name}}</h2>
    </div>
    <div id="page-content" class="page-content">
        <section>
            <div class="row-fluid">
                <div class="span12">
                    @include('includes.alerts')
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <ul  class="list-group">
                                @foreach($item->messages as $message)
                                <li class="list-group-item clearfix">
                                    <div class="@if($message->sender->id == $item->userone->id) {{'pull-left'}} @else {{'pull-right'}} @endif">
                                        <h4>{{$message->sender->name}}</h4>
                                        {{$message->message}}
                                        <p>{{$message->created_at->diffForHumans()}}</p>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="panel-footer">
                            <chat-form
                                v-on:messagesent="addMessage"
                                :user="{{ Auth::user() }}"
                            ></chat-form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
