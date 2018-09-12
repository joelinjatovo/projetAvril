<table class="table table-striped table-hover items-list">
    <thead>
        <tr>
            <th scope="col">ID <span class="column-sorter"></span></th>
            <th scope="col">Titre<span class="column-sorter"></span></th>
            <th scope="col">Keyword<span class="column-sorter"></span></th>
            <th scope="col">Auteur<span class="column-sorter"></span></th>
            <th scope="col">Date d'enregistrement<span class="column-sorter"></span></th>
            <th scope="col">Date de recherche<span class="column-sorter"></span></th>
            <th scope="col"  class="pull-right">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if(count($items)>0)
            @each('admin.search.tr', $searches, 'search')
        @else
            @include('admin.tr-empty', ['col'=>7])
        @endif
    </tbody>
</table>