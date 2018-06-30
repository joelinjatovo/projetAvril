<table class="shop_table shop_table_responsive cart table table-striped table-hover">
    <thead>
        <tr>
            <th colspan="2">Produits</th>
            
            @if(\Auth::check()&&\Auth::user()->hasRole('apl'))
            <th colspan="2">User</th>
            @endif
            
            <th>Price</th>
            <th>Reservation</th>
            
            @if($sales[0]->status == 'pinged')
            <th>Action</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($sales as $sale)
        <tr>
            <td class="product-thumbnail" width="100">
                <a href="{{route('product.index', $sale->product)}}">
                    <img width="100" height="100" src="{{$sale->product->imageUrl()}}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="" />
                </a>
            </td>
            <td class="product-name"> <a href="{{route('product.index', $sale->product)}}">{{$sale->product->title}}</a></td>
            
            @if(\Auth::check()&&\Auth::user()->hasRole('apl'))
                <td class="product-thumbnail" width="100">
                    @if($sale->author)
                    <a href="{{route(\Auth::user()->role.'.user.contact', $sale->author)}}">
                        <img width="100" height="100" src="{{$sale->author->imageUrl()}}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="" />
                    </a>
                    @endif
                </td>
                <td>
                     @if($sale->author)
                     <a href="{{route(\Auth::user()->role.'.user.contact', $sale->author)}}">{{$sale->author->email}}</a>
                     @endif
                </td>
            @endif
            
            <td class="product-price"><span>{{$sale->currency}}</span> {{$sale->price}}</td>
            <td class="product-price"><span>{{$sale->currency}}</span> {{$sale->tma}}</td>
            
            <td class="product-action">
                @if($sale->status == 'pinged')
                <form action="{{route('shop.order.last')}}" method="post" class="pull-right">
                    {{csrf_field()}}
                    <input type="hidden" name="sale" value="{{$sale->id}}">
                    <input type="hidden" name="action" value="item">
                    <button type="submit" class="btn btn-default pull-left">x</button>
                </form>
                <form action="{{route('shop.checkout')}}" method="post" class="pull-right">
                    {{csrf_field()}}
                    <input type="hidden" name="sale" value="{{$sale->id}}">
                    <input type="hidden" name="action" value="update_session">
                    <input type="submit" class="btn btn-success pull-left" value="@lang('member.pay_order')">
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@if($sale->status == 'pinged')
<form action="{{route('shop.order.last')}}" method="post">
{{csrf_field()}}
<input type="hidden" name="action" value="all">
<button type="submit" class="btn btn-default pull-right">@lang('member.cancel_orders')</button>
</form>
@endif