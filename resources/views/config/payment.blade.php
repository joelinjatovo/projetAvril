@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <div id="page-content" class="page-content">
        <section>
            <div class="page-header">
                <h3>@lang('app.payment')</h3>
            </div>
            @include('includes.alerts')
            <div class="margin-bottom40">
                <div class="">
                    <form method="post" action="{{route('config.payment.update')}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <fieldset>
                            <legend>@lang('app.inscription')</legend>
                            <div class="form-group">
                                <label for="trial_delay">@lang('app.trial_delay')</label>
                                <input id="trial_delay" name="trial_delay" 
                                       class="input-block-level" 
                                       type="number"
                                       placeholder="@lang('app.placeholder.trial_delay')"
                                       value="{{old('trial_delay')?old('trial_delay'):
                                            ($item->get_meta('trial_delay')?$item->get_meta('trial_delay')->value:'')}}">
                            </div>
                            <div class="form-group">
                                <label for="disable_payed_inscription">@lang('app.disable_payed_inscription')</label>
                                <input type="checkbox" name="disable_payed_inscription" id="disable_payed_inscription" value="1"
                                       {{old('disable_payed_inscription')?'checked':
                                       ($item->get_meta('disable_payed_inscription')&&$item->get_meta('disable_payed_inscription')->value?'checked':'')}}> @lang('app.placeholder.disable_payed_inscription')
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>@lang('app.reservation')</legend>
                            <div class="form-group">
                                <label for="percent_reservation">@lang('app.percent_reservation') %</label>
                                <input id="percent_reservation" name="percent_reservation" 
                                       class="input-block-level" 
                                       type="number"
                                       step=".01"
                                       placeholder="@lang('app.placeholder.percent_reservation')"
                                       value="{{old('percent_reservation')?old('percent_reservation'):
                                            ($item->get_meta('percent_reservation')?$item->get_meta('percent_reservation')->value:'')}}">
                                <p class="help-box">@lang('app.percent.desc')</p>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>@lang('app.percent_presentation')</legend>
                            <div class="form-group">
                                <label for="percent_presentation_afa">@lang('app.percent_presentation_afa') %</label>
                                <input id="percent_presentation_afa" name="percent_presentation_afa" 
                                       class="input-block-level" 
                                       type="number"
                                       step=".01"
                                       placeholder="@lang('app.placeholder.percent_presentation_afa')"
                                       value="{{old('percent_presentation_afa')?old('percent_presentation_afa'):
                                            ($item->get_meta('percent_presentation_afa')?$item->get_meta('percent_presentation_afa')->value:'')}}">
                                <p class="help-box">@lang('app.percent.desc')</p>
                            </div>
                            <div class="form-group">
                                <label for="percent_presentation_apl">@lang('app.percent_presentation_apl') %</label>
                                <input id="percent_presentation_apl" name="percent_presentation_apl" 
                                       class="input-block-level" 
                                       type="number"
                                       step=".01"
                                       placeholder="@lang('app.placeholder.percent_presentation_apl')"
                                       value="{{old('percent_presentation_apl')?old('percent_presentation_apl'):
                                            ($item->get_meta('percent_presentation_apl')?$item->get_meta('percent_presentation_apl')->value:'')}}">
                                <p class="help-box">@lang('app.percent.desc')</p>
                            </div>
                        </fieldset>
                        <button type="submit" class="btn btn-primary">@lang('app.btn.save')</button>
                        <button type="reset" class="btn btn-default">@lang('app.btn.cancel')</button>
                  </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection