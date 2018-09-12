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