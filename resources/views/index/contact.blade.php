@extends('layouts.app')

@section('content')
<div id="contact-page" class="contact-page-var-two" style="margin-top: 160px;">
    <div class="container">
        <h3 class="entry-title">{{$title}}</h3>
        <section class="col-md-6">
            <div class="contact-form-wrapper">
                <div class="contents">
                    <p>
                        @if(empty($content))
                            Sed perspiciatis unde natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae.
                        @else
                            {!!$content!!}
                        @endif
                    </p>
                </div>
                <div class="contact-page-contents clearfix">
                    <div class="row">
                        <div class="col-md-6">
                            <i class="fa fa-map-marker"></i>
                            <div class="contents">
                                <h6 class="title">@lang('app.form.login.address')</h6>
                                <address>
                                    @if(empty($address))
                                        95 Amphitheatre Parkway
                                        Mountain View CA,
                                        United States
                                    @else
                                        {!!$address!!}
                                    @endif
                                </address>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <i class="fa fa-phone"></i>
                            <div class="contents">
                                <h5 class="title">@lang('app.form.login.contact')</h5>
                                @if(empty($contact))
                                    <ul>
                                        <li>Phone: (123) 45678910</li>
                                        <li>Mail: company@domain.com</li>
                                        <li>Fax: +84 962 216 601</li>
                                    </ul>
                                @else
                                    {!!$contact!!}
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="col-md-6">
            @include('includes.alerts')
            <div class="page-content">
                <div class="col-md-12">
                    <form action="{{route('contact')}}" method="post" id="commentform" class="contact-form" >
                        {{ csrf_field() }}
                        <p class="form-email common">
                            <input id="email" name="email" type="email" placeholder="Votre email *" aria-required="true" required="required">
                        </p>
                         <p class="form-author common">
                            <input id="name" name="name" type="text" placeholder="Votre nom *" aria-required="true" required="required">
                        </p>
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
    </div>
</div>
@endsection
