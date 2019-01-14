@extends('layouts.lte')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{$item->title}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <p class="text-muted">{!!$item->content!!}</p>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{$item->title_en}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <p class="text-muted">{!!$item->content_en!!}</p>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
<div class="row" style="margin-top: 10px;">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#childs" data-toggle="tab">@lang('app.childs')</a></li>
          <li><a href="#order" data-toggle="tab">@lang('app.admin.page.order')</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="childs">
              <table class="table table-striped table-hover items-list">
                <thead>
                    <tr>
                        <th scope="col">Titre/Contenu (FR)<span class="column-sorter"></span></th>
                        <th scope="col">Titre/Contenu (EN)<span class="column-sorter"></span></th>
                        <th scope="col">Parent<span class="column-sorter"></span></th>
                        <th scope="col">Ordre<span class="column-sorter"></span></th>
                        <th scope="col">Auteur<span class="column-sorter"></span></th>
                        <th scope="col">Date<span class="column-sorter"></span></th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($item->childs)>0)
                        @each('admin.page.tr', $item->childs, 'page')
                    @else
                        @include('admin.tr-empty', ['col'=>7])
                    @endif
                </tbody>
              </table>
          </div>
          <!-- /.tab-pane -->
          
          <div class="tab-pane" id="order">
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
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
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



