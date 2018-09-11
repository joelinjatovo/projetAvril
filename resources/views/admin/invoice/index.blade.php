@extends('layouts.lte')

@section('content')
    <div class="invoice" style="margin:0;">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-globe"></i> {{app_name()}}
                <small class="pull-right">Date: {{$item->created_at->format('d/m/Y')}}</small>
              </h2>
            </div>
            <!-- /.col -->
          </div>

          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              From
              @if($item->from)
              <address>
                <strong>{{$item->from->fullname()}}</strong><br>
                @if($location=$item->from->location)
                    {{$location->toString()}}<br>
                @endif
                Phone: {{$item->from->meta('phone')}}<br>
                Email: {{$item->from->email}}
              </address>
              @endif
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              To
              @if($item->to)
              <address>
                <strong>{{$item->to->fullname()}}</strong><br>
                @if($location=$item->to->location)
                    {{$location->toString()}}<br>
                @endif
                Phone: {{$item->to->meta('phone')}}<br>
                Email: {{$item->to->email}}
              </address>
              @endif
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <b>Invoice #{{$item->id}}</b><br>
              <br>
              <b>Order ID:</b> #{{$item->order_id}}<br>
              <b>Payment Due:</b> {{$item->created_at->format('Y-m-d')}}
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

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
                @if($item->order && ($product = $item->order->product))
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
            <div class="col-xs-6">
              <p class="lead">Payment Methods:</p>
              <img src="/lte/img/credit/visa.png" alt="Visa">
              <img src="/lte/img/credit/mastercard.png" alt="Mastercard">
              <img src="/lte/img/credit/american-express.png" alt="American Express">
              <img src="/lte/img/credit/paypal2.png" alt="Paypal">
            </div>
            <!-- /.col -->

            <div class="col-xs-6">
              <p class="lead">Amount Due {{$item->created_at->format('Y-m-d')}}</p>

              <div class="table-responsive">
                <table class="table">
                  <tbody>
                      <tr>
                        <th>Total:</th>
                        <td>{{$item->getPrice()}}</td>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-xs-12">
              <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
              <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
              </button>
              <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                <i class="fa fa-download"></i> Generate PDF
              </button>
            </div>
          </div>
    </div>
@endsection
