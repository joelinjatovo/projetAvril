<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      @include('includes.topbar.social')
      
      <!-- Messages: style can be found in dropdown.less-->
      <?php
        $mailQuery = auth()->user()->mails()->wherePivot('read', 0);
        $unreadMail = $mailQuery->count();
        $mails = $mailQuery->take(10)->get();
      ?>
      <li class="dropdown messages-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-envelope-o"></i>
          <span class="label label-success">{{$unreadMail}}</span>
          <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
        </a>
        <ul class="dropdown-menu">
          <li class="header">You have {{$unreadMail}} messages</li>
          <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
             @foreach($mails as $mail)
              <li><!-- start message -->
                <a href="{{route('admin.mail.index', $mail)}}">
                  <div class="pull-left">
                    <img src="{{$mail->sender->imageUrl()}}" class="img-circle" alt="User Image">
                  </div>
                  <h4>
                    {{$mail->subject}}
                    <small><i class="fa fa-clock-o"></i> {{$mail->created_at->diffForHumans()}}</small>
                  </h4>
                  <p>{{$mail->content}}</p>
                </a>
              </li>
              <!-- end message -->
              @endforeach
            </ul>
          </li>
          <li class="footer"><a href="{{route('admin.mail.list',['filter'=>'inbox'])}}">See All Messages</a></li>
        </ul>
      </li>

      <!-- Notifications: style can be found in dropdown.less -->
      <li class="dropdown notifications-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-bell-o"></i>
          <span class="label label-warning" id="notifications-count">{{auth()->user()->unreadNotifications()->count()}}</span>
        </a>
        <ul class="dropdown-menu">
          <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu" id="notifications">
              @foreach (auth()->user()->unreadNotifications as $notification)
              <li>
                <a href="#">
                  <i class="fa fa-users text-aqua"></i> 5 new members joined today
                </a>
              </li>
              @endforeach
            </ul>
          </li>
          <li class="footer"><a href="#">View all notifications</a></li>
        </ul>
      </li>

      <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="{{auth()->user()->imageUrl()}}" class="user-image" alt="User Image">
          <span class="hidden-xs">{{auth()->user()->fullname()}}</span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <img src="{{Auth::user()->imageUrl()}}" class="img-circle" alt="User Image">

            <p>
              {{auth()->user()->fullname()}} - {{auth()->user()->role}}
              <small>{{auth()->user()->created_at->diffForHumans()}}</small>
            </p>
          </li>
          <!-- Menu Body -->
          <li class="user-body">
            <div class="row">
              <div class="col-xs-4 text-center">
                <a href="#">Followers</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="#">Sales</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="#">Friends</a>
              </div>
            </div>
            <!-- /.row -->
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="{{route('profile')}}" class="btn btn-default btn-flat">Profile</a>
            </div>
            <div class="pull-right">
              <a href="{{route('logout')}}" class="btn btn-default btn-flat">Sign out</a>
            </div>
          </li>
        </ul>
      </li>
    </ul>
</div>