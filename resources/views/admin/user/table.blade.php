<table class="table table-striped table-hover items-list">
    <thead>
        <tr>
             <th scope="col">@lang('app.table.users') <span class="column-sorter"></span></th>
             <th scope="col">@lang('app.table.date') <span class="column-sorter"></span></th>
             <th scope="col">@lang('app.table.role') <span class="column-sorter"></span></th>
             <th scope="col">@lang('app.table.type') <span class="column-sorter"></span></th>
             <th scope="col">@lang('app.table.status') <span class="column-sorter"></span></th>
             <th scope="col" class="pull-right">@lang('app.table.actions') <span class="column-sorter"></span></th>
        </tr>
    </thead>
    <tbody>
        @if(count($users)>0)
            @each('admin.user.tr', $users, 'user')
        @else
            @include('admin.tr-empty', ['col'=>6])
        @endif
    </tbody>
</table>