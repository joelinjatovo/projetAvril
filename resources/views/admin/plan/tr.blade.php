<tr class="data-item-{{$plan->id}} item">
    <td>
    {{$plan->name}}<br>
    {{$plan->description}}</td>
    <td>{{$plan->cost}}</td>
    <td>{{$plan->type}}</td>
    <td>{{$plan->role}}</td>
    <td>{{$plan->created_at->diffForHumans()}}</td>
    <td>
        <div class="btn-group pull-right">
            <a href="{{route('admin.plan.edit', $plan)}}" class="btn btn-small btn-default btn-update">@lang('app.btn.edit')</a>
            <a href="#" class="btn btn-small btn-danger btn-delete"
              data-action="delete" 
              data-id="{{$plan->id}}" 
              data-href="{{route('admin.plan.list')}}"><i class="fa fa-trash-o"></i></a>
        </div>
    </td>
</tr>