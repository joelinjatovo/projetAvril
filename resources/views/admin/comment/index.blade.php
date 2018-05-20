@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <!-- // page head -->
    <div id="page-content" class="page-content tab-content overflow-y">
        <div id="TabTop1" class="tab-pane padding-bottom30 active fade in">
            @include('includes.alerts')
            <div>
                 @if($item->status=='pinged' || $item->blog=='archived')
                    <a href="{{route('admin.comment.publish', $item)}}" class="btn btn-small btn-success btn-publish">@lang('app.btn.publish')</a>
                    <a href="{{route('admin.comment.trash', $item)}}" class="btn btn-small btn-info btn-trash">@lang('app.btn.trash')</a>
                 @elseif($item->status=='trashed')
                    <a href="{{route('admin.comment.restore', $item)}}" class="btn btn-small btn-info btn-restore">Restore</a>
                 @endif
                 @if($item->status=='published')
                    <a href="{{route('admin.comment.archive', $item)}}" class="btn btn-small btn-default  btn-archive">@lang('app.btn.archive')</a>
                    <a href="{{route('admin.comment.trash', $item)}}" class="btn btn-small btn-info btn-trash">@lang('app.btn.trash')</a>
                 @endif
                    <a href="{{route('admin.comment.delete', $item)}}" class="btn btn-small btn-warning btn-delete">@lang('app.btn.delete')</a>
            </div>
            <div class="row-fluid">
                <div class="grider">
                    <div class="widget widget-simple">
                        <div class="widget-content">
                            <div class="widget-body">
                                <fieldset>
                                    <h4>@lang('app.comment')</h4>
                                    <p>{!!$item->content!!}</p>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    
                    <div class="widget widget-simple">
                        <div class="widget-header">
                            <h4><small>@lang('app.replies')</small></h4>
                        </div>
                        @include('admin.table.comment',['comments'=>$item->replies])
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

