<tr class="user-item-{{$user->id}} data-item-{{$user->id}} item">
     <td>
         <a  href="{{route('apl.user.contact', $user)}}">
          <div class="item-img">
            <img class="img-circle" src="{{$user->imageUrl()}}" alt="User Image">
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
     <td>{{$user->apl_ends_at?ucfirst($user->apl_ends_at->diffForHumans()):''}}</td>
     <td>
        <div class="btn-group pull-right">
          <a type="button" class="btn btn-default" href="{{route('apl.user.contact', $user)}}">@lang('app.btn.contact')</a>
        </div>
     </td>
</tr>
