@extends('layouts.lte')

@section('content')
<div class="row">
    <div class="col-md-12">
       @component('components.box', ['button'=>true, 'class'=>'box-primary'])
          @slot('header')
            <h3 class="box-title">Selectionner une agence partenaire locale près de chez vous.</h3>
            <div class="box-tools pull-right">
                 <div class="btn-group">
                  <button type="button" class="btn btn-default btn-flat">@lang('app.form.filter')</button>
                  <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    @foreach($distances as $dist)
                        <li><a href="?distance={{$dist}}">{{$dist}} km</a></li>
                    @endforeach
                  </ul>
                </div>
                <a href="{{route('shop.select.afa', ['display'=>'map'])}}" class="btn btn-default btn-flat"><i class="fa fa-map"></i></a>
                <a href="{{route('shop.select.afa', ['display'=>'list'])}}" class="btn btn-default btn-flat"><i class="fa fa-list-ul"></i></a>
            </div>
          @endslot
          
          @include('member.afa.table', ['users'=>$items])
          
       @endcomponent
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="title">@lang('app.afa')</h4>
      </div>
      <div class="modal-body">
        <p id="content">@lang('member.select_afa')</p>
      </div>
      <div class="modal-footer">
        <form id="afa-form-modal" class="form-horizontal" role="form" method="post" action="{{$action}}">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" id="afa-modal"  name="afa">
            <div class="pull-left hidden row-confirm-modal" style="margin-bottom: 20px;">
                <input id="check-confirm-modal" type="checkbox" name="confirm" value="1"><span style="color:red;"> {!!__('member.accept_term_and_condition_apl')!!}</span>
            </div>
            <div class="col-md-12">
                <button class="btn btn-default pull-right" data-dismiss="modal" aria-hidden="true">@lang('app.btn.cancel')</button>
                <button id="submit" type="submit" class="btn btn-success pull-left">@lang('member.select')</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
@parent()
<script>
    $('#afa-form-modal').submit(function(event){
        if(!$('#check-confirm-modal').is(":checked"))
        {
            $('.row-confirm-modal').removeClass('hidden');
            event.preventDefault();
        }
    });
    $('#btn-select-afa').click(function(event){
        event.preventDefault();
        var id = $(this).attr("data-id");
        var title = $(this).attr("data-title");
        var html = $(this).attr("data-html");
        $('#afa-modal').attr("value", id);
        $('#title').html(title);
        $('#content').html(html);
        $('#myModal').modal('show'); 
    });
</script>
@endsection
