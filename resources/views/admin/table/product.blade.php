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
     <tr class="item">
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
             <a href="{{route('admin.product.list', ['filter'=>$product->status])}}">
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
            <form class="pull-right" action="{{route('admin.product.list')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="product" value="{{$product->id}}">
                <div class="btn-group">
                 @if($product->status=='pinged' || $product->status=='archived')
                  <button type="button" class="btn btn-default btn-publish">@lang('app.btn.publish')</button>
                  <button type="button" class="btn btn-default btn-trash">@lang('app.btn.trash')</button>
                 @elseif($product->status=='trashed')
                  <button type="button" class="btn btn-default btn-restore">@lang('app.btn.restore')</button>
                  <button type="button" class="btn btn-danger btn-delete"><i class="fa fa-trash-o"></i></button>
                 @endif
                 @if($product->status=='published')
                  <button type="button" class="btn btn-default btn-archive">@lang('app.btn.archive')</button>
                  <button type="button" class="btn btn-warning btn-delete"><i class="fa fa-trash-o"></i></button>
                 @endif
                </div>
             </form>
         </td>
     </tr>
     @endforeach
 </tbody>
</table>