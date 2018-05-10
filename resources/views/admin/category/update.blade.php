@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    @include('includes.notification')
    <div class="row-fluid page-head">
        <h2 class="page-title"><i class="aweso-icon-list-alt"></i> @lang('app.admin.category.gestion') <small>@if($item->id>0) @lang('app.admin.category.update') @else @lang('app.admin.category.add') @endif</small></h2>
        <div class="page-bar">
            <div class="btn-toolbar"> </div>
        </div>
    </div>
    <!-- // page head -->
    <div id="page-content" class="page-content">
        <form method="post" action="{{$action}}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <section>
                <div class="well well-nice">
                    <h4 class="simple-header">@lang('app.admin.title')</h4>
                    <div class="control-group">
                        <input class="input-block-level" value="{{$item->title}}" name="title" placeholder="@lang('app.admin.title.desc')">
                    </div>
                </div>
                <div class="well well-nice">
                    <h4 class="simple-header">@lang('app.admin.content')</h4>
                    <div class="control-group">
                        <textarea id="wysiBooEditor" class="input-block-level" style="height: 560px" name="content" placeholder="@lang('app.admin.content.desc')">{{$item->content}}</textarea>
                    </div>
                </div>
            </section>
            <section>
                <div class="form-actions no-margin-bootom">
                    <button type="submit" class="btn btn-green">@lang('app.btn.save')</button>
                    <button class="btn cancel" type="reset">@lang('app.btn.reset')</button>
                    <a href="javascript:history.back()" class="btn btn-green pull-right" type="submit">@lang('app.btn.back')</a>
                </div> 
            </section>
        </form>
        <!-- // form --> 
    </div>
    <!-- // page content --> 
</div>
<!-- // main-content --> 
@endsection
