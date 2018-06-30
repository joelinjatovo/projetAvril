@extends('layouts.app')

@section('content')
@include('includes.slider')
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-7">
            <header class="section-header text-center">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="pull-left">
                            @if(isset($q)&&$q)
                                @lang('app.search_result', ['q'=>$q])
                                <a class="btn btn-default btn-save-search" 
                                       data-search-id="{{$search->id}}" 
                                       data-search-title="{{$search->title}}" >@lang('app.btn.save')</a>
                            @else
                                @if($category&&$category->id>0) 
                                    {{$category->title}} 
                                @else 
                                    @lang('app.all_product') 
                                @endif
                            @endif
                        </h3>
                        <br><p id="success-message" style="color:green;"></p>
                        <br><p id="error-message" style="color:red;"></p>
                    </div>
                </div>
            </header>

            <!-- breadcrumb     -->
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">@lang('app.home')</a></li>
                        @if(isset($q)&&$q)
                        <li class="breadcrumb-item"><a href="{{route('shop.index')}}">@lang('app.all_product')</a></li>
                        <li class="breadcrumb-item active">@lang('app.search_result', ['q'=>$q])</li>
                        @else
                          @if($category&&$category->id>0)
                            <li class="breadcrumb-item"><a href="{{route('shop.index')}}">@lang('app.all_product')</a></li>
                            <li class="breadcrumb-item active">{{$category->title}}</li>
                          @else
                            <li class="breadcrumb-item active">@lang('app.all_product')</li>
                          @endif
                      @endif
                    </ol>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="property-sorting">        
                        <form id="filter-form" method="get" action="">
                            <div  class="pull-left">
                                <label for="orderBy"> @lang('app.form.filterBy'):   </label>  
                                <select name="orderBy" id="orderBy" onchange="document.getElementById('filter-form').submit();"> 
                                    <option value="price" {{$orderBy=='price'?'selected':''}}>@lang('app.price')</option> 
                                    <option value="created_at" {{$orderBy=='created_at'?'selected':''}}>@lang('app.pub_date')</option>  
                                    <option value="view_count" {{$orderBy=='view_count'?'selected':''}}>@lang('app.most_view')</option>
                                </select>
                            </div>
                            <div  class="pull-left">
                                <label for="order"> @lang('app.form.order'):   </label>  
                                <select name="order" id="order" onchange="document.getElementById('filter-form').submit();"> 
                                    <option value="asc" {{$order=='asc'?'selected':''}}>@lang('app.form.asc')</option> 
                                    <option value="desc" {{$order=='desc'?'selected':''}}>@lang('app.form.desc')</option> 
                                </select>
                            </div>
                            <div  class="pull-right">
                                <p class="layout-view"> Vue:<i class="fa fa-th-large selected" data-layout="6"></i> <i class="fa fa-list-ul" data-layout="12"></i> </p> 
                            </div>
                        </form>
                    </div>           
                </div>
            </div>

            <div id="infinite-scroll" class="product-data"> 
                @include('ajax.product.all',['items'=>$items])
            </div>
            <div class="row">
                <div class="ajax-load text-center" style="display:none">
                    <p><img src="{{asset('images/loader.gif')}}">@lang('app.load_more_product')</p>
                </div>  
            </div>
        </div>
        <div class="col-lg-4 col-md-5">
            @include('includes.sidebar')
        </div>
    </div>
</div>


@if(isset($q)&&$q)
<!-- Modal -->
<div id="modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="title">Enregister la recherche</h4>
      </div>
      <div class="modal-body">
          <form id="form-save-search" action="{{route('search.edit')}}" method="post">
            {{csrf_field()}}
            <input type="hidden" id="input-search-id" name="search" value="{{$search->id}}">
            <p class="form-subject">
                <input id="input-search-title" name="title" type="text" placeholder="Titre *" required="required" value="{{$search->title}}">
            </p>
                <a class="btn btn-default" data-dismiss="modal" aria-hidden="true">@lang('app.btn.cancel')</a>
                <button class="btn btn-success" type="submit">@lang('app.btn.save')</button>
          </form>
      </div>
    </div>
  </div>
</div>
@endif

@endsection

@section('script')
    @parent
    <script type="text/javascript">
    $(document).ready(function () {
        var page = {{$page}};
        var norecord = false;
        var load = false;
        $(window).scroll(function() {
            if($(window).scrollTop() + $(window).height() >= 
               $('#infinite-scroll').height()) {
                if(!load){
                    if(!norecord){
                        page++;
                        loadMoreData(page);
                    }else{
                        $('.ajax-load').show();
                    }
                }
            }
        });
        function loadMoreData(page){
            $.ajax({
                url: "{!!route("shop.index", ["category"=>$category, "q"=>$q, "order"=>$order, "orderBy"=>$orderBy])!!}&page="+page,
                type: "get",
                beforeSend: function()
                {
                    load = true;
                    $('.ajax-load').show();
                }
            }).done(function(data)
            {
                if(data.html == ""){
                    norecord = true;
                    $('.ajax-load').html("@lang('app.no_more_data')");
                    return;
                }
                $('.ajax-load').hide();
                $(".product-data").append(data.html);
                load = false;
            }).fail(function(jqXHR, ajaxOptions, thrownError)
            {
                page--;
                $('.ajax-load').html("Server not responding....");
                load = false;
            });
        }
    });
    </script>

    @if(isset($q)&&$q)
        <script>
        $(document).ready(function () {
            $('.btn-save-search').on('click', function(e){
                $('#modal').modal('show');
                e.preventDefault();
            });

            $('#form-save-search').on('submit', function(e){
                $('#mute').addClass('on');
                $('#modal').modal('hide');
                var data = {
                    _token: $('meta[name=csrf-token]').attr('content'),
                    search: $('#input-search-id').val(),
                    title: $('#input-search-title').val(),
                };
                
                $('#success-message').html('');
                $('#error-message').html('');
                $.post('{{route("search.edit")}}', data, function(res){
                    if(res.state == 1){
                        $('#success-message').html(res.message);
                    }else{
                        $('#error-message').html(res.message);
                    }
                    $('#mute').removeClass('on');
                });
                e.preventDefault();
            });
        });
        </script>
    @endif
@endsection


