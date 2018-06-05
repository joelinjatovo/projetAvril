@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <div class="row-fluid page-head">
        <h2 class="page-title">{{$title}}</h2>
    </div>
    <div id="page-content" class="page-content">
        <section>
            <div class="row-fluid">
                <div class="span12">
                  {!! Form::open(['url' => route('order-post'), 'data-parsley-validate']) !!}

                  <div class="form-group" id="first-name-group">
                      {!! Form::label('firstName', 'First Name:') !!}
                      {!! Form::text('firstname', null, [
                          'class'                         => 'form-control',
                          'required'                      => 'required',
                          'data-parsley-required-message' => 'First name is required',
                          'data-parsley-trigger'          => 'change focusout',
                          'data-parsley-pattern'          => '/^[a-zA-Z]*$/',
                          'data-parsley-minlength'        => '2',
                          'data-parsley-maxlength'        => '32',
                          'data-parsley-class-handler'    => '#first-name-group'
                          ]) !!}
                  </div>

                  <div class="form-group" id="last-name-group">
                      {!! Form::label('lastName', 'Last Name:') !!}
                      {!! Form::text('lastname', null, [
                          'class'                         => 'form-control',
                          'required'                      => 'required',
                          'data-parsley-required-message' => 'Last name is required',
                          'data-parsley-trigger'          => 'change focusout',
                          'data-parsley-pattern'          => '/^[a-zA-Z]*$/',
                          'data-parsley-minlength'        => '2',
                          'data-parsley-maxlength'        => '32',
                          'data-parsley-class-handler'    => '#last-name-group'
                          ]) !!}
                  </div>

                  <div class="form-group" id="email-group">
                      {!! Form::label('email', 'Email address:') !!}
                      {!! Form::email('email', null, [
                          'class' => 'form-control',
                          'placeholder'                   => 'email@example.com',
                          'required'                      => 'required',
                          'data-parsley-required-message' => 'Email name is required',
                          'data-parsley-trigger'          => 'change focusout',
                          'data-parsley-class-handler'    => '#email-group'
                          ]) !!}
                  </div>

                  <div class="form-group" id="cc-group">
                      {!! Form::label(null, 'Credit card number:') !!}
                      {!! Form::text(null, null, [
                          'class'                         => 'form-control',
                          'required'                      => 'required',
                          'data-parsley-type'             => 'number',
                          'maxlength'                     => '16',
                          'data-parsley-trigger'          => 'change focusout',
                          'data-parsley-class-handler'    => '#cc-group'
                          ]) !!}
                  </div>

                  <div class="form-group" id="ccv-group">
                      {!! Form::label(null, 'Card Validation Code (3 or 4 digit number):') !!}
                      {!! Form::text(null, null, [
                          'class'                         => 'form-control',
                          'required'                      => 'required',
                          'data-parsley-type'             => 'number',
                          'data-parsley-trigger'          => 'change focusout',
                          'maxlength'                     => '4',
                          'data-parsley-class-handler'    => '#ccv-group'
                          ]) !!}
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group" id="exp-m-group">
                          {!! Form::label(null, 'Ex. Month') !!}
                          {!! Form::selectMonth(null, null, [
                              'class'                 => 'form-control',
                              'required'              => 'required'
                          ], '%m') !!}
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group" id="exp-y-group">
                          {!! Form::label(null, 'Ex. Year') !!}
                          {!! Form::selectYear(null, date('Y'), date('Y') + 10, null, [
                              'class'             => 'form-control',
                              'required'          => 'required'
                              ]) !!}
                      </div>
                    </div>
                  </div>

                    <div class="form-group">
                        {!! Form::submit('Place order!', ['class' => 'btn btn-primary btn-order', 'id' => 'submitBtn', 'style' => 'margin-bottom: 10px;']) !!}
                    </div>

                {!! Form::close() !!}
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
@section('script')
<!-- PARSLEY -->
<script>
    window.ParsleyConfig = {
        errorsWrapper: '<div></div>',
        errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>',
        errorClass: 'has-error',
        successClass: 'has-success'
    };
</script>
<script src="http://parsleyjs.org/dist/parsley.js"></script>

<!-- Inlude Stripe.js -->
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>
    // This identifies your website in the createToken call below
    Stripe.setPublishableKey('{!!env("STRIPE_SK")!!}');

    jQuery(function($) {
        $('#payment-form').submit(function(event) {
            var $form = $(this);

            // Before passing data to Stripe, trigger Parsley Client side validation
            $form.parsley().subscribe('parsley:form:validate', function(formInstance) {
                formInstance.submitEvent.preventDefault();
                return false;
            });

            // Disable the submit button to prevent repeated clicks
            $form.find('#submitBtn').prop('disabled', true);

            Stripe.card.createToken($form, stripeResponseHandler);

            // Prevent the form from submitting with the default action
            return false;
        });
    });

    function stripeResponseHandler(status, response) {
        var $form = $('#payment-form');

        if (response.error) {
            // Show the errors on the form
            $form.find('.payment-errors').text(response.error.message);
            $form.find('.payment-errors').addClass('alert alert-danger');
            $form.find('#submitBtn').prop('disabled', false);
            $('#submitBtn').button('reset');
        } else {
            // response contains id and card, which contains additional card details
            var token = response.id;
            // Insert the token into the form so it gets submitted to the server
            $form.append($('<input type="hidden" name="stripe_token" />').val(token));
            // and submit
            $form.get(0).submit();
        }
    };
</script>
@endsection
