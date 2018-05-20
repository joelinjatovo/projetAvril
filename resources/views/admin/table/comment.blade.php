<div class="widget widget-simple widget-table">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">ID <span class="column-sorter"></span></th>
                <th scope="col">Commentaire <span class="column-sorter"></span></th>
                <th scope="col">Statut <span class="column-sorter"></span></th>
                <th scope="col">Auteur <span class="column-sorter"></span></th>
                <th scope="col">Reponses <span class="column-sorter"></span></th>
                <th scope="col">Date de publication <span class="column-sorter"></span></th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
          @foreach($comments as $comment) 
            <tr>
                <td>{{$comment->id}}</td>
                <td>{{$comment->content}}</td>
                <td><a href="#">{{$comment->status}}</a></td>
                <td>{{$comment->user?$comment->user->name:''}}</td>
                <td>{{$comment->replies_count}}</td>
                <td>{{$comment->created_at->diffForHumans()}}</td>
                <td>
                    <a href="{{route('admin.comment.show', $comment)}}" class="btn btn-small btn-default btn-delete">@lang('app.btn.view')</a>
                 @if($comment->status=='pinged' || $comment->blog=='archived')
                    <a href="{{route('admin.comment.publish', $comment)}}" class="btn btn-small btn-success btn-publish">@lang('app.btn.publish')</a>
                    <a href="{{route('admin.comment.trash', $comment)}}" class="btn btn-small btn-info btn-trash">@lang('app.btn.trash')</a>
                 @elseif($comment->status=='trashed')
                    <a href="{{route('admin.comment.restore', $comment)}}" class="btn btn-small btn-info btn-restore">Restore</a>
                 @endif
                 @if($comment->status=='published')
                    <a href="{{route('admin.comment.archive', $comment)}}" class="btn btn-small btn-default  btn-archive">@lang('app.btn.archive')</a>
                    <a href="{{route('admin.comment.trash', $comment)}}" class="btn btn-small btn-info btn-trash">@lang('app.btn.trash')</a>
                 @endif
                    <a href="{{route('admin.comment.delete', $comment)}}" class="btn btn-small btn-warning btn-delete">@lang('app.btn.delete')</a>
                </td>
            </tr>
           @endforeach
        </tbody>
    </table>
</div>
