@extends('layouts.backend')

@section('subcontent')
<div id="property-single">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading"><h3>{{ $plan->name }}</h3></div>
              <div class="panel-body">
                <form id="form" action="{{ url('/subscribe') }}" method="post">
                    <input type="hidden" name="plan" value="{{ $plan->id }}">
                    {{ csrf_field() }}
                    <input name="stripe_token" type="hidden"/>
                    <div id="card-element" class="field"></div>
                    <hr>
                    <div id="session-messages" class="column has-text-centered _session-messages">
                        <div class="error" role="alert"></div>
                            @include('subscription.partials._alerts')
                    </div>
                    <div class="field">
                        <button type="submit" id="pay-button" class="btn btn-primary btn-flat">
                            <strong>@lang('member.pay_now')</strong>
                        </button>
                    </div>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('stripe')
<script src="https://js.stripe.com/v3/"></script>
<script>
(function() {
   var stripe = Stripe('{!!env("STRIPE_KEY")!!}');
   var elements = stripe.elements();
   var card = elements.create('card', {
      style: {
        base: {
          iconColor: '#666EE8',
          color: '#31325F',
          lineHeight: '40px',
          fontWeight: 300,
          fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
          fontSize: '15px',
          '::placeholder': {
            color: '#CFD7E0',
          },
        },
      }
    });
    
    card.mount('#card-element');
    
    function setOutcome(result) {
        console.log(result);
        
      var form = document.querySelector('#form');
      var errorElement = document.querySelector('.error');
      
      errorElement.classList.remove('visible');
      
      if (result.token) {
        form.querySelector('input[name=stripe_token]').value = result.token.id;
        form.submit();
      } else if (result.error) {
        errorElement.textContent = result.error.message;
        errorElement.classList.add('visible');
        document.querySelector('#pay-button').disabled = false;
        document.querySelector('#pay-button').textContent = initialSubmitText;
      }
    }
    
    card.on('change', function(event) {
      setOutcome(event);
    });
    
    document.querySelector('#form').addEventListener('submit', function(e) {
        e.preventDefault();
        document.querySelector('#pay-button').disabled = true;
        var initialSubmitText = document.querySelector('#pay-button').textContent;
        document.querySelector('#pay-button').textContent = "Processing...";
        stripe.createToken(card).then(setOutcome);
    });
})();
</script>
@endsection