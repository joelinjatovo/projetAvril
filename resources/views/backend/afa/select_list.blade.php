    @extends('layouts.backend')

@section('subcontent')
<div class="row">
    <header class="section-header">
        <div class="row">
            <div class="col-md-12">
                <h3 class="pull-left">@lang('member.select_afa')</h3>
                <div class="pull-right">
                    <div class="property-sorting pull-left">
                        <label for="distance"> @lang('app.form.filterBy') : </label>
                        <select name="distance" id="distance" onchange="document.getElementById('filter-form').submit();"> 
                            @foreach($distances as $dist)
                            <option value="{{$dist}}" {{$distance===$dist?'selected':''}}>{{$dist}}</option> 
                            @endforeach
                        </select>
                    </div>
                    <p class="pull-left display-view"> Affichage: 
                        <a href="{{route('shop.select.afa', ['display'=>'map'])}}"><i class="fa fa-map"></i></a>
                        <a href="{{route('shop.select.afa', ['display'=>'list'])}}"><i class="fa fa-list-ul"></i></a>
                    </p>
                </div>
            </div>
        </div>
    </header>
    <section class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-md-12">
                    @include('backend.table.afa', ['users'=>$items])
                </div>
            </div>
        </div>
    </section>
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
@parent
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
