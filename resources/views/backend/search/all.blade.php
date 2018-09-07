@extends('layouts.lte')

@section('content')
<div class="row">
    <div class="col-md-12">
      @component('components.box', ['button'=>true, 'class'=>'box-primary'])
          <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Mot cle</th>
                    <th>Date</th>
                    <th class="pull-right">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(count($items)>0)
                    @each('backend.table.search-tr', $items, 'search')
                @else
                    @include('backend.table.tr-empty', ['col'=>4])
                @endif
            </tbody>
          </table>
          
          @slot('footer')
              {{$items->links()}}
          @endslot
          
      @endcomponent
    </div>
</div>
@endsection

@section('script')
@parent()
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
