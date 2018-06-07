@extends('layouts.backend')

@section('subcontent')
<section>
    <div class="page-header">
        <h3>{{$title}}</h3>
    </div>
    <div class="page-content">
        <div class="col-md-12">
            <form action="{{$action}}" method="post" id="commentform" class="contact-form" >
                {{ csrf_field() }}
                <p class="form-subject">
                    <input id="subject" name="subject" type="text" placeholder="Sujet *" aria-required="true" required="required" value="{{$mail->subject}}">
                </p>
                <p class="form-comment"><textarea id="content" name="content" placeholder="@lang('app.message')" cols="45" rows="8" aria-required="true" required="required">{{$mail->content}}</textarea></p>
                <p class="form-submit">
                    <button type="submit" name="method" value="send" class="pull-right submit-btn btn btn-default btn-lg" data-hover="@lang('app.btn.send')">@lang('app.btn.send')</button>
                </p>
            </form>
        </div>
    </div>
</section>
@endsection
