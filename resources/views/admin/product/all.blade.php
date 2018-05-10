@extends('layouts.admin')

@section('content')
<div class="main-content container-fluid">
    <div id="page-content" class="page-content">
        <section>
            <div class="page-header">
                <h3>@lang('app.admin.product.list')</h3>
            </div>
             <div class="row-fluid margin-bottom16">
                 <div class="span12">
                     @include('includes.alerts')
                     <div class="widget widget-simple widget-table">
                         @include('admin.table.product', ['products'=>$items])
                     </div>
                 </div>
             </div>
        </section>
    </div>
</div>
@endsection
