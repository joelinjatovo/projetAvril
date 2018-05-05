<div class="widget widget-simple widget-table">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">ID <span class="column-sorter"></span></th>
                <th scope="col">Titre<span class="column-sorter"></span></th>
                <th scope="col">Path<span class="column-sorter"></span></th>
                <th scope="col">Parent<span class="column-sorter"></span></th>
                <th scope="col">Ordre<span class="column-sorter"></span></th>
                <th scope="col">Auteur<span class="column-sorter"></span></th>
                <th scope="col">Date<span class="column-sorter"></span></th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
          @foreach($pages as $page) 
            <tr>
                <td>{{$page->id}}</td>
                <td>
                    <a href="{{route('admin.page.show', $page)}}">{{$page->title}}</a><br>
                    {{$page->excerpt()}}
                </td>
                <td>{{$page->path}}</td>
                <td>@if($page->parent)<a href="{{route('admin.page.show', $item->parent)}}">{{$page->parent->title}}</a>@endif</td>
                <td>{{$page->page_order}}</td>
                <td>@if($page->author)<a href="{{route('admin.user.show', $item->author)}}">{{$page->author->name}}</a>@endif</td>
                <td>{{$page->created_at->diffForHumans()}}</td>
                <td>
                    <a href="{{route('admin.page.edit', $item)}}" class="btn btn-small btn-info btn-update">Modifier</a>
                    <a href="{{route('admin.page.delete', $item)}}" class="btn btn-small btn-warning btn-delete">Supprimer</a>
                </td>
            </tr>
           @endforeach
        </tbody>
    </table>
</div>