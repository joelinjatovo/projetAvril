<table class="table table-striped table-hover items-list">
<thead>
    <tr>
         <th scope="col">@lang('app.table.products') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.reservation')<span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.tma')<span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.cpc')<span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.mio')<span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.date') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.status') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.apl') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.afa') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.customer') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.actions') <span class="column-sorter"></span></th>
    </tr>
</thead>
<tbody>
    @if(count($orders)>0)
        @each('admin.order.tr', $orders, 'order')
    @else
        @include('admin.tr-empty', ['col'=>11])
    @endif
</tbody>
</table>
