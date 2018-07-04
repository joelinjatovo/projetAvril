<table class="table boo-table table-striped table-hover">
 <thead>
     <tr>
         <th scope="col">@lang('app.table.id') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.photo') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.name') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.email') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.date') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.role') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.type') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.status') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.actions') <span class="column-sorter"></span></th>
     </tr>
 </thead>
 <tbody>
     @foreach($users as $item)
     <tr class="user-item-{{$item->id}}">
         <td>{{$item->id}}</td>
         <td style="position: relative;">
             <a href="{{route('admin.user.show', $item)}}"><img class="img-circle" src="{{$item->imageUrl()}}" width="50"></a>
             @if($item->isOnline())
                <span class="badge badge-danger" style="background-color:green; margin-left:-20px;margin-bottom:-30px;">&nbsp;</span>
             @endif
         </td>
         <td>{{$item->name}}</td>
         <td>{{$item->email}}</td>
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
             <form id="form-item-action-delete" class="pull-right" action="{{route('admin.user.list')}}" method="post">
                 {{csrf_field()}}
                 <input type="hidden" name="user" value="{{$item->id}}">
                 <input type="hidden" name="action" value="delete">
                 <button type="submit" class="btn btn-small btn-warning">@lang('app.btn.delete')</button>
             </form>
             @if($item->status=='active')
             <form id="form-item-action-disable" class="pull-right" action="{{route('admin.user.list')}}" method="post">
                 {{csrf_field()}}
                 <input type="hidden" name="user" value="{{$item->id}}">
                 <input type="hidden" name="action" value="disable">
                 <button type="submit" class="btn btn-small btn-success">@lang('app.btn.disable')</button>
             </form>
             @else
             <form id="form-item-action-active" class="pull-right" action="{{route('admin.user.list')}}" method="post">
                 {{csrf_field()}}
                 <input type="hidden" name="user" value="{{$item->id}}">
                 <input type="hidden" name="action" value="active">
                 <button type="submit" class="btn btn-small btn-info">@lang('app.btn.active')</button>
                 
             </form>
             @endif
             <a href="{{route('admin.user.contact', $item)}}" class="btn btn-small btn-default pull-right">@lang('app.btn.contact')</a>
         </td>
     </tr>
     @endforeach
 </tbody>
</table>
