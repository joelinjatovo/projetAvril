@extends('layouts.lte')

@section('content')
<div class="row">
    <form class="form-horizontal" role="form" method="post" action="{{route('password.edit')}}" enctype="multipart/form-data">
         {{csrf_field()}}
         <div class="col-sm-12">
            <div class="box">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="old_password">Ancien mot de passe *</label>
                        <div class="col-sm-6">
                            <input name="old_password" type="password" class="form-control" id="old_password" placeholder="Ancien mot de passe" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="password">Nouveau mot de passe *</label>
                        <div class="col-sm-6">
                            <input name="password" type="password" class="form-control" id="password" placeholder="Nouveau mot de passe" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="password_confirmation">Confirmer nouveau mot de passe *</label>
                        <div class="col-sm-6">
                            <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Confirmer nouveau mot de passe" required>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                  <div class="pull-right">
                      <button type="submit" class="btn btn-info" name="method" value="draft"><i class="fa fa-database"></i> @lang('app.btn.save')</button>
                  </div>
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
    </form>
</div>
@endsection

