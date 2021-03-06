@extends('layouts.lte')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="col-sm-3">
          <!-- Profile Image -->
          @include('backend.user.profile.image', ['user'=>$item])
          
          <!-- About Me Box -->
          @include('backend.user.profile.about', ['user'=>$item])

        </div>
        <div class="col-sm-9">
          <!-- detail-->
          @include('backend.user.profile.detail', ['user'=>$item])
    </div>
</div>
@endsection

