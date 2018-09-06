<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Détail</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <strong><i class="fa fa-book margin-r-5"></i> @lang('app.form.login')</strong>
      <p class="text-muted">{{$user->name}}</p>
      <hr>
      <strong><i class="fa fa-book margin-r-5"></i> @lang('app.form.email')</strong>
      <p class="text-muted">{{$user->email}}</p>
      <hr>
      <strong><i class="fa fa-book margin-r-5"></i> @lang('app.form.first_name')</strong>
      <p class="text-muted">{{$user->meta('first_name')}}</p>
      <hr>
      <strong><i class="fa fa-book margin-r-5"></i> @lang('app.form.last_name')</strong>
      <p class="text-muted">{{$user->meta('last_name')}}</p>
      <hr>
      <strong><i class="fa fa-book margin-r-5"></i> @lang('app.form.language')</strong>
      <p class="text-muted">{{$item->language=='en'?'English':'Français'}}</p>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <div class="form-group">
            <a href="{{route('profile.edit')}}"  class="btn btn-default">Modifier Profile</a>
            <a href="{{route('avatar.edit')}}"   class="btn btn-default">Modifier Avatar</a>
            <a href="{{route('password.edit')}}" class="btn btn-default">Modifier Mot de passe</a>
            <a href="{{route('location.edit')}}" class="btn btn-default">Modifier Localisation</a>
        </div>
    </div>
    <!-- /.box-footer -->
</div>
<!-- /.box -->