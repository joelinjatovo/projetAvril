@extends('layouts.admin')

@section('content')
<div class="main-content container-fluid">
    <div id="page-content" class="page-content">
        <section>
            <div class="page-header">
                <h3>@lang('app.products')</h3>
            </div>
            <div class="row-fluid">
                <div class="span6 widget widget-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des produits par Etats</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <div id="chart-location" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <div class="span6 widget well well-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des produits par prix</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <div id="chart-price" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span6 widget widget-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des produits par type</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <div id="chart-category" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <div class="span6 widget well well-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des produits par vendeur</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <div id="chart-seller-type" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('administrator/amcharts/amcharts.js')}}"></script>
<script src="{{asset('administrator/amcharts/xy.js')}}"></script>
<script src="{{asset('administrator/amcharts/funnel.js')}}"></script>
<script src="{{asset('administrator/amcharts/pie.js')}}"></script>
<script src="{{asset('administrator/amcharts/serial.js')}}"></script>
<script src="{{asset('administrator/amcharts/gantt.js')}}"></script>
<script src="{{asset('administrator/amcharts/gauge.js')}}"></script>
<script src="{{asset('administrator/amcharts/radar.js')}}"></script>
<script type="text/javascript">
function drawCategoryChart($data){
    var chart = AmCharts.makeChart("chart-category", {
      "type": "serial",
      "theme": "light",
      "marginRight": 70,
      "dataProvider": $data,
      "valueAxes": [{
        "axisAlpha": 0,
        "position": "left",
        "title": "Nombres de produits"
      }],
      "startDuration": 1,
      "graphs": [{
        "balloonText": "<b>[[type]]: [[number]]</b>",
        "fillColorsField": "color",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "type": "column",
        "valueField": "number"
      }],
      "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
      },
      "categoryField": "type",
      "categoryAxis": {
        "gridPosition": "start",
        "labelRotation": 45
      },
      "export": {
        "enabled": true
      }
    });

}
function loadCategoryData() {
    $.ajax({
        url: "{{route('chart.categories')}}",
        ifModified:true,
        success: function(content){
            drawCategoryChart(content.data);
        }
    });
}
loadCategoryData();
    

function drawLocationChart($data){
    var chart = AmCharts.makeChart( "chart-location", {
      "type": "pie",
      "dataProvider": $data,
      "valueField": "number",
      "titleField": "state",
       "balloon":{
        "fixedPosition":true
      }
    });

}
function loadLocationData() {
    $.ajax({
        url: "{{route('chart.locations', ['type'=>'product'])}}",
        ifModified:true,
        success: function(content){
            drawLocationChart(content.data);
        }
    });
}
loadLocationData();
    
function drawPriceChart($data){
    var chart =  AmCharts.makeChart( "chart-price", {
        "type": "funnel",
        "theme": "light",
        "dataProvider": $data,
        "balloon": {
          "fixedPosition": true
        },
        "valueField": "number",
        "titleField": "label",
        "marginRight": 240,
        "marginLeft": 50,
        "startX": -500,
        "rotate": true,
        "labelPosition": "right",
        "balloonText": "[[label]]: [[number]]",
      }
    );

}
function loadPriceData() {
    $.ajax({
        url: "{{route('chart.prices')}}",
        ifModified:true,
        success: function(content){
            drawPriceChart(content.data);
        }
    });
}
loadPriceData();
    
function drawSellerChart($data){
    var chart = AmCharts.makeChart("chart-seller-type", {
      "type": "serial",
      "theme": "light",
      "marginRight": 70,
      "dataProvider": $data,
      "valueAxes": [{
        "axisAlpha": 0,
        "position": "left",
        "title": "Nombres de produits"
      }],
      "startDuration": 1,
      "graphs": [{
        "balloonText": "<b>[[type]]: [[number]]</b>",
        "fillColorsField": "color",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "type": "column",
        "valueField": "number"
      }],
      "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
      },
      "categoryField": "type",
      "categoryAxis": {
        "gridPosition": "start",
        "labelRotation": 45
      }
    });

}
function loadSellerData() {
    $.ajax({
        url: "{{route('chart.sellers')}}",
        ifModified:true,
        success: function(content){
            drawSellerChart(content.data);
        }
    });
}
loadSellerData();
    
function check_demande($url) {
    $.ajax({
        url: $url,
        ifModified:true,
        success: function(content){
            $('#demandes').html(content); //span où tu veux que ce nombre apparaisse
        }
    });
    setTimeout(check_demande, 5000);
}
//check_demande();
</script>
@show