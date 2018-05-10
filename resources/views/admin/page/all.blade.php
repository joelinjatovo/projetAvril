@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
<div class="row-fluid page-head">
    <h2 class="page-title"><i class="fa fa-registered" aria-hidden="true"></i> @lang('app.admin.page.list') </h2>
</div>
<div id="page-content" class="page-content">
    @include('includes.alerts')
    <section>
        <div class="row-fluid">
            <div class="span12">
                @include('admin.table.page',['pages'=>$items])
            </div>
        </div>
    </section>
</div>
</div>
@endsection
