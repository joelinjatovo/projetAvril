<div class="property clearfix">
    <a href="{{route('mail.index', $mail)}}" class="pull-right submit-btn btn btn-default" data-hover="@lang('app.btn.view')">@lang('app.btn.view')</a>
    <a href="{{route('mail.delete', $mail)}}" class="pull-right submit-btn btn btn-default" data-hover="@lang('app.btn.delete')">@lang('app.btn.delete')</a>
    <h6 class="entry-title"> <a href="{{route('mail.index',['mail'=>$mail])}}">{{$mail->subject}}</a></h6>
    <p>{{$mail->content}}</p>
</div>