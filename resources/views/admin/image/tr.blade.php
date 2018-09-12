<tr>
 <td>{{$image->id}}</td>
 <td>
     <img class="thumb" src="{{$image->imageUrl()}}" width="50">
 </td>
 <td>{{$image->filename}}</td>
 <td>{{$image->filepath}}</td>
 <td>{{$image->filemime}}</td>
 <td>
    <a href="{{route('admin.image.edit', $image)}}" class="btn btn-small btn-success">@lang('app.btn.edit')</a>
    <a href="{{route('admin.image.delete', $image)}}" class="btn btn-small btn-warning btn-delete">@lang('app.btn.delete')</a>
 </td>
</tr>