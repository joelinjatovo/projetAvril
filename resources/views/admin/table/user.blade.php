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
     <tr class="user-item-{{$item->id}} data-item-{{$item->id}} item">
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
             <a class="data-item-status-{{$item->id}}" href="{{route('admin.user.list', ['filter'=>$item->status])}}">
             @if($item->status=='active')
             <span class="label label-success">{{$item->status}}</span>
             @else
             <span class="label label-warning">{{$item->status}}</span>
             @endif
             </a>
         </td>
         <td>
            <div class="btn-group pull-right">
              <a type="button" class="btn btn-default" href="{{route('admin.user.contact', $item)}}">@lang('app.btn.contact')</a>
              <a class="btn btn-default btn-status"
                  data-action="{{$item->status=='active'?'disable':'active'}}" 
                  data-id="{{$item->id}}" 
                  data-href="{{route('admin.user.list')}}">
                      @if($item->status=='active') 
                          @lang('app.btn.disable') 
                      @else
                        @lang('app.btn.active') 
                      @endif
              </a>
              <a class="btn btn-danger btn-delete" 
                  data-action="delete" 
                  data-id="{{$item->id}}" 
                  data-href="{{route('admin.user.list')}}"><i class="fa fa-trash-o"></i></a>
            </div>
         </td>
     </tr>
     @endforeach
 </tbody>
</table>
