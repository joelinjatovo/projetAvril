@extends('layouts.backend')

@section('subcontent')
<div id="property-single">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading"><h3>{{ $plan->name }}</h3></div>
              <div class="panel-body">
                <form action="{{ url('/subscribe') }}" method="post">
                  <div id="dropin-container"></div>
                  <hr>
                  <input type="hidden" name="plan" value="{{ $plan->id }}">
                  {{ csrf_field() }}
                  <button id="payment-button" class="btn btn-primary btn-flat hidden" type="submit">Pay now</button>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('braintree')
<script src="https://js.braintreegateway.com/js/braintree-2.30.0.min.js"></script>
<script>
braintree.setup('CLIENT-TOKEN-FROM-SERVER', 'dropin', {
    container: 'dropin-container'
});
</script>
<script>
    $.ajax({
        url: '{{ url('braintree/token') }}'
    }).done(function (response) {
        braintree.setup(response.data.token, 'dropin', {
            container: 'dropin-container',
            onReady: function () {
                $('#payment-button').removeClass('hidden');
            }
        });
    });
</script>
@endsection