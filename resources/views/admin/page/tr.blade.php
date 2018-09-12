<tr class="data-item-{{$page->id}} item">
    <td>
        <a href="{{route('admin.page.show', $page)}}">{{$page->title}}</a><br>
        {{$page->excerpt('fr', 20)}}
    </td>
    <td>
        <a href="{{route('admin.page.show', $page)}}">{{$page->title_en}}</a><br>
        {{$page->excerpt('en', 20)}}
    </td>
    <td>@if($page->parent)<a href="{{route('admin.page.show', $page->parent)}}">{{$page->parent->title}}</a>@endif</td>
    <td>{{$page->page_order}}</td>
    <td>@if($page->author)<a href="{{route('admin.user.show', $page->author)}}">{{$page->author->name}}</a>@endif</td>
    <td>{{$page->created_at->diffForHumans()}}</td>
    <td>
        <div class="btn-group pull-right">
            <a href="{{route('admin.page.edit', $page)}}" class="btn btn-small btn-default btn-update">@lang('app.btn.edit')</a>
            <a href="#" class="btn btn-small btn-danger btn-delete"
              data-action="delete" 
              data-id="{{$page->id}}" 
              data-href="{{route('admin.page.list', ['type'=>$page->type])}}"><i class="fa fa-trash-o"></i></a>
        </div>
    </td>
</tr>
