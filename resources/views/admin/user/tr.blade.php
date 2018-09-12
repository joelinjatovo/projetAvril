<tr class="user-item-{{$user->id}} data-item-{{$user->id}} item">
     <td>
         <a  href="{{route('admin.user.show', $user)}}">
          <div class="item-img">
            <img class="img-circle" src="{{$user->imageUrl()}}" alt="Product Image">
          </div>
          <div class="item-info">
            <span class="item-title">
                {{$user->name}}
                @if($user->isOnline())
                <span class="badge badge-warning pull-right" style="background-color:green;">&nbsp;</span>
                @endif
            </span>
            <span class="item-description">
              {{$user->email}}
            </span>
          </div>
         </a>
     </td>
     <td>{{$user->created_at->diffForHumans()}}</td>
     <td><a href="{{route('admin.user.list', ['filter'=>$user->role])}}"><span class="label label-warning">{{$user->role}}</span></a></td>
     <td>
         @if($user->isPerson())
         <a href="{{route('admin.user.list', ['filter'=>$user->type])}}"><span class="label label-info">{{$user->type}}</span>
         </a>
         @else
         <a href="{{route('admin.user.list', ['filter'=>$user->type])}}"><span class="label label-success">{{$user->type}}</span>
         </a>
         @endif
     </td>
     <td>
         <a class="data-item-status-{{$user->id}}" href="{{route('admin.user.list', ['filter'=>$user->status])}}">
         @if($user->status=='active')
         <span class="label label-success">{{$user->status}}</span>
         @else
         <span class="label label-warning">{{$user->status}}</span>
         @endif
         </a>
     </td>
     <td>
        <div class="btn-group pull-right">
          <a type="button" class="btn btn-default" href="{{route('admin.user.contact', $user)}}">@lang('app.btn.contact')</a>
          <a class="btn btn-default btn-status"
              data-action="{{$user->status=='active'?'disable':'active'}}" 
              data-id="{{$user->id}}" 
              data-href="{{route('admin.user.list')}}">
                  @if($user->status=='active') 
                      @lang('app.btn.disable') 
                  @else
                    @lang('app.btn.active') 
                  @endif
          </a>
          <a class="btn btn-danger btn-delete" 
              data-action="delete" 
              data-id="{{$user->id}}" 
              data-href="{{route('admin.user.list')}}"><i class="fa fa-trash-o"></i></a>
        </div>
     </td>
</tr>
