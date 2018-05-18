@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <div class="row-fluid page-head">
        <h2 class="page-title"> Discussion entre {{$item->sender->name}} et {{$item->receiver->name}}</h2>
    </div>
    <div id="page-content" class="page-content">
        <section>
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
</div>
@endsection
