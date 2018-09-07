<table class="shop_table shop_table_responsive cart table table-striped table-hover">
    <thead>
        <tr>
            <th colspan="2">Produits</th>
            <th>Prix</th>
            <th>Reservation</th>
            
            @if(\Auth::check()&&\Auth::user()->hasRole('member'))
            <th>@lang('app.afa')</th>
            @endif
            
            @if(\Auth::check()&&\Auth::user()->hasRole('apl'))
            <th colspan="2">Clients</th>
            <th>Commission MIO</th>
            @endif
            
            @if(\Auth::check()&&\Auth::user()->hasRole('afa'))
            <th>Commission PC</th>
            @endif
            
            @if(\Auth::check()&&\Auth::user()->hasRole('seller'))
            <th>Commission sur vente</th>
            @endif
            
            @if($orders[0]->status == 'pinged')
            <th>Action</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td class="product-thumbnail" width="100">
                <a href="{{route('product.index', $order->product)}}">
                    <img width="100" height="100" src="{{$order->product->imageUrl()}}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="" />
                </a>
            </td>
            <td class="product-name">
                <a href="{{route('product.index', $order->product)}}">{{$order->product->title}}</a>
            </td>
            
            <td class="product-price"><span>{{$order->currency}}</span> {{$order->price}}</td>
            <td class="product-price"><span>{{$order->currency}}</span> {{$order->reservation}}</td>
            
            
            @if(\Auth::check()&&\Auth::user()->hasRole('member'))
            <td>
                @if($order->afa)
                    {{$order->afa->name}}
                @else
                    <form action="{{route('shop.checkout')}}" method="post" class="pull-right">
                        {{csrf_field()}}
                        <input type="hidden" name="order" value="{{$order->id}}">
                        <input type="hidden" name="action" value="update_session">
                        <input type="submit" value="@lang('member.select')">
                    </form>
                @endif
            </td>
            @endif
            
            @if(\Auth::check()&&\Auth::user()->hasRole('apl'))
                <td class="product-thumbnail" width="100">
                    @if($order->author)
                    <a href="{{route(\Auth::user()->role.'.user.contact', $order->author)}}">
                        <img width="100" height="100" src="{{$order->author->imageUrl()}}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="" />
                    </a>
                    @endif
                </td>
                <td>
                     @if($order->author)
                     <a href="{{route(\Auth::user()->role.'.user.contact', $order->author)}}">{{$order->author->email}}</a>
                     @endif
                </td>
                <td><span>{{$order->currency}}</span> {{$order->apl_amount}}</td>
            @endif
            
            @if(\Auth::check()&&\Auth::user()->hasRole('afa'))
                <td>
                    <span>{{$order->currency}}</span> {{$order->afa_amount}}
                    @if(!$order->isTmaPaid())
                        <div class="badge badge-danger">Commission sur vente pas encore payée par le vendeur</div>
                    @endif
                </td>
            @endif
            
            @if(\Auth::check()&&\Auth::user()->hasRole('seller'))
                <td><span>{{$order->currency}}</span> {{$order->tma}}</td>
            @endif
            
            <td class="product-action">
                @if(\Auth::check()&&\Auth::user()->hasRole('member'))
                    @if($order->status == 'pinged')
                    <form action="{{route('shop.cart')}}" method="post" class="pull-right">
                        {{csrf_field()}}
                        <input type="hidden" name="order" value="{{$order->id}}">
                        <input type="hidden" name="action" value="item">
                        <button type="submit" class="btn btn-default pull-left">x</button>
                    </form>
                    <form action="{{route('shop.checkout')}}" method="post" class="pull-right">
                        {{csrf_field()}}
                        <input type="hidden" name="order" value="{{$order->id}}">
                        <input type="hidden" name="action" value="update_session">
                        <input type="submit" class="btn btn-success pull-left" value="@lang('member.pay_order')">
                    </form>
                    @endif
                @endif
                
                @if(\Auth::check()&&\Auth::user()->hasRole('seller'))
                    @if(!$order->isConfirmed())
                    <form action="{{route('seller.order.show', $order)}}" method="post" class="pull-right">
                        {{csrf_field()}}
                        <input type="hidden" name="action" value="cancel">
                        <button type="submit" class="btn btn-default pull-left">x</button>
                    </form>
                    <form action="{{route('seller.order.show', $order)}}" method="post" class="pull-right">
                        {{csrf_field()}}
                        <input type="hidden" name="action" value="confirm">
                        <button type="submit" class="btn btn-success pull-left">@lang('app.btn.confirm')</button>
                    </form>
                    @elseif(!$order->isTmaPaid())
                    <form action="{{route('seller.order.show', $order)}}" method="post" class="pull-right">
                        {{csrf_field()}}
                        <input type="hidden" name="action" value="pay-tma">
                        <button type="submit" class="btn btn-success pull-left">@lang('seller.btn.pay-tma')</button>
                    </form>
                    @endif
                @endif
                
                @if(\Auth::check()&&\Auth::user()->hasRole('afa'))
                    @if(!$order->isAfaPaid())
                    <a href="{{route('afa.pay.cpc')}}" class="btn btn-success pull-left">@lang('afa.btn.pay-cpc')</a>
                    @endif
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{$orders->links()}}

@if($order->status == 'pinged')
<form action="{{route('shop.cart')}}" method="post">
{{csrf_field()}}
<input type="hidden" name="action" value="all">
<button type="submit" class="btn btn-default pull-right">@lang('member.cancel_orders')</button>
</form>
@endif