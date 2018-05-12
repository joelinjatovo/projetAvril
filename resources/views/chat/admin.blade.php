@extends('layouts.app')

@section('style')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<style>
  .chat {
    list-style: none;
    margin: 0;
    padding: 0;
  }

  .chat li {
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
  }

  .chat li .chat-body p {
    margin: 0;
    color: #777777;
  }

  .panel-body {
    overflow-y: scroll;
    height: 350px;
  }

  ::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
  }

  ::-webkit-scrollbar {
    width: 12px;
    background-color: #F5F5F5;
  }

  ::-webkit-scrollbar-thumb {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
  }
</style>
@endsection


@section('content')
@component('includes.breadcrumb')
    @lang('app.chats')
@endcomponent
<div  id="app" class="container">
    <div class="row">
        <div class="col-sm-6">
            <create-thread :initial-users="{{ $users }}"></create-thread>
        </div>
        <div class="col-sm-6">
            <threads :initial-threads="{{ $threads }}" :user="{{ $user }}"></threads>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/app.js') }}"></script>
@endsection
