@extends('layouts.lte')

@section('content')
<div class="row">
    <form method="post" action="{{route('config.social.update')}}">
        {{csrf_field()}}
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">@lang('app.config.payment')</h3>
                  <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body">
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
                    <div class="form-group">
                        <label>@lang('app.'.$field)</label>
                        <div class="input-group">
                              <input id="{{$field}}" name="{{$field}}" 
                                   class="form-control" 
                                   type="number"
                                   min="0"
                                   max="100"
                                   placeholder="@lang('app.percent.desc')"
                                   value="{{old($field, $item->meta($field, 0))}}">
                            <span class="input-group-addon">%</span>
                        </div>
                        <span class="help-box">@lang('app.placeholder.'.$field)</span>
                    </div>
                    @endforeach
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">@lang('app.inscription')</h3>
                  <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body">
                    <!-- text input -->
                    <div class="form-group">
                      <label>@lang('app.trial_delay')</label>
                      <input id="trial_delay" name="trial_delay" 
                           class="form-control" 
                           type="number"
                           placeholder="@lang('app.placeholder.trial_delay')"
                           value="{{old('trial_delay',$item->meta('trial_delay', ''))}}">
                    </div>
                    <div class="form-group">
                        <label for="disable_payed_inscription">@lang('app.disable_payed_inscription')</label>
                        <span class="help-block"  for="disable_payed_inscription">
                            <input type="checkbox" 
                                  id="disable_payed_inscription" 
                                  name="disable_payed_inscription" 
                                  value="1"
                                  {{old('disable_payed_inscription', $item->meta('disable_payed_inscription', false))?'checked':''}}>
                            @lang('app.placeholder.disable_payed_inscription')
                        </span>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-12">
            <div class="pull-right">
              <button type="submit" class="btn btn-info" name="method" value="draft"><i class="fa fa-database"></i> @lang('app.btn.save')</button>
          </div>
          <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> @lang('app.btn.discard')</button>
        </div>
    </form>
</div>
@endsection