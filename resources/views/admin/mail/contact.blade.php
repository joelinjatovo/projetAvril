@extends('layouts.admin')

@section('content')

<div id="main-content" class="main-content container-fluid">
    <div class="row-fluid page-head">
        <h2 class="page-title">@lang('app.message'): {{$item->name}}</h2>
    </div>
    @include('includes.alerts')
    <div class="">
        <div class="widget widget-simple">
            <div class="widget-content">
                <div class="widget-body">
                    <form action="{{route('admin.mail.send', $item)}}" method="post" id="commentform" class="contact-form" >
                        {{ csrf_field() }}
                        <input type="hidden" name="receiver_id" value="{{$item->id}}" >
                        <fieldset>
                            <label for="subject" class="control-label">@lang('app.subject')</label>
                            <input id="subject" class="input-block-level" name="subject" type="text" placeholder="@lang('app.subject') *" aria-required="true" required="required">
                            <label for="message">@lang('app.message')</label>
                            <textarea id="message" class="input-block-level ckeditor" rows="10" name="content" placeholder="@lang('app.message')" ></textarea>
                        </fieldset>
                        <!-- // fieldset Input -->
                        <p class="form-submit">
                            <button class="btn btn-green btn-glyph" >@lang('app.btn.send')</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <!-- // Widget -->
    </div>
</div>
@endsection
