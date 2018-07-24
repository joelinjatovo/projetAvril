<table class="shop_table shop_table_responsive cart table table-striped table-hover">
    <thead>
        <tr>
            <th colspan="2">@lang('app.afa')</th>
            <th class="pull-right">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td class="product-thumbnail" width="100">
                <img width="100" height="100" src="{{$user->imageUrl()}}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="" />
            </td>
            <td>{{$user->name()}}</td>
            <td class="product-action">
                <a id="btn-select-afa" class="btn btn-default pull-right" href="#" data-id="{{$user->id}}" data-title="{{$user->name}}" data-html="{{$user->meta('orga_description')}}">@lang('member.select')</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
