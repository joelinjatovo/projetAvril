@extends('layouts.app')

@section('content')
<div id="contact-page" class="contact-page-var-two" style="margin-top: 160px;">
    <div class="container">
        <h3 class="entry-title">@lang('app.connexion')</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="contact-form-wrapper">
                    <div class="contents">
                        <p>{!!$item->content!!}</p>
                    </div>
                    @foreach($item->childs as $child)
                    <div class="contact-page-contents clearfix">
                        {!!$child->content!!}
                    </div>
                    @endforeach

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