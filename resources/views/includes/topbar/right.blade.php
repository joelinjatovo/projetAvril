<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      @include('includes.topbar.social')
      
      <li>
        <a href="{{route('login')}}">
          <i class="fa fa-lock"></i> @lang('app.login')
        </a>
      </li>
      <li class="dropdown messages-menu">
        <a href="#" class="dropdown-toggle label-success" data-toggle="dropdown">
          <i class="fa fa-user-o"></i> @lang('app.register')
        </a>
        <ul class="dropdown-menu">
          <li class="header">@lang('app.register_as')</li>
          <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
              <li>
                <a href="{{url('register/member')}}">
                    <i class="fa fa-users text-aqua"></i> @lang('app.member')
                </a>
              </li>
              <li>
                <a href="{{url('register/afa')}}">
                    <i class="fa fa-users text-aqua"></i> @lang('app.afa')
                </a>
              </li>
              <li>
                <a href="{{url('register/apl')}}">
                    <i class="fa fa-users text-aqua"></i> @lang('app.apl')
                </a>
              </li>
              <li>
                <a href="{{url('register/seller')}}">
                    <i class="fa fa-users text-aqua"></i> @lang('app.seller')
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </li>

    </ul>
</div>