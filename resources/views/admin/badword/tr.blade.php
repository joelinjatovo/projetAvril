<tr class="data-item-{{$badword->id}} item">
    <td>{{$badword->content}}</td>
    <td>{{$badword->created_at->diffForHumans()}}</td>
    <td>
        <div class="btn-group pull-right">
            <a href="{{route('admin.badword.edit', $badword)}}" class="btn btn-small btn-default btn-update">@lang('app.btn.edit')</a>
            <a href="#" class="btn btn-small btn-danger btn-delete"
              data-action="delete" 
              data-id="{{$badword->id}}" 
              data-href="{{route('admin.badword.list')}}"><i class="fa fa-trash-o"></i></a>
        </div>
    </td>
</tr>