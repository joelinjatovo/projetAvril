@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <div id="page-content" class="page-content">
        <section>
            <div class="page-header">
                <h3>@lang('app.social_network')</h3>
            </div>
            @include('includes.alerts')
            <div class="row-fluid margin-bottom40">
                <div class="span12 well well-nice">
                    <fieldset>
                        <form method="post" action="{{route('config.social.update')}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            @foreach($titles as $key=>$value)
                            <label for="url_{{$key}}">
                                <i class="fontello-icon-{{$key}}" aria-hidden="true"></i>{{$value}} 
                            </label>
                            <input id="url_{{$key}}" class="input-block-level span12" type="url" name="{{$key}}" placeholder="https://www.{{$key}}.com" value="{{old($key)?old($key):($item->get_meta($key)?$item->get_meta($key)->value:'')}}">
                            @endforeach
                            <button type="submit" class="btn btn-primary">@lang('app.btn.save')</button>
                            <button type="reset" class="btn btn-default">@lang('app.btn.cancel')</button>
                        </form>
                    </fieldset>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection