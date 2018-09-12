<tr class="item">
 <td>
     @if($product = $order->product)
     <a  href="{{route('admin.product.show', $product)}}">
      <div class="item-img">
        <img src="{{$product->imageUrl()}}" alt="Product Image">
      </div>
      <div class="item-info">
        <span class="item-title">
            {{$product->title}}
            <span class="label label-warning pull-right" title="@lang('app.price')">{{$product->price}}</span>
        </span>
        <span class="item-description">
          {{$product->excerpt()}}
        </span>
      </div>
     </a>
     @endif
 </td>
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
    <form class="pull-right" action="{{route('admin.order.list')}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="order" value="{{$order->id}}">
        <div class="btn-group">
         @if($order->status=='pinged')
          <button type="button" class="btn btn-danger btn-delete"><i class="fa fa-trash-o"></i></button>
         @else
          <a href="{{route('admin.invoice.show', $order)}}" class="btn btn-default">@lang('app.btn.view_invoice')</a>
         @endif
        </div>
     </form>
     @if(!$order->isAplPaid())
        <form action="{{route('admin.order.show', $order)}}" method="post" class="pull-right">
            {{csrf_field()}}
            <input type="hidden" name="action" value="pay-apl">
            <button type="submit" class="btn btn-success pull-left">@lang('admin.btn.pay-apl')</button>
        </form>
     @endif
 </td>
</tr>