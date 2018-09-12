<tr class="data-item-{{$state->id}} item">
    <td>{{$state->content}}</td>
    <td>{{$state->created_at->diffForHumans()}}</td>
    <td>
    <div class="btn-group pull-right">
        <a href="{{route('admin.state.edit', $state)}}" class="btn btn-small btn-default btn-update">@lang('app.btn.edit')</a>
        <a href="#" class="btn btn-small btn-danger btn-delete"
          data-action="delete" 
          data-id="{{$state->id}}" 
          data-href="{{route('admin.state.list')}}"><i class="fa fa-trash-o"></i></a>
    </div>
    </td>
</tr>