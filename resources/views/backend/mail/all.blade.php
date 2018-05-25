@extends('layouts.backend')

@section('subcontent')
<div id="property-sidebar">
    <div class="col-sm-9">
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
    <div class="col-md-3">
        <div class="sidebar content-box" style="display: block; background: #fff; margin-bottom: 10px;">
            <ul class="nav nav-side">
                <li><a href="{{route('mail.list',['filter'=>'inbox'])}}"><i class="fa fa-pencil-square" aria-hidden="true"></i> @lang('app.mail.inbox')</a></li>
                <li><a href="{{route('mail.list',['filter'=>'outbox'])}}"><i class="fa fa-pencil-square" aria-hidden="true"></i> @lang('app.mail.outbox')</a></li>
                <li><a href="{{route('mail.list',['filter'=>'draft'])}}"><i class="fa fa-pencil-square" aria-hidden="true"></i> @lang('app.mail.draft')</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection
