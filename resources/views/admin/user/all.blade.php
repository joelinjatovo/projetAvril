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
                        @lang('app.admin.user.list')
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
                        <select class="form-control" name="role">
                            <option value="">@lang('app.select_role')</option>
                            <option value="admin" {{$role=='admin'?'selected':''}}>@lang('app.admin')</option>
                            <option value="apl" {{$role=='apl'?'selected':''}}>@lang('app.apl')</option>
                            <option value="afa" {{$role=='afa'?'selected':''}}>@lang('app.afa')</option>
                            <option value="member" {{$role=='member'?'selected':''}}>@lang('app.member')</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" name="country">
                            <option value="">@lang('app.select_country')</option>
                            @foreach($countries as $c)
                            <option value="{{$c->id}}" {{$c->id==$country?'selected':''}}>{{$c->content}}</option>
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
                        @include('admin.table.user', ['users'=>$items])
                     </div>
                 </div>
                 {{$items->links()}}
             </div>
        </section>
    </div>
</div>
@endsection

