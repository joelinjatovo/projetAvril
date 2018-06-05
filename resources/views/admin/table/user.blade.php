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
         <td>
             <a href="{{route('admin.user.show', $item)}}"><img class="thumb" src="{{$item->imageUrl()}}" width="50"></a>
         </td>
         <td>{{$item->name}}</td>
         <td>{{$item->email}}</td>
         <td>{{$item->created_at->diffForHumans()}}</td>
         <td><a href="{{route('admin.user.list', ['filter'=>$item->role])}}"><span class="label label-warning">{{$item->role}}</span></a></td>
         <td><a href="{{route('admin.user.list', ['filter'=>$item->typed])}}"><span class="label label-info">{{$item->type}}</span></a></td>
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
             @if($item->status=='active')
                <a href="{{route('admin.user.disable', $item)}}" class="btn btn-small btn-success">@lang('app.btn.disable')</a>
             @else
                <a href="{{route('admin.user.active', $item)}}" class="btn btn-small btn-info">@lang('app.btn.active')</a>
             @endif
             <a href="{{route('admin.user.delete', $item)}}" class="btn btn-small btn-warning">@lang('app.btn.delete')</a>
             <a href="{{route('admin.user.contact', $item)}}" class="btn btn-small btn-default">@lang('app.btn.contact')</a>
         </td>
     </tr>
     @endforeach
 </tbody>
</table>
