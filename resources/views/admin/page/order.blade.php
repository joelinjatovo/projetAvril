@extends('layouts.lte')

@section('content')
<div class="row">
    <div class="col-md-8">
        <ul class="page-list">
            @foreach($items as $item)
            <li class="" style="" data-id="{{$item->id}}">
              <div>
                  <!-- drag handle -->
                  <span class="handle ui-sortable-handle">
                    <i class="fa fa-ellipsis-v"></i>
                    <i class="fa fa-ellipsis-v"></i>
                  </span>
                  <!-- todo text -->
                  <span class="text">{{$item->title}}</span>
              </div>
              <ul class="order-page ui-sortable" data-id="{{$item->id}}">
                  @foreach($item->childs as $item1)
                    <li class="" style="padding-left: 10px;" data-id="{{$item1->id}}">
                      <div>
                          <!-- drag handle -->
                          <span class="handle ui-sortable-handle">
                            <i class="fa fa-ellipsis-v"></i>
                            <i class="fa fa-ellipsis-v"></i>
                          </span>
                          <!-- todo text -->
                          <span class="text">{{$item1->title}}</span>
                      </div>
                    </li>
                  @endforeach
              </ul>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection

@section('script')
@parent
<script>
  $(function () {
    //Initialize sortable Elements
    $('.order-page').sortable({
        placeholder: "ui-state-highlight",
        update: function( event, ui ) {
            var articleorder="";
            var parent_id = $(this).attr('data-id');
            $(this).find("li").each(function(i) {
                if (articleorder=='')
                    articleorder = $(this).attr('data-id');
                else
                    articleorder += "," + $(this).attr('data-id');
            });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('admin.page.order')}}',
                type: 'POST',
                dataType: 'json',
                data: {parent_id: parent_id, order: articleorder},
                beforeSend: function( xhr ) {
                    $('#mute').addClass('on');
                }
            }).done(function(data){
                console.log(data);
                $('#mute').removeClass('on');
            }).fail(function() {
                $('#mute').removeClass('on');
            }); 
        }
    })
  })
</script>
@endsection

