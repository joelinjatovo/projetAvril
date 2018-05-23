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
                    @lang('app.comment.list')
                @endif
                </h3>
            </div>
            <div class="row-fluid margin-bottom16">
                 <div class="span12">
                     @include('includes.alerts')
                     <div class="widget widget-simple widget-table">
                         @include('admin.table.comment', ['comments'=>$items])
                     </div>
                 </div>
                 {{$items->links()}}
            </div>
        </section>
    </div>
</div>
@endsection
