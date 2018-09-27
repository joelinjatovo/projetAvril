<table class="table table-striped table-hover items-list">
    <thead>
        <tr>
            <th>@lang('app.afa')</th>
            <th class="pull-right">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
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
             <td>
                <div class="btn-group pull-right">
                  <a id="btn-select-afa" class="btn btn-default pull-right" href="#" data-id="{{$user->id}}" data-title="{{$user->name}}" data-html="{{$user->meta('orga_description')}}">@lang('member.select')</a>
                </div>
             </td>
        </tr>
        @endforeach
    </tbody>
</table>


