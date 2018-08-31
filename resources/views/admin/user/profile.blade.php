@extends('layouts.lte')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="col-sm-3">
          <!-- Profile Image -->
          @include('admin/user/inc/profile-image', ['user'=>$item])
          
          <!-- About Me Box -->
          @include('admin/user/inc/profile-about')

        </div>
        <div class="col-sm-9">
          <!-- detail-->
          @include('admin/user/inc/profile-detail', ['user'=>$item])
    </div>
</div>
@endsection

