<div class="box box-primary">
    <div class="box-body box-profile">
      <img class="profile-user-img img-responsive img-circle" src="{{$user->imageUrl()}}" alt="User profile picture">
      <h3 class="profile-username text-center">{{$user->fullname()}}</h3>
      <p class="text-muted text-center">{{ucfirst($user->role)}}{{$user->created_at?' - '.$user->created_at->diffForHumans():''}}</p>
      
      @if($user->hasRole('member'))
      <ul class="list-group list-group-unbordered">
        <li class="list-group-item">
          <b>@lang('app.orders')</b> <a class="pull-right">{{$user->orders()->where('status', 'ordered')->count()}}</a>
        </li>
        <li class="list-group-item">
          <b>@lang('app.purchases')</b> <a class="pull-right">{{$user->orders()->where('status', 'paid')->count()}}</a>
        </li>
        <li class="list-group-item">
          <b>@lang('app.favorites')</b> <a class="pull-right">{{$user->favorites()->count()}}</a>
        </li>
      </ul>
      @endif
      
      @if($user->hasRole('apl'))
      <ul class="list-group list-group-unbordered">
        <li class="list-group-item">
          <b>@lang('app.customers')</b> <a class="pull-right">{{$user->customers()->count()}}</a>
        </li>
        <li class="list-group-item">
          <b>@lang('app.orders')</b> <a class="pull-right">{{$user->orders()->where('status', 'ordered')->count()}}</a>
        </li>
        <li class="list-group-item">
          <b>@lang('app.sales')</b> <a class="pull-right">{{$user->orders()->where('status', 'paid')->count()}}</a>
        </li>
      </ul>
      @endif
      
      @if($user->hasRole('seller'))
      <ul class="list-group list-group-unbordered">
        <li class="list-group-item">
          <b>@lang('app.products')</b> <a class="pull-right">{{$user->products()->count()}}</a>
        </li>
        <li class="list-group-item">
          <b>@lang('app.orders')</b> <a class="pull-right">{{$user->products()->where('products.status', 'ordered')->count()}}</a>
        </li>
        <li class="list-group-item">
          <b>@lang('app.sales')</b> <a class="pull-right">{{$user->products()->where('products.status', 'paid')->count()}}</a>
        </li>
      </ul>
      @endif
      
      @if($user->hasRole('afa'))
      <ul class="list-group list-group-unbordered">
        <li class="list-group-item">
          <b>@lang('app.orders')</b> <a class="pull-right">{{$user->orders()->where('status', 'ordered')->count()}}</a>
        </li>
        <li class="list-group-item">
          <b>@lang('app.sales')</b> <a class="pull-right">{{$user->orders()->where('status', 'paid')->count()}}</a>
        </li>
      </ul>
      @endif
      
      <a href="{{route('admin.user.contact', $item)}}" class="btn btn-primary btn-block"><b>@lang('app.btn.contact')</b></a>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

