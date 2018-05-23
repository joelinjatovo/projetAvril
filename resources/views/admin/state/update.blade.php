@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    @include('includes.notification')
    <div class="row-fluid page-head">
        <h2 class="page-title">
            @if($item->id>0)
                @lang('app.admin.badword.update') 
            @else 
                @lang('app.admin.badword.add')
            @endif
        </h2>
    </div>
    <div id="page-content" class="page-content">
        <form method="post" action="{{$action}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <section>
                <div class="well well-nice">
                    <h4 class="simple-header">@lang('app.admin.content')</h4>
                    <div class="control-group">
                        <textarea id="wysiBooEditor" class="input-block-level" style="height: 160px" name="content" placeholder="@lang('app.admin.content.desc')">{{$item->content}}</textarea>
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
