<div class="widget widget-simple widget-table">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">@lang('app.table.photo') <span class="column-sorter"></span></th>
                <th scope="col">@lang('app.table.title')/@lang('app.table.content') <span class="column-sorter"></span></th>
                <th scope="col">@lang('app.table.comment') <span class="column-sorter"></span></th>
                <th scope="col">@lang('app.table.meta_tag') <span class="column-sorter"></span></th>
                <th scope="col">@lang('app.table.meta_desc') <span class="column-sorter"></span></th>
                <th scope="col">@lang('app.table.status') <span class="column-sorter"></span></th>
                <th scope="col">@lang('app.table.date') <span class="column-sorter"></span></th>
                <th scope="col">@lang('app.table.actions')</th>
            </tr>
        </thead>
        <tbody>
          @foreach($blogs as $blog) 
            <tr>
                <td>
                    <a href="{{route('blog.index', ['blog'=>$blog])}}"><img class="thumb" src="{{$blog->imageUrl(true)}}" width="50"></a>
                <td>
                    <a href="{{route('blog.index', ['blog'=>$blog])}}">{{$blog->title}}</a><br>
                     {{$blog->excerpt()}}
                </td>
                <td><a href="{{route('admin.comment.list', $blog)}}">{{$blog->comments_count}}</a></td>
                <td>{{$blog->meta_tag}}</td>
                <td>{{$blog->meta_description}}</td>
                <td>
                     <a href="{{route('admin.blog.list', ['filter'=>$blog->status])}}">
                         @if($blog->status=='published')
                         <span class="label label-success">{{$blog->status}}</span>
                         @else
                         <span class="label label-warning">{{$blog->status}}</span>
                         @endif
                     </a>
                </td>
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
