<tr class="data-item-{{$product->id}} item">
 <td>
     <a  href="{{route('seller.product.show', $product)}}">
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
 </td>
 <td>{{$product->created_at->diffForHumans()}}</td>
 <td>
     <a class="data-item-status-{{$product->id}}" href="{{route('seller.products', ['filter'=>$product->status])}}">
         @if($product->status=='published')
         <span class="label label-success">{{$product->status}}</span>
         @elseif($product->status=='ordered')
         <span class="label label-danger">{{$product->status}}</span>
         @else
         <span class="label label-warning">{{$product->status}}</span>
         @endif
     </a>
 </td>
 <td>
    <div class="btn-group pull-right">
      <a class="btn btn-default btn-status"
          data-action="{{$product->status=='published'?'archive':'publish'}}" 
          data-id="{{$product->id}}" 
          data-href="{{route('seller.products')}}">
              @if($product->status=='published') 
                  @lang('app.btn.archive') 
              @else
                @lang('app.btn.publish') 
              @endif
      </a>
      <a class="btn btn-danger btn-delete" 
          data-action="delete" 
          data-id="{{$product->id}}" 
          data-href="{{route('seller.products')}}"><i class="fa fa-trash-o"></i></a>
    </div>
 </td>
</tr>