<tr>
    <td class="product-thumbnail" width="100">
        <img width="100" height="100" src="{{$user->imageUrl()}}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="" />
    </td>
    <td>
        {{$user->name}}<br>
        {{$user->email}}
    </td>
    <td>
        {{$user->apl_ends_at?ucfirst($user->apl_ends_at->diffForHumans()):''}}
    </td>
    <td class="product-action">
        <a class="btn btn-default pull-right"  href="{{route(\Auth::user()->role.'.user.contact', $user)}}">@lang('apl.contact_customer')</a>
    </td>
</tr>
