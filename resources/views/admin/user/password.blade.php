@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <form class="form-horizontal" role="form" method="post" action="{{route('password.edit')}}">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        @include('includes.notification')
        <fieldset>
            <legend>Modification de mot de passe</legend>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="old_password">Ancien mot de passe *</label>
                <div class="col-sm-8">
                    <input name="old_password" type="password" class="form-control" id="old_password" placeholder="Ancien mot de passe" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="password">Nouveau mot de passe *</label>
                <div class="col-sm-8">
                    <input name="password" type="password" class="form-control" id="password" placeholder="Nouveau mot de passe" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="password_confirmation">Confirmer nouveau mot de passe *</label>
                <div class="col-sm-8">
                    <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Confirmer nouveau mot de passe" required>
                </div>
            </div>
        </fieldset>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </form>
</div>
@endsection

