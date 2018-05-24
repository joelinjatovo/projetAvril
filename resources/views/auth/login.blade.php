@extends('layouts.app')

@section('content')
<div id="contact-page" class="contact-page-var-two" style="margin-top: 160px;">
    <div class="container">
        <h3 class="entry-title">{{$title}}</h3>
        <div class="row">
            <div class="col-md-6">
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
            </div>
            <div class="col-md-6">
                @include('includes.alerts')
                <form class="contact-form" method="POST" action="{{route('login')}}">
                    {{ csrf_field() }}
                    <p class="form-email common form-group {{ $errors->has('email') ? ' has-error' : '' }}"> 
                        <input name="email" type="email" placeholder="Votre email *" aria-required="true" required="required" value="{{ old('email') }}" autofocus>
                    </p>
                    <p class="form-author common form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                         <input name="password"  type="password" placeholder="Votre mot de passe *" aria-required="true" required="required">
                    </p>
                    <p>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('app.form.login.remember')
                    </p>
                    <p>
                        <a href="{{ route('password.request')}}">@lang('app.form.login.forgot')</a>
                    </p>
                    <p class="form-submit">
                        <button type="submit" class="pull-right btn btn-default btn-lg" data-hover="Connexion">@lang('app.btn.login')</button>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection