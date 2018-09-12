
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
        @if(count($products)>0)
            @each('admin.product.tr', $products, 'product')
        @else
            @include('admin.tr-empty', ['col'=>6])
        @endif
    </tbody>
</table>