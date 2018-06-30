<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Mot cle</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($searches as $search)
        <tr>
            <td id="search-title">
                <strong>{{$search->title}}</strong>
                <p id="success-message" style="color:green;"></p>
                <p id="error-message" style="color:red;"></p>
            </td>
            <td>{{$search->keyword}}</td>
            <td>{{$search->created_at->diffForHumans()}}</td>
            <td><a class="btn btn-default btn-edit-search" 
                   data-search-id="{{$search->id}}" 
                   data-search-title="{{$search->title}}" >@lang('app.btn.edit')</a>
                <a class="btn btn-danger btn-delete" 
                   data-search-id="{{$search->id}}">@lang('app.btn.delete')</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

{{$searches->links()}}

<!-- Modal -->
<div id="modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="title">Modification de la recherche</h4>
      </div>
      <div class="modal-body">
          <form id="form-edit-search" action="" method="post">
            {{csrf_field()}}
            <input type="hidden" id="input-search-id" name="search" value="0">
            <p class="form-subject">
                <input id="input-search-title" name="title" type="text" placeholder="Titre *" aria-required="true" required="required" value="">
            </p>
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">@lang('app.btn.cancel')</button>
                <button class="btn btn-success" type="submit">@lang('app.btn.save')</button>
          </form>
      </div>
    </div>
  </div>
</div>

@section('script')
    @parent
<script>
$(document).ready(function () {
    var btn_clicked;
    $('.btn-delete').on('click', function(e){
        var $this = $(this);
        $('#mute').addClass('on');
        var id = $(this).attr('data-search-id');
        var data = {
            _token: $('meta[name=csrf-token]').attr('content'),
            search: id,
        };
        var $parent = $this.parent().parent().find('#search-title');
        $.post('{{route("search.delete")}}', data, function(res){
            if(res.state == 1){
                $this.parent().parent().remove();
            }else{
                $parent.find('#error-message').html(res.message);
            }
            $('#mute').removeClass('on');
        });
        e.preventDefault();
    });
    
    $('.btn-edit-search').on('click', function(e){
        btn_clicked = $(this);
        var id = $(this).attr('data-search-id');
        var title = $(this).attr('data-search-title');
        $('#input-search-id').attr('value', id);
        $('#input-search-title').attr('value', title);
        $('#modal').modal('show');
        e.preventDefault();
    });
    
    $('#form-edit-search').on('submit', function(e){
        $('#mute').addClass('on');
        $('#modal').modal('hide');
        
        var $parent = btn_clicked.parent().parent().find('#search-title');
        var data = {
            _token: $('meta[name=csrf-token]').attr('content'),
            search: $('#input-search-id').val(),
            title: $('#input-search-title').val(),
        };
        $parent.find('#success-message').html('');
        $parent.find('#error-message').html('');
        $.post('{{route("search.edit")}}', data, function(res){
            if(res.state == 1){
                $parent.find('strong').html(data.title);
                $parent.find('#success-message').html(res.message);
            }else{
                $parent.find('#error-message').html(res.message);
            }
            $('#mute').removeClass('on');
        });
        e.preventDefault();
    });
});
</script>
@endsection