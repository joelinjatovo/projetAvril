@extends('layouts.lte')

@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{$count['users']}}</h3>
          <p>Utilisateurs inscrits</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="{{route('admin.user.list')}}" class="small-box-footer">Savoir plus <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{$count['products']}}</h3>
          <p>Produits enregistrés</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="{{route('admin.product.list')}}" class="small-box-footer">Savoir plus <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{$count['orders']}}</h3>
          <p>Commandes</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="{{route('admin.product.list', 'ordered')}}" class="small-box-footer">Savoir plus <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>{{$count['sales']}}</h3>
          <p>Ventes éffectuées</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="{{route('admin.product.list', 'paid')}}" class="small-box-footer">Savoir plus <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->

<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-8 connectedSortable">
      <!-- Custom tabs (Charts with tabs)-->
      <div class="box box-solid">
        <div class="box-header">
          <!-- tools box -->
          <div class="pull-right box-tools">
            <button type="button" class="btn btn-sm pull-right" data-widget="collapse"
                    data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
              <i class="fa fa-minus"></i></button>
          </div>
          <!-- /. tools -->

          <i class="fa fa-inbox"></i>

          <h3 class="box-title">
            Rapport de ventes et commandes
          </h3>
        </div>
        <div class="box-body">
          <div id="revenue-chart" style="height: 250px; width: 100%;"></div>
        </div>
        <!-- /.box-body-->
      </div>
      
      <!-- Map box -->
      <div class="box box-solid bg-light-blue-gradient">
        <div class="box-header">
          <!-- tools box -->
          <div class="pull-right box-tools">
            <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse"
                    data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
              <i class="fa fa-minus"></i></button>
          </div>
          <!-- /. tools -->

          <i class="fa fa-map-marker"></i>

          <h3 class="box-title">
            Inscriptions
          </h3>
        </div>
        <div class="box-body">
          <div id="world-map" style="height: 250px; width: 100%;"></div>
        </div>
        <!-- /.box-body-->
      </div>
      <!-- /.box -->
      
      <!-- TABLE: LATEST ORDERS -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Latest Orders</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
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
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <a href="{{route('admin.order.list')}}" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
        </div>
        <!-- /.box-footer -->
      </div>
      <!-- /.box -->
      
    </section>
    <!-- /.Left col -->
    
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-4 connectedSortable">
     
      <!-- Produits box -->
      <div class="box">
        <div class="box-header">
          <!-- tools box -->
          <div class="pull-right box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </div>
          <!-- /. tools -->

          <i class="fa fa-map-marker"></i>

          <h3 class="box-title">
            Produits
          </h3>
        </div>
        <div class="box-body">
         <div id="australia-map" style="height: 250px;"></div>
        </div>
        <!-- /.box-body-->
      </div>
      <!-- /.box -->
      
      <!-- USERS LIST -->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Latest Members</h3>

          <div class="box-tools pull-right">
            <span class="label label-danger">8 New Members</span>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <ul class="users-list clearfix">
            @foreach($recent['users'] as $user)
            <li>
              <img src="{{$user->imageUrl()}}" alt="{{$user->fullname()}}">
              <a class="users-list-name" href="#">{{$user->fullname()}}</a>
              <span class="users-list-date">{{$user->created_at->diffForHumans()}}</span>
            </li>
            @endforeach
          </ul>
          <!-- /.users-list -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-center">
          <a href="{{route('admin.user.list')}}" class="uppercase">View All Users</a>
        </div>
        <!-- /.box-footer -->
      </div>
      <!--/.box -->

      <!-- PRODUCT LIST -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Recently Added Products</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <ul class="products-list product-list-in-box">
            @foreach($recent['products'] as $product)
            <li class="item">
              <div class="product-img">
                <img src="{{$product->imageUrl(true)}}" alt="Product Image">
              </div>
              <div class="product-info">
                <a href="{{route('admin.product.show', $product)}}" class="product-title">{{$product->title}}
                  <span class="label label-warning pull-right">{{$product->getPrice()}}</span></a>
                <span class="product-description">{{$product->excerpt()}}</span>
              </div>
            </li>
            <!-- /.item -->
            @endforeach
          </ul>
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-center">
          <a href="{{route('admin.product.list')}}" class="uppercase">View All Products</a>
        </div>
        <!-- /.box-footer -->
      </div>
      <!-- /.box -->
      
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

  // Donut Chart
  var donut = new Morris.Donut({
    element  : 'sales-chart',
    resize   : true,
    colors   : ['#3c8dbc', '#f56954', '#00a65a'],
    data     : [
      { label: 'Download Sales', value: 12 },
      { label: 'In-Store Sales', value: 30 },
      { label: 'Mail-Order Sales', value: 20 }
    ],
    hideHover: 'auto'
  });
    
  var line = new Morris.Line({
    element          : 'line-chart',
    resize           : true,
    data             : [
      { y: '2011 Q1RT', item1: 2666 },
      { y: '2011 Q2', item1: 2778 },
      { y: '2011 Q3', item1: 4912 },
      { y: '2011 Q4', item1: 3767 },
      { y: '2012 Q1', item1: 6810 },
      { y: '2012 Q2', item1: 5670 },
      { y: '2012 Q3', item1: 4820 },
      { y: '2012 Q4', item1: 15073 },
      { y: '2013 Q1', item1: 10687 },
      { y: '2013 Q2', item1: 8432 }
    ],
    xkey             : 'y',
    ykeys            : ['item1'],
    labels           : ['Item 1'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    gridTextSize     : 10
  });
</script>
@endsection