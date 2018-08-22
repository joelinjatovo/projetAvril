@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <form class="form-horizontal" role="form" method="post" action="{{route('avatar.edit')}}" 
          enctype="multipart/form-data">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        @include('includes.alerts')
        <fieldset>
            <legend>Modification Image</legend>
            <div class="col-sm-12">
                <div class="col-sm-4">
                    <section class="widget">
                        <img src="{{$item->imageUrl()}}" alt="{{$item->name}}" width="100%">
                    </section>
                </div>
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="file" class="form-control" id="image" name="image" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</div>
@endsection

