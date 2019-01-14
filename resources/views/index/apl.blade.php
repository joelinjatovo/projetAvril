@extends('layouts.app')

@section('content')
<div class="content corps">
    <div class="container">
        <div class="row">
            @include('includes.alerts')
            <fieldset>
                <legend>@lang('app.select_apl')</legend>
                <div class="row">
                    <div class="col-sm-12">
                        <div id="map" style="height: 400px;"></div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="title">@lang('app.apl')</h4>
      </div>
      <div class="modal-body">
        <p id="content">@lang('app.select_apl')</p>
      </div>
      <div class="modal-footer">
        <form id="apl-form-modal" class="form-horizontal" role="form" method="post" action="{{route('member.select.apl')}}">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" id="apl-modal"  name="apl">
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
<script>
    $('#apl-form-modal').submit(function(event){
        if(!$('#check-confirm-modal').is(":checked"))
        {
            $('.row-confirm-modal').removeClass('hidden');
            event.preventDefault();
        }
    });
</script>
<script>
    var _map;
    var _lat = -25.647467468105795;
    var _long = 146.89921517372136;
    
    var iconBase = "{{url('')}}";
    var icons = {
      user: {
        icon: iconBase + '/images/map/user.png'
      },
      member: {
        icon: iconBase + '/images/map/member.png'
      },
      apl: {
        icon: iconBase + '/images/map/apl.png'
      },
      afa: {
        icon: iconBase + '/images/map/afa.png'
      },
      product: {
        icon: iconBase + '/images/map/product.png'
      }
    };
    
    var datas = {!!$data!!};
    var markers = [];
    
    function initMap() {
        _map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: _lat, lng:  _long},
            zoom: 2
        });
    
        for (var i = 0; i < datas.length; i++) {
            placeMarker(datas[i], );
        }
    }
    
    function placeMarker(data) {
        markers[data.id] = new google.maps.Marker({
            position: {lat:parseFloat(data.lat), lng:parseFloat(data.lng)},
            map: _map,
            title: data.title,
            icon: icons[data.type].icon,
        });
        
        if(data.type == 'apl'){
            google.maps.event.addListener(markers[data.id], 'click', function() {
                $('#apl-modal').attr("value", data.id);
                $('#title').html(data.title);
                $('#content').html(data.html);
                $('#myModal').modal('show'); 
            });
        }
    }

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtRuDbjjrHacZ6EqZySofNueLBLkrNxwI&callback=initMap"></script>
@endsection
