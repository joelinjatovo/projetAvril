<table class="table boo-table table-striped table-hover">
 <thead>
     <tr>
         <th scope="col">@lang('app.table.id') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.photo') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.name') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.path') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.filemime') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.actions') </th>
     </tr>
 </thead>
 <tbody>
     @foreach($images as $image)
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
     @endforeach
 </tbody>
</table>