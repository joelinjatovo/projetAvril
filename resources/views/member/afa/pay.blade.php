@extends('layouts.lte')

@section('stripe')
@parent()
<style>
#session-messages {
    font-size: 12px !important;
}
div.box {
  margin: auto;
  padding: 0px;
}
#img-column {
    padding: 0px;
    max-height: 260px;
}
hr {
    margin: 0px;
}
.product-info {
    background-color: #e8e8e8;
    padding: 0px;
}
.product-info > p {
    padding: 12px;
    padding-top: 30px;
    padding-bottom: 30px;
    font-family: 'Maven Pro', sans-serif;
    color: #00D1B2;
}
#input-column {
    padding-top: 30px;
    padding-bottom: 30px;
}
.error {
  display: none;
  font-size: 13px;
}
.error.visible {
  display: inline;
}
.error {
  color: #E4584C;
}
/***********
SUCCESS PAGE
*************/
#thank-you  h1 {
    font-family: 'Roboto', sans-serif;
    padding-top: 30px;
    margin-bottom: 0px;
    color: #00D1B2;
}
#thank-you > p {
    font-family: 'Maven Pro', sans-serif;
    padding-bottom: 20px;
}
#thank-you {
    background-color: #e8e8e8;
    padding: 0px;
}
.big  {
    font-size: 200px;
    color: #00D1B2;
}
.sub-title {
    font-family: 'Maven Pro', sans-serif;
    font-size: 40px;
}
#message {
    background-color: #e8e8e8;
    padding: 0px;
}
#message p {
    font-family: 'Maven Pro', sans-serif;
    padding: 30px 20px 30px 20px;
    color: #00D1B2;
}
</style>
@endsection

@section('content')
<div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">@lang('afa.pay.cpc')</div>
      <div class="panel-body">
        <form id="form" action="{{route('afa.pay.cpc')}}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="action" value="pay-cpc">
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
@endsection

@section('script')
@parent()
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