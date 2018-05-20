<div class="widget widget-simple widget-table">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">ID <span class="column-sorter"></span></th>
                <th scope="col">Photo <span class="column-sorter"></span></th>
                <th scope="col">Titre <span class="column-sorter"></span></th>
                <th scope="col">Descripition <span class="column-sorter"></span></th>
                <th scope="col">Commentaires <span class="column-sorter"></span></th>
                <th scope="col">Meta Tag <span class="column-sorter"></span></th>
                <th scope="col">Meta Description <span class="column-sorter"></span></th>
                <th scope="col">Statut <span class="column-sorter"></span></th>
                <th scope="col">Date de publication <span class="column-sorter"></span></th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
          @foreach($blogs as $blog) 
            <tr>
                <td>{{$blog->id}}</td>
                <td><a href="{{route('blog.index', $blog)}}">{{$blog->imageUrl(true)}}</a></td>
                <td>{{$blog->title}}</td>
                <td>{{$blog->excerpt()}}</td>
                <td><a href="{{route('admin.comment.list', $blog)}}">{{$blog->comments_count}}</a></td>
                <td>{{$blog->meta_tag}}</td>
                <td>{{$blog->meta_description}}</td>
                <td>{{$blog->status}}</td>
                <td>{{$blog->created_at->diffForHumans()}}</td>
                <td>
                    <a href="{{route('admin.blog.edit', $blog)}}" class="btn btn-small btn-default btn-delete">@lang('app.btn.edit')</a>
                 @if($blog->status=='pinged' || $blog->status=='archived')
                    <a href="{{route('admin.blog.publish', $blog)}}" class="btn btn-small btn-success btn-publish">@lang('app.btn.publish')</a>
                    <a href="{{route('admin.blog.trash', $blog)}}" class="btn btn-small btn-info btn-trash">@lang('app.btn.trash')</a>
                 @elseif($blog->status=='trashed')
                    <a href="{{route('admin.blog.restore', $blog)}}" class="btn btn-small btn-info btn-restore">Restore</a>
                 @endif
                 @if($blog->status=='published')
                    <a href="{{route('admin.blog.archive', $blog)}}" class="btn btn-small btn-default  btn-archive">@lang('app.btn.archive')</a>
                    <a href="{{route('admin.blog.trash', $blog)}}" class="btn btn-small btn-info btn-trash">@lang('app.btn.trash')</a>
                 @endif
                    <a href="{{route('admin.blog.delete', $blog)}}" class="btn btn-small btn-warning btn-delete">@lang('app.btn.delete')</a>
                </td>
            </tr>
           @endforeach
        </tbody>
    </table>
</div>
