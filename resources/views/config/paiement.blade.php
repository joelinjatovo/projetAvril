@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <div id="page-content" class="page-content">
        <section>
            <div class="page-header">
                <h3>@lang('app.payment')</h3>
            </div>
            @include('includes.alerts')
            <div class="row-fluid margin-bottom40">
                <div class="col-md-12">
                    <fieldset>
                        <form method="post" action="{{route('config.payment.update')}}">
                          <input type="hidden" name="_token" value="{{csrf_token()}}">
                          @foreach($titles as $key=>$value)
                            <div class="form-group">
                                <label for="{{$key}}">{{$value}}</label>
                                <input id="{{$key}}" name="{{$key}}" class="input-block-level" type="text"
                                     value="{{old($key)?old($key):($item->get_meta($key)?$item->get_meta($key)->value:'')}}">
                            </div>
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