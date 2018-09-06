@extends('layouts.lte')

@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-xs-6">
       @include('components.small-box', [
          'class' =>'bg-yellow',
          'count' =>$count['users'],
          'title' =>'Utilisateurs inscrits',
          'icon'  =>'ion ion-person-add',
          'link'  =>route('admin.user.list'),
       ])
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
       @include('components.small-box', [
          'class' =>'bg-green',
          'count' =>$count['products'],
          'title' =>'Produits enregistrés',
          'icon'  =>'ion ion-stats-bars',
          'link'  =>route('admin.product.list'),
       ])
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
       @include('components.small-box', [
          'class' =>'bg-aqua',
          'count' =>$count['orders'],
          'title' =>'Commandes',
          'icon'  =>'ion ion-bag',
          'link'  =>route('admin.product.list', 'ordered'),
       ])
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
       @include('components.small-box', [
          'class' =>'bg-red',
          'count' =>$count['sales'],
          'title' =>'Ventes éffectuées',
          'icon'  =>'ion ion-pie-graph',
          'link'  =>route('admin.product.list', 'paid'),
       ])
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->

<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-8 connectedSortable">
      <!-- Custom tabs (Charts with tabs)-->
      @component('components.box', ['button'=>true, 'class'=>'box-solid'])
          @slot('title')
              <i class="fa fa-inbox"></i> Rapport de ventes et commandes
          @endslot
          
          <div id="revenue-chart" style="height: 250px; width: 100%;"></div>
      @endcomponent
      
      <!-- Map box -->
      @component('components.box', ['button'=>true, 'class'=>'box-solid bg-light-blue-gradient'])
          @slot('title')
              <i class="fa fa-map-marker"></i> Inscriptions
          @endslot
          
          <div id="world-map" style="height: 250px; width: 100%;"></div>
      @endcomponent
      
      <!-- TABLE: LATEST ORDERS -->
      @component('components.box', ['button'=>true, 'class'=>'box-info'])
          @slot('title')
              Latest Orders
          @endslot
          
          <div class="table-responsive">
            <table class="table no-margin">
              <thead>
              <tr>
                <th>Order ID</th>
                <th>Item</th>
                <th>Status</th>
              </tr>
              </thead>
              <tbody>
              @foreach($recent['orders'] as $order)
              <tr>
                <td><a href="pages/examples/invoice.html">{{'ORD'.$order->id}}</a></td>
                <td>{{$order->product?$order->product->title:''}}</td>
                <td><span class="label label-{{$order->getIconStatus()}}">{{$order->status}}</span></td>
              </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
          
          @slot('footer')
              <a href="{{route('admin.order.list')}}" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
          @endslot
      @endcomponent
      
    </section>
    <!-- /.Left col -->
    
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-4 connectedSortable">
     
      <!-- Map box -->
      @component('components.box', ['button'=>true, 'class'=>''])
          @slot('title')
              <i class="fa fa-map-marker"></i> Produits
          @endslot
          
          <div id="australia-map" style="height: 250px;"></div>
      @endcomponent
      
      <!-- USERS LIST -->
      @component('components.box', ['button'=>true, 'class'=>'box-danger'])
          @slot('title')
              Latest Members
          @endslot
          
          <ul class="users-list clearfix">
            @each('components.list.user', $recent['users'], 'user')
          </ul>
          <!-- /.users-list -->
          
          @slot('footer')
              <a href="{{route('admin.user.list')}}" class="uppercase">View All Users</a>
          @endslot
      @endcomponent

      <!-- PRODUCT LIST -->
      @component('components.box', ['button'=>true, 'class'=>'box-primary'])
          @slot('title')
              Recently Added Products
          @endslot
          
          <ul class="products-list product-list-in-box">
            @each('components.list.product', $recent['products'], 'product')
          </ul>
          
          @slot('footer')
              <a href="{{route('admin.product.list')}}" class="uppercase">View All Products</a>
          @endslot
      @endcomponent
      
    </section>
    <!-- right col -->
</div>
<!-- /.row (main row) -->
@endsection

@section('script')
@parent
<script>
  var visitorsData = {!!json_encode($data['users'])!!};
  // World map by jvectormap
  $('#world-map').vectorMap({
    map              : 'world_mill_en',
    backgroundColor  : 'transparent',
    regionStyle      : {
      initial: {
        fill            : '#e4e4e4',
        'fill-opacity'  : 1,
        stroke          : 'none',
        'stroke-width'  : 0,
        'stroke-opacity': 1
      }
    },
    series           : {
      regions: [
        {
          values           : visitorsData,
          scale            : ['#92c1dc', '#ebf4f9'],
          normalizeFunction: 'polynomial'
        }
      ]
    },
    onRegionTipShow: function (e, el, code) {
      if (typeof visitorsData[code] != 'undefined')
        el.html(el.html() + ': ' + visitorsData[code] + ' utilisateurs inscrits');
    }
  });
    
  var australiaData = {!!json_encode($data['products'])!!};
  $('#australia-map').vectorMap({
    map : 'au_mill',
    backgroundColor : 'transparent',
    zoomOnScroll: false,
    regionStyle : {
        initial : {
            fill : '#333333'
        }
    },
    series           : {
      regions: [
        {
          values           : australiaData,
          scale            : ['#333333', '#000000'],
          normalizeFunction: 'polynomial'
        }
      ]
    },
    onRegionTipShow: function (e, el, code) {
      if (typeof australiaData[code] != 'undefined')
        el.html(el.html() + ': ' + australiaData[code] + ' produits');
    }
  });
    
  // Sales chart
  var area = new Morris.Line({
    element   : 'revenue-chart',
    resize    : true,
    data      : {!!json_encode($data['orders'])!!},
    xkey      : 'date',
    ykeys     : ['count_1', 'count_2'],
    labels    : ['Vente', 'Vente+Commande'],
    lineColors: ['#00a65a', '#3c8dbc'],
    hideHover : 'auto'
  });

</script>
@endsection