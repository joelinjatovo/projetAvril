@extends('layouts.auth')

@section('content')
<div class="container">
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
