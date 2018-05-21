@extends('layouts.backend')

@section('subcontent')
<div id="property-sidebar">
    <div class="col-sm-12">
        <section class="widget recent-properties clearfix">
            <div class="page-header">
                <h3>{{isset($title)?$title:__('app.list.mail')}}</h3>
            </div>
            @foreach($items as $item)
                @include('backend.mail.item', ['mail'=>$item])
            @endforeach
        </section>
        {{$items->links()}}
    </div>
</div>
@endsection
