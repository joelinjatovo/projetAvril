<div class="widget widget-simple widget-table">
    <table class="table table-striped table-hover">
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
          @foreach($searches as $search) 
            <tr>
                <td>{{$search->id}}</td>
                <td>
                    <a href="{{route('admin.search.show', $search)}}">{{$search->title}}</a>
                </td>
                <td>{{$search->keyword}}</td>
                <td>@if($search->author)<a href="{{route('admin.user.show', $search->author)}}">{{$search->author->name}}</a>@endif</td>
                <td>{{$search->saved_at?$search->saved_at->diffForHumans():""}}</td>
                <td>{{$search->created_at?$search->created_at->diffForHumans():""}}</td>
                <td class="pull-right">
                    <a href="{{route('admin.search.delete', $search)}}" class="btn btn-small btn-warning btn-delete">@lang('app.btn.delete')</a>
                </td>
            </tr>
           @endforeach
        </tbody>
    </table>
</div>