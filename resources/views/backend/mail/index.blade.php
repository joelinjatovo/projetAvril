@extends('layouts.backend')

@section('subcontent')
<div id="property-sidebar">
    <div class="col-sm-12">
        <a href="{{route('mail.delete', $item)}}" class="pull-right submit-btn btn btn-default btn-lg" data-hover="@lang('app.btn.delete')">@lang('app.btn.delete')</a>
        <section class="widget property-contents common">
            <h3 class="entry-title">{{$item->subject}}</h3>
            <p>{{$item->content}}</p>
        </section>
    </div>
</div>
<section>
    <div class="page-content">
        <div class="col-md-12">
            <h3 class="entry-title">@lang('app.reply')</h3>
            <form action="{{route('contact')}}" method="post" id="commentform" class="contact-form" >
                {{ csrf_field() }}
                <input type="hidden" name="receiver_id" value="{{$item->sender_id}}" >
                <p class="form-subject">
                    <input id="subject" name="subject" type="text" placeholder="Sujet *" aria-required="true" required="required">
                </p>
                <p class="form-comment"><textarea id="content" name="content" placeholder="@lang('app.message')" cols="45" rows="8" aria-required="true" required="required"></textarea></p>
                <p class="form-submit">
                    <button type="submit" class="pull-right submit-btn btn btn-default btn-lg" data-hover="@lang('app.btn.send')">@lang('app.btn.send')</button>
                    <span id="ajax-loader"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i><span class="sr-only">Loading...</span></span>
                </p>
                <div id="error-container"></div>
                <div id="message-container"></div>
            </form>
        </div>
    </div>
</section>
@endsection