
 <table id="exampleDTA" class="table boo-table table-striped table-hover">
     <thead>
         <tr>
           <th scope="col">
             <label class="checkbox">
                 <input class="checkbox" type="checkbox" value="option1">
             </label>
           </th>
             <th scope="col">Id <span class="column-sorter"></span></th>
             <th scope="col">Photo / Avatar <span class="column-sorter"></span></th>
             <th scope="col">Nom <span class="column-sorter"></span></th>
             <th scope="col">Email <span class="column-sorter"></span></th>
             <th scope="col">Date d'inscription <span class="column-sorter"></span></th>
             <th scope="col">Role <span class="column-sorter"></span></th>
             <th scope="col">Type <span class="column-sorter"></span></th>
             <th scope="col">Statut <span class="column-sorter"></span></th>
             <th scope="col">Actions <span class="column-sorter"></span></th>
         </tr>
     </thead>
     <tbody>
         @foreach($users as $item)
         <tr class="user-item-{{$item->id}}">
           <td>
               <label class="checkbox">
                   <input class="checkbox" type="checkbox" value="{{$item->id}}">
               </label>
           </td>
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
             @if($item->status!='blocked')
                <a href="{{route('admin.user.block', $item)}}" class="btn btn-small btn-info">Bloquer</a>
             @endif
             @if($item->status=='active')
                <a href="{{route('admin.user.disable', $item)}}" class="btn btn-small btn-warning">Desactiver</a>
             @else
                <a href="{{route('admin.user.active', $item)}}" class="btn btn-small btn-warning">Activer</a>
             @endif
             </td>
         </tr>
         @endforeach
     </tbody>
 </table>