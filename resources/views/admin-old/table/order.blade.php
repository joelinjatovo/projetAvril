<table class="table boo-table table-striped table-hover">
 <thead>
     <tr>
         <th scope="col">@lang('app.table.photo') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.title')/@lang('app.table.content') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.price')<span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.reservation')<span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.tma')<span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.cpc')<span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.mio')<span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.date') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.status') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.apl') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.afa') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.customer') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.actions') <span class="column-sorter"></span></th>
     </tr>
 </thead>
 <tbody>
     @foreach($orders as $order)
     <tr>
         <td>
             <a href="{{route('admin.order.show', ['order'=>$order])}}"><img class="thumb" src="{{$order->product->imageUrl()}}" width="50"></a>
         </td>
         <td>
             <a href="{{route('admin.order.show', ['order'=>$order])}}">{{$order->product->title}}</a><br>
             {{$order->product->excerpt()}}
         </td>
         <td>{{$order->currency}} {{$order->price}}</td>
         <td>
             {{$order->currency}} {{$order->reservation}}
             <span class="badge badge-success">&nbsp;</span>
         </td>
         <td>
             {{$order->currency}} {{$order->tma}}
             @if($order->isTmaPaid())
             <span class="badge badge-success">&nbsp;</span>
             @else
             <span class="badge badge-important">&nbsp;</span>
             @endif
         </td>
         <td>
             {{$order->currency}} {{$order->afa_amount}}
             @if($order->isAfaPaid())
             <span class="badge badge-success">&nbsp;</span>
             @else
             <span class="badge badge-important">&nbsp;</span>
             @endif
         </td>
         <td>
             {{$order->currency}} {{$order->apl_amount}}
             @if($order->isAplPaid())
             <span class="badge badge-success">&nbsp;</span>
             @else
             <span class="badge badge-important">&nbsp;</span>
             @endif</td>
         <td>{{$order->created_at->diffForHumans()}}</td>
         <td>
             <a href="{{route('admin.order.list', ['filter'=>$order->status])}}">
                 @if($order->status=='published')
                 <span class="label label-success">{{$order->status}}</span>
                 @else
                 <span class="label label-warning">{{$order->status}}</span>
                 @endif
             </a>
         </td>
         <td>
             @if($order->apl)
             <a href="{{route('admin.user.show', $order->apl)}}">{{$order->apl->name}}</a>
             @endif
         </td>
         <td>
             @if($order->afa)
             <a href="{{route('admin.user.show', $order->afa)}}">{{$order->afa->name}}</a>
             @endif
         </td>
         <td>
             @if($order->author)
             <a href="{{route('admin.user.show', $order->author)}}">{{$order->author->name}}</a>
             @endif
         </td>
         <td>
             @if($order->status=='pinged')
                <form action="{{route('admin.order.show', $order)}}" method="post" class="pull-right">
                    {{csrf_field()}}
                    <input type="hidden" name="action" value="delete">
                    <button type="submit" class="btn btn-success pull-left">@lang('app.btn.delete')</button>
                </form>
             @else
             <a href="{{route('admin.invoice.show', $order)}}" class="btn btn-default">@lang('app.btn.view_invoice')</a>
             @endif
             @if(!$order->isAplPaid())
                <form action="{{route('admin.order.show', $order)}}" method="post" class="pull-right">
                    {{csrf_field()}}
                    <input type="hidden" name="action" value="pay-apl">
                    <button type="submit" class="btn btn-success pull-left">@lang('admin.btn.pay-apl')</button>
                </form>
             @endif
         </td>
     </tr>
     @endforeach
 </tbody>
</table>