@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <div class="row-fluid page-head">
        <h2 class="page-title"><i class="aweso-icon-list-alt"></i> @lang('app.admin.page.gestion') <small>@if($item->id>0) @lang('app.admin.page.update') @else @lang('app.admin.page.add') @endif</small></h2>
    </div>
    @include('includes.alerts')
    <div id="page-content" class="page-content">
        <form method="post" action="{{$action}}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <section>
                <div class="well well-nice">
                    <h4 class="simple-header">@lang('app.admin.title') (FR)</h4>
                    <div class="control-group">
                        <input type="text" class="input-block-level" value="{{$item->title}}" name="title" placeholder="@lang('app.admin.title.desc')">
                    </div>
                </div>
                <div class="well well-nice">
                    <h4 class="simple-header">@lang('app.admin.content') (FR)</h4>
                    <div class="control-group">
                        <textarea id="ckeditor" class="input-block-level" style="height: 320px" name="content" placeholder="@lang('app.admin.content.desc')">{!!$item->content!!}</textarea>
                    </div>
                </div>
                <div class="well well-nice">
                    <h4 class="simple-header">@lang('app.admin.title') (EN)</h4>
                    <div class="control-group">
                        <input type="text" class="input-block-level" value="{{$item->title_en}}" name="title_en" placeholder="@lang('app.admin.title.desc')">
                    </div>
                </div>
                <div class="well well-nice">
                    <h4 class="simple-header">@lang('app.admin.content') (EN)</h4>
                    <div class="control-group">
                        <textarea id="ckeditor" class="input-block-level" style="height: 320px" name="content_en" placeholder="@lang('app.admin.content.desc')">{!!$item->content_en!!}</textarea>
                    </div>
                </div>
                <div class="well well-nice">
                    <h4 class="simple-header">@lang('app.admin.path')</h4>
                    <div class="control-group">
                        <input type="text" class="input-block-level" value="{{$item->path}}" name="path" placeholder="@lang('app.admin.path.desc')">
                    </div>
                </div>
            </section>
            <section>
                <div class="row-fluid">
                    <div class="well well-nice">
                        <h4 class="simple-header">@lang('app.admin.parent')</h4>
                        <select name="parent_id" style="width:100%;" class="input-block-level" >
                            <option value="0">@lang('app.select_one')</option>
                            @foreach($pages as $page)
                                <option value="{{$page->id}}" {{$page->id==$item->parent_id?'selected':''}}>{{$page->title}} ({{$page->path}})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </section>
            <section>
                <div class="well well-nice">
                    <h4 class="simple-header">@lang('app.admin.page_order')</h4>
                    <div class="control-group">
                        <input type="number" min="0" class="input-block-level" value="{{$item->page_order}}" name="page_order" placeholder="@lang('app.admin.page_order.desc')">
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
