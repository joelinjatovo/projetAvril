@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    @include('includes.notification')
    <div class="row-fluid page-head">
        <h2 class="page-title">{{$title}}</h2>
    </div>
    <div id="page-content" class="page-content">
        <form method="post" action="{{$action}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <section>
                <div class="well well-nice">
                    <h4 class="simple-header">@lang('app.admin.name')</h4>
                    <div class="control-group">
                        <input class="input-block-level" value="{{$item->name}}" name="name" placeholder="@lang('app.admin.name.desc')" type="text">
                    </div>
                </div>
                <div class="well well-nice">
                    <h4 class="simple-header">@lang('app.admin.price')</h4>
                    <div class="control-group">
                        <input class="input-block-level" value="{{$item->cost}}" name="cost" placeholder="@lang('app.admin.price.desc')" type="number">
                    </div>
                </div>
                <div class="well well-nice">
                    <h4 class="simple-header">@lang('app.admin.description')</h4>
                    <div class="control-group">
                        <textarea id="wysiBooEditor" class="input-block-level" style="height: 160px" name="description" placeholder="@lang('app.admin.description.desc')">{{$item->description}}</textarea>
                    </div>
                </div>
                <div class="well well-nice">
                    <h4 class="simple-header">@lang('app.admin.role')</h4>
                    <div class="control-group">
                        <select id="role" name="role" class="selecttwo input-block-level">
                            <option value="0">@lang('app.select_role')</option>
                            <option {{$item->role=='admin'?'selected':''}} value="admin">Admin</option>
                            <option {{$item->role=='apl'?'selected':''}} value="apl">APL</option>
                            <option {{$item->role=='afa'?'selected':''}} value="afa">AFA</option>
                            <option {{$item->role=='member'?'selected':''}} value="member">Member</option>
                            <option {{$item->role=='seller'?'selected':''}} value="seller">Seller</option>
                        </select>
                    </div>
                </div>
                <div class="well well-nice">
                    <h4 class="simple-header">@lang('app.admin.frequency')</h4>
                    <div class="control-group">
                        <select id="type" name="type" class="selecttwo input-block-level">
                            <option value="0">@lang('app.select_frequency')</option>
                            <option value="daily" {{$item->type=='daily'?'selected':''}}>@lang('app.frequency.daily')</option>
                            <option value="bimonthly" {{$item->type=='bimonthly'?'selected':''}}>@lang('app.frequency.bimonthly')</option>
                            <option value="monthly" {{$item->type=='monthly'?'selected':''}}>@lang('app.frequency.monthly')</option>
                            <option value="yearly" {{$item->type=='yearly'?'selected':''}}>@lang('app.frequency.yearly')</option>
                        </select>
                    </div>
                </div>
                <div class="form-actions no-margin-bootom">
                    <button type="submit" class="btn btn-green">@lang('app.btn.save')</button>
                    <button class="btn cancel" type="reset">@lang('app.btn.reset')</button>
                    <a href="javascript:history.back()" class="btn btn-green pull-right" type="submit">@lang('app.btn.back')</a>
                </div> 
            </section>
        </form>
    </div>
</div>
@endsection
