@extends('layouts.backend')


@section('subcontent')
<div id="app">
    <div class="row">
        <div class="col-sm-6">
            <users :initial-users="{{ $users }}"></users>
        </div>
        <div class="col-sm-6">
            <threads :initial-threads="{{ $threads }}" :user="{{ $user }}"></threads>
        </div>
    </div>
</div>
@endsection
