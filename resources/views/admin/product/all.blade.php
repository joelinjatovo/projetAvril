@extends('layouts.admin')

@section('content')
<div class="main-content container-fluid">
    <div id="page-content" class="page-content">
        <section>
            <div class="page-header">
                <h3>
                @if(isset($title))
                    {{$title}}
                @else
                    @lang('app.admin.product.list')
                @endif
                </h3>
            </div>
            <div>
                <h4>@lang('app.search.filter')</h4>
                <form method="get" action="">
                    <div class="col-md-3">
                        <input id="q" type="text" class="form-control" name="q" placeholder="@lang('app.search')" title="@lang('app.search')" value="{{$q}}">
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" name="category">
                            <option value="0">@lang('app.select_category')</option>
                            @foreach($categories as $cat)
                                <option {{$category==$cat->id?'selected':''}} value="{{$cat->id}}">{{$cat->title}} ({{$cat->products_count}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" name="state">
                            <option value="">@lang('app.select_state')</option>
                            @foreach($states as $stateItem)
                            <option value="{{$stateItem->id}}" {{$stateItem->id==$state?'selected':''}}>{{$stateItem->content}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" name="seller">
                            <option value="">@lang('app.select_seller')</option>
                            @foreach($sellers as $sellerItem)
                            <option value="{{$sellerItem->id}}" {{$sellerItem->id==$seller?'selected':''}}>{{$sellerItem->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input id="q" type="number" class="form-control" name="record" title="Nombre par page" placeholder="Nombre par page" min="10" value="{{$record}}">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success">@lang('app.btn.search')</button>
                    </div>
                </form>
            </div>
            <br>
            <br>
            <div class="row-fluid margin-bottom16">
                 <div class="span12">
                     @include('includes.alerts')
                     <div class="widget widget-simple widget-table">
                         @include('admin.table.product', ['products'=>$items])
                     </div>
                 </div>
                 {{$items->links()}}
            </div>
        </section>
    </div>
</div>
@endsection
