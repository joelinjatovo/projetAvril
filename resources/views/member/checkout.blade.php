@extends('layouts.lte')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="invoice" style="margin:0;">
              <!-- title row -->
              <div class="row">
                <div class="col-xs-12">
                  <h2 class="page-header">
                    <i class="fa fa-globe"></i> Votre commande
                  </h2>
                </div>
                <!-- /.col -->
              </div>

              <!-- Table row -->
              <div class="row">
                <div class="col-xs-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Product</th>
                      <th>Description</th>
                      <th>Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($product = $item->product)
                    <tr>
                      <td>{{$product->title}}</td>
                      <td>{{$product->excerpt(80)}}</td>
                      <td>{{$product->getPrice()}}</td>
                    </tr>
                    @endif
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-4">
                  <p class="lead">Payment Methods:</p>
                  <img src="/lte/img/credit/visa.png" alt="Visa">
                  <img src="/lte/img/credit/mastercard.png" alt="Mastercard">
                  <img src="/lte/img/credit/american-express.png" alt="American Express">
                  <img src="/lte/img/credit/paypal2.png" alt="Paypal">
                </div>
                <!-- /.col -->

                <div class="col-xs-8">
                  <p class="lead">Paimenent par carte de crédit</p>
                    <form id="form" action="{{route('shop.checkout')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="action" value="checkout">
                        <input name="stripe_token" type="hidden"/>
                        <div id="card-element" class="field"></div>
                        <hr>
                        <div id="session-messages" class="column has-text-centered _session-messages">
                            <div class="error" role="alert"></div>
                            @include('subscription.partials._alerts')
                        </div>
                        
                        <button type="submit" class="btn btn-success pull-right" id="pay-button"><i class="fa fa-credit-card"></i> @lang('member.pay_now')
                        </button>
                        
                    </form>
                </div>
              </div>
              <!-- /.row -->
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