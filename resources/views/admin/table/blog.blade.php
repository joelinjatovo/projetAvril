<div class="widget widget-simple widget-table">
    <table id="exampleDT" class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">ID <span class="column-sorter"></span></th>
                <th scope="col">Photo <span class="column-sorter"></span></th>
                <th scope="col">Titre <span class="column-sorter"></span></th>
                <th scope="col">Descripition <span class="column-sorter"></span></th>
                <th scope="col">Meta Tag <span class="column-sorter"></span></th>
                <th scope="col">Meta Description <span class="column-sorter"></span></th>
                <th scope="col">Statut <span class="column-sorter"></span></th>
                <th scope="col">Date de publication <span class="column-sorter"></span></th>
            </tr>
        </thead>
        <tbody>
          @foreach($blogs as $blog) 
            <tr>
                <td>{{$blog->id}}</td>
                <td>{{$blog->imageUrl(true)}}</td>
                <td>{{$blog->content}}</td>
                <td>{{$blog->title}}</td>
                <td>{{$blog->meta_tag}}</td>
                <td>{{$blog->meta_description}}</td>
                <td>{{ $blog->status }}</td>
                <td>{{$blog->created_at->diffForHumans()}}</td>
            </tr>
           @endforeach
        </tbody>
    </table>
</div>
