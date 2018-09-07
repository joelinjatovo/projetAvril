<tr>
    <td id="search-title">
        <strong>{{$search->title}}</strong>
        <p id="success-message" style="color:green;"></p>
        <p id="error-message" style="color:red;"></p>
    </td>
    <td>{{$search->keyword}}</td>
    <td>{{$search->created_at->diffForHumans()}}</td>
    <td>
        <a class="btn btn-danger btn-delete pull-right" 
           data-search-id="{{$search->id}}">x</a>
        <a class="btn btn-default btn-edit-search pull-right" 
           data-search-id="{{$search->id}}" 
           data-search-title="{{$search->title}}" >@lang('app.btn.edit')</a>
    </td>
</tr>