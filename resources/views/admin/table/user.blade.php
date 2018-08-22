<table class="table boo-table table-striped table-hover items-list">
 <thead>
     <tr>
         <th scope="col">@lang('app.table.users') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.date') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.role') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.type') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.status') <span class="column-sorter"></span></th>
         <th scope="col" class="pull-right">@lang('app.table.actions') <span class="column-sorter"></span></th>
     </tr>
 </thead>
 <tbody>
     @foreach($users as $item)
     <tr class="user-item-{{$item->id}} item">
         <td>
             <a  href="{{route('admin.user.show', $item)}}">
              <div class="item-img">
                <img class="img-circle" src="{{$item->imageUrl()}}" alt="Product Image">
              </div>
              <div class="item-info">
                <span class="item-title">
                    {{$item->name}}
                    @if($item->isOnline())
                    <span class="badge badge-warning pull-right" style="background-color:green;">&nbsp;</span>
                    @endif
                </span>
                <span class="item-description">
                  {{$item->email}}
                </span>
              </div>
             </a>
         </td>
         <td>{{$item->created_at->diffForHumans()}}</td>
         <td><a href="{{route('admin.user.list', ['filter'=>$item->role])}}"><span class="label label-warning">{{$item->role}}</span></a></td>
         <td>
             @if($item->isPerson())
             <a href="{{route('admin.user.list', ['filter'=>$item->typed])}}"><span class="label label-info">{{$item->type}}</span>
             </a>
             @else
             <a href="{{route('admin.user.list', ['filter'=>$item->typed])}}"><span class="label label-success">{{$item->type}}</span>
             </a>
             @endif
         </td>
         <td>
             <a href="{{route('admin.user.list', ['filter'=>$item->status])}}">
             @if($item->status=='active')
             <span class="label label-success">{{$item->status}}</span>
             @else
             <span class="label label-warning">{{$item->status}}</span>
             @endif
             </a>
         </td>
         <td>
            <form class="pull-right" action="{{route('admin.user.list')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="user" value="{{$item->id}}">
                <div class="btn-group">
                 @if($item->status=='active')
                  <button type="button" class="btn btn-default btn-disable">@lang('app.btn.disable')</button>
                 @else
                  <button type="button" class="btn btn-default btn-active">@lang('app.btn.active')</button>
                 @endif
                  <a type="button" class="btn btn-default" href="{{route('admin.user.contact', $item)}}">@lang('app.btn.contact')</a>
                  <button type="button" class="btn btn-danger btn-delete"><i class="fa fa-trash-o"></i></button>
                </div>
             </form>
         </td>
     </tr>
     @endforeach
 </tbody>
</table>
