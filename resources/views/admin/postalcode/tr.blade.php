<tr class="data-item-{{$postalcode->id}} item">
    <td>{{$postalcode->content}}</td>
    <td>{{$postalcode->created_at->diffForHumans()}}</td>
    <td>
        <div class="btn-group pull-right">
            <a href="{{route('admin.postalcode.edit', $postalcode)}}" class="btn btn-small btn-default btn-update">@lang('app.btn.edit')</a>
            <a href="#" class="btn btn-small btn-danger btn-delete"
              data-action="delete" 
              data-id="{{$postalcode->id}}" 
              data-href="{{route('admin.postalcode.list')}}"><i class="fa fa-trash-o"></i></a>
        </div>
    </td>
</tr>