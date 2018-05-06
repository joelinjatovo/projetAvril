
 <table class="table boo-table table-striped table-hover">
     <thead>
         <tr>
             <th scope="col">ID <span class="column-sorter"></span></th>
             <th scope="col">Photo <span class="column-sorter"></span></th>
             <th scope="col">Title/Description <span class="column-sorter"></span></th>
             <th scope="col">Prix/TMA <span class="column-sorter"></span></th>
             <th scope="col">Date <span class="column-sorter"></span></th>
             <th scope="col">Statut <span class="column-sorter"></span></th>
             <th scope="col">Vendeur <span class="column-sorter"></span></th>
             <th scope="col">Auteur <span class="column-sorter"></span></th>
         </tr>
     </thead>
     <tbody>
         @foreach($products as $product)
         <tr>
             <td>{{$product->id}}</td>
             <td><a href="{{route('admin.product.show', ['product'=>$product])}}"><img class="thumb" src="{{$product->imageUrl()}}" width="50"></a></td>
             <td>
                 <a href="{{route('admin.product.show', ['product'=>$product])}}">{{$product->title}}</a><br>
                 {{$product->excerpt()}}
             </td>
             <td>{{$product->currency}} {{$product->price}} / {{$product->tma}}</td>
             <td>{{$product->created_at->diffForHumans()}}</td>
             <td>
                 <a href="{{route('admin.product.list', ['filter'=>$product->status])}}">
                 @if($product->status=='published')
                 <span class="label label-success">{{$product->status}}</span>
                 @else
                 <span class="label label-warning">{{$product->status}}</span>
                 @endif
                 </a>
             </td>
             <td>@if($product->seller)<a href="{{route('admin.user.show', $product->seller)}}">{{$product->seller->name}}</a>@endif</td>
             <td><a href="{{route('admin.user.show', $product->author)}}">{{$product->author->name}}</a></td>
         </tr>
         @endforeach
     </tbody>
 </table>