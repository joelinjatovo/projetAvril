<div class="widget widget-simple widget-table">
    <table id="exampleDT" class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">ID <span class="column-sorter"></span></th>
                <th scope="col">Image<span class="column-sorter"></span></th>
                <th scope="col">Titre<span class="column-sorter"></span></th>
                <th scope="col">Description<span class="column-sorter"></span></th>
                <th scope="col">Liens<span class="column-sorter"></span></th>
                <th scope="col">Pages<span class="column-sorter"></span></th>
                <th scope="col">Date de publication <span class="column-sorter"></span></th>
                <th scope="col">Auteur <span class="column-sorter"></span></th>
                <th scope="col">Actions </th>
            </tr>
        </thead>
        <tbody>
          @foreach($pubs as $pub) 
            <tr>
                <td>{{$pub->id}}</td>
                 <td>
                     <a href="{{route('admin.pub.show', $pub)}}"><img class="thumb" src="{{$pub->imageUrl()}}" width="50"></a>
                 </td>
                <td>{{$pub->title}}</td>
                <td>{{$pub->content}}</td>
                <td>{{$pub->links}}</td>
                <td>{{count($pub->pages)}}</td>
                <td>{{$pub->created_at->diffForHumans()}}</td>
                <td><a href="{{route('admin.user.show', $item->author)}}">{{$pub->author->name}}</a></td>
                <td>
                    <a href="{{route('admin.pub.edit', $item)}}" class="btn btn-small btn-info btn-update">Modifier</a>
                    <a href="{{route('admin.pub.delete', $item)}}" class="btn btn-small btn-warning btn-delete">Supprimer</a>
                </td>
            </tr>
           @endforeach
        </tbody>
    </table>
</div>
