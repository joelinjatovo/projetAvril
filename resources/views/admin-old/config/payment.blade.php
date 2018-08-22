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
                                       {{old('disable_payed_inscription', $item->meta('disable_payed_inscription', false))?'checked':''}}> @lang('app.placeholder.disable_payed_inscription')
                            </div>
                        </fieldset>
                        
                        <?php 
                            $fields = [
                              'taux_de_reservation',  
                              'commission_sur_vente',  
                              'commission_sur_vente_min',  
                              'commission_presentation_client',  
                              'taux_mio_nor',  
                              'taux_mio_maj',  
                            ];
                        ?>
                        @foreach($fields as $field)
                        <fieldset>
                            <legend>@lang('app.'.$field)</legend>
                            <div class="form-group">
                                <input id="{{$field}}" name="{{$field}}" 
                                       class="input-block-level" 
                                       type="number"
                                       min="0"
                                       max="100"
                                       placeholder="@lang('app.percent.desc')"
                                       value="{{old($field, $item->meta($field, 0))}}">
                                <p class="help-box">@lang('app.placeholder.'.$field)</p>
                            </div>
                        </fieldset>
                        @endforeach
                        <fieldset>
                            <legend>@lang('app.valeur_mio_maj')</legend>
                            <div class="form-group">
                                <input id="valeur_mio_maj" name="valeur_mio_maj" 
                                       class="input-block-level" 
                                       type="number"
                                       min="0"
                                       placeholder="@lang('app.valeur_mio_maj')"
                                       value="{{old('valeur_mio_maj', $item->meta('valeur_mio_maj', 0))}}">
                                <p class="help-box">@lang('app.placeholder.valeur_mio_maj')</p>
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