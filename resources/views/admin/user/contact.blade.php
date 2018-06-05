@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <div class="row-fluid page-head">
        <h2 class="page-title">{{$title}}</h2>
    </div>
    @include('includes.alerts')
    <div class="">
        <div class="widget widget-simple">
            <div class="widget-content">
                <div class="widget-body">
                    <form action="{{route('admin.user.contact', $item)}}" method="post" id="commentform" class="contact-form" >
                        {{ csrf_field() }}
                        <ul class="form-list label-left list-bordered dotted" style="padding:0px;">
                            <li class="control-group">
                                <label for="subject" class="control-label">@lang('app.subject')</label>
                                <div class="controls">
                                    <input id="subject" class="input-block-level" name="subject" type="text" placeholder="@lang('app.subject') *" aria-required="true" required="required" value="{{$mail->subject}}">
                                </div>
                            </li>
                            <li class="control-group">
                                <label for="message">@lang('app.message')</label>
                                <div class="controls">
                                    <textarea id="message" class="input-block-level ckeditor" rows="10" name="content" placeholder="@lang('app.message')" >{{$mail->content}}</textarea>
                                </div>
                            </li>
                        </ul>
                        <div class="form-actions no-margin-bootom">
                            <button type="submit" class="btn btn-green" name="method" value="send">@lang('app.btn.send')</button>
                            <button type="submit" class="btn pull-right" name="method" value="draft">@lang('app.btn.draft')</button>
                            <button type="submit" class="btn btn-blue pull-right" name="method" value="model">@lang('app.btn.save_as_model')</button>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
        <!-- // Widget -->
    </div>
</div>
@endsection
