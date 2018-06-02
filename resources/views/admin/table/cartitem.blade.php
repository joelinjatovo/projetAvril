<table class="table boo-table table-striped table-hover">
 <thead>
     <tr>
         <th scope="col">@lang('app.table.id') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.photo') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.title')/@lang('app.table.content') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.price')/@lang('app.table.tma') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.date') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.status') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.apl') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.afa') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.customer') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.actions') </th>
     </tr>
 </thead>
 <tbody>
     @foreach($cartitems as $cartitem)
     <tr>
         <td>{{$cartitem->id}}</td>
         <td>
             @if($cartitem->product)
                <a href="{{route('admin.product.show', ['product'=>$cartitem->product])}}"><img class="thumb" src="{{$cartitem->product->imageUrl()}}" width="50"></a>
             @endif
         </td>
         <td>
             @if($cartitem->product)
                 <a href="{{route('admin.product.show', ['product'=>$cartitem->product])}}">{{$cartitem->product->title}}</a><br>
                 {{$cartitem->product->excerpt()}}
             @endif
         </td>
         <td>{{$cartitem->currency}} {{$cartitem->price}} / {{$cartitem->tma}}</td>
         <td>{{$cartitem->created_at->diffForHumans()}}</td>
         <td>
             <a href="{{route('admin.shop', ['filter'=>$cartitem->status])}}">
                 @if($cartitem->status=='ordered')
                 <span class="label label-success">{{$cartitem->status}}</span>
                 @else
                 <span class="label label-warning">{{$cartitem->status}}</span>
                 @endif
             </a>
         </td>
         <td>
             @if($cartitem->apl)
             <a href="{{route('admin.user.show', $cartitem->apl)}}">{{$cartitem->apl->name}}</a>
             <p>{{$cartitem->apl_paid_at?$cartitem->apl_paid_at->diffForHumans():''}}</p>
             @endif
         </td>
         <td>
             @if($cartitem->afa)
             <a href="{{route('admin.user.show', $cartitem->afa)}}">{{$cartitem->afa->name}}</a>
             @endif
         </td>
         <td>
             @if($cartitem->author)
             <a href="{{route('admin.user.show', $cartitem->author)}}">{{$cartitem->author->name}}</a>
             @endif
         </td>
         <td>
            <a href="{{route('admin.shop.delete', $cartitem)}}" class="btn btn-small btn-warning btn-delete">@lang('app.btn.delete')</a>
             
            @if($cartitem->status=='ordered')
                @if(!$cartitem->apl_paid_at)
                <a href="{{route('admin.shop.pay', ['cartitem'=>$cartitem, 'role'=>'apl'])}}" class="btn btn-small btn-info btn-delete">@lang('app.admin.shop.pay.apl')</a>
                @endif

                @if(!$cartitem->afa_paid_at)
                <a href="{{route('admin.shop.pay', ['cartitem'=>$cartitem, 'role'=>'afa'])}}" class="btn btn-small btn-info btn-delete">@lang('app.admin.shop.pay.afa')</a>
                @endif
            @endif
         </td>
     </tr>
     @endforeach
 </tbody>
</table>