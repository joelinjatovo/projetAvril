@extends('layouts.admin')

@section('content')
<div class="main-content container-fluid">
    <div id="page-content" class="page-content">
        <section>
            <div class="page-header">
                <h3>{{$title}}</h3>
            </div>
            <div>
                <h4>@lang('app.search.filter')</h4>
                <form method="get" action="">
                    <div class="col-md-3">
                        <input id="q" type="text" class="form-control" name="q" placeholder="@lang('app.search')" title="@lang('app.search')" value="{{$q}}">
                    </div>
                    <div class="col-md-3">
                        <input id="number" type="number" class="form-control" name="record" title="Nombre par page" placeholder="Nombre par page" min="10" value="{{$record}}">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success">@lang('app.btn.search')</button>
                    </div>
                </form>
            </div>
            <br>
            <br>
            <div class="row-fluid">
                 <div class="span12">
                     @include('includes.alerts')
                     <div class="widget widget-simple widget-table">
                         @include('admin.table.blog', ['blogs'=>$items])
                     </div>
                 </div>
                 {{$items->links()}}
            </div>
        </section>
    </div>
</div>
@endsection
