@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <div id="page-content" class="page-content">
        @include('includes.alerts')
        <div class="page-header">
            <h3>@lang('app.message'): {{$item->name}}</h3>
        </div>
        <div class="page-content">
            <div class="col-md-12">
                <form action="{{route('admin.mail.send', $item)}}" method="post" id="commentform" class="contact-form" >
                    {{ csrf_field() }}
                    <input type="hidden" name="receiver_id" value="{{$item->id}}" >
                    <p class="form-subject">
                        <input id="subject" name="subject" type="text" placeholder="Sujet *" aria-required="true" required="required">
                    </p>
                    <p class="form-comment"><textarea id="content" name="content" placeholder="@lang('app.message')" cols="45" rows="8" aria-required="true" required="required"></textarea></p>
                    <p class="form-submit">
                        <button type="submit" class="pull-right submit-btn btn btn-default btn-lg" data-hover="@lang('app.btn.send')">@lang('app.btn.send')</button>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
