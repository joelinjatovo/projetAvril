<tr class="data-item-{{$category->id}} item">
    <td><a href="{{route('admin.category.show', $category)}}">{{$category->title}}</a></td>
    <td>{{$category->created_at->diffForHumans()}}</td>
    <td>{{count($category->products)}}</td>
    <td><a href="{{route('admin.user.show', $category->author)}}">{{$category->author->name}}</a></td>
    <td>
        <div class="btn-group pull-right">
          <a href="{{route('admin.category.edit', $category)}}" class="btn btn-small btn-default btn-update">@lang('app.btn.edit')</a>
          <a href="#" class="btn btn-small btn-danger btn-delete"
              data-action="delete" 
              data-id="{{$category->id}}" 
              data-href="{{route('admin.category.list', ['type'=>$category->type])}}"><i class="fa fa-trash-o"></i></a>
        </div>
    </td>
</tr>