@extends('layouts.backend')

@section('style-stripe')
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

@section('subcontent')
<div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <div  id="thank-you" class="column has-text-centered">
            <h1 class="title is-3">
                Thank You
            </h1>
            <p>
                {{ Auth::user()->email }}
            </p>
        </div>
        <div class="column has-text-centered">
            <i class="fa fa-check-circle-o big"></i>
            <p class="sub-title">
                Succesful Payment
            </p>
        </div>
        <div id="message" class="column has-text-centered">
            <p>
                You have been successfully charged for this transaction. A receipt for this purchase has been sent to your email.
            </p>
        </div>
      </div>
    </div>
</div>
@endsection