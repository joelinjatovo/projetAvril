<table class="table table-striped table-hover items-list">
 <thead>
     <tr>
         <th scope="col">@lang('app.table.products') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.date') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.status') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.seller') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.author') <span class="column-sorter"></span></th>
         <th scope="col" class="pull-right text-right" width="150px">@lang('app.table.actions') </th>
     </tr>
 </thead>
 <tbody>
     @foreach($products as $product)
     <tr class="data-item-{{$product->id}} item">
         <td>
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
         </td>
         <td>{{$product->created_at->diffForHumans()}}</td>
         <td>
             <a class="data-item-status-{{$product->id}}" href="{{route('admin.product.list', ['filter'=>$product->status])}}">
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
             @if($product->seller)
             <a href="{{route('admin.user.show', $product->seller)}}">{{$product->seller->name}}</a>
             @endif
         </td>
         <td>
             @if($product->author)
             <a href="{{route('admin.user.show', $product->author)}}">{{$product->author->name}}</a>
             @endif
         </td>
         <td>
            <div class="btn-group pull-right">
              <a class="btn btn-default btn-status"
                  data-action="{{$product->status=='published'?'archive':'publish'}}" 
                  data-id="{{$product->id}}" 
                  data-href="{{route('admin.product.list')}}">
                      @if($product->status=='published') 
                          @lang('app.btn.archive') 
                      @else
                        @lang('app.btn.publish') 
                      @endif
              </a>
              <a class="btn btn-danger btn-delete" 
                  data-action="delete" 
                  data-id="{{$product->id}}" 
                  data-href="{{route('admin.product.list')}}"><i class="fa fa-trash-o"></i></a>
            </div>
         </td>
     </tr>
     @endforeach
 </tbody>
</table>