@extends('layouts.admin')

@section('content')
<div class="main-content container-fluid">
    <div id="page-content" class="page-content">
        <section>
            <div class="page-header">
                <h3>@lang('app.dashboard')</h3>
            </div>
            <div class="row-fluid">
                <div class="span6 widget widget-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des APL par Etats</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <div id="chart-location" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <div class="span6 widget well well-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des APL par date</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <div id="chart-date" style="width: 100%; height: 300px;"></div>
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
<script src="{{asset('administrator/amcharts/graphddde.js')}}"></script>
<script type="text/javascript">
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
        url: "{{route('chart.locations', array('type'=>'apl'))}}",
        ifModified:true,
        success: function(content){
            drawLocationChart(content.data);
        }
    });
}
loadLocationData();
    
function drawDateChart($data){
    var chart = AmCharts.makeChart("chart-date", {
        "type": "serial",
        "theme": "light",
        "marginRight": 40,
        "marginLeft": 40,
        "autoMarginOffset": 20,
        "mouseWheelZoomEnabled":true,
        "dataDateFormat": "YYYY-MM-DD",
        "valueAxes": [{
            "id": "v1",
            "axisAlpha": 0,
            "position": "left",
            "ignoreAxisWidth":true
        }],
        "balloon": {
            "borderThickness": 1,
            "shadowAlpha": 0
        },
        "graphs": [{
            "id": "g1",
            "balloon":{
              "drop":true,
              "adjustBorderColor":false,
              "color":"#ffffff"
            },
            "bullet": "round",
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "bulletSize": 5,
            "hideBulletsCount": 50,
            "lineThickness": 2,
            "title": "red line",
            "useLineColorForBulletBorder": true,
            "valueField": "number",
            "balloonText": "<span style='font-size:18px;'>[[number]]</span>"
        }],
        "chartScrollbar": {
            "graph": "g1",
            "oppositeAxis":false,
            "offset":30,
            "scrollbarHeight": 80,
            "backgroundAlpha": 0,
            "selectedBackgroundAlpha": 0.1,
            "selectedBackgroundColor": "#888888",
            "graphFillAlpha": 0,
            "graphLineAlpha": 0.5,
            "selectedGraphFillAlpha": 0,
            "selectedGraphLineAlpha": 1,
            "autoGridCount":true,
            "color":"#AAAAAA"
        },
        "chartCursor": {
            "pan": true,
            "valueLineEnabled": true,
            "valueLineBalloonEnabled": true,
            "cursorAlpha":1,
            "cursorColor":"#258cbb",
            "limitToGraph":"g1",
            "valueLineAlpha":0.2,
            "valueZoomable":true
        },
        "valueScrollbar":{
          "oppositeAxis":false,
          "offset":50,
          "scrollbarHeight":10
        },
        "categoryField": "date",
        "categoryAxis": {
            "parseDates": true,
            "dashLength": 1,
            "minorGridEnabled": true
        },
        "export": {
            "enabled": true
        },
        "dataProvider" : $data
      });

}
function loadDateData() {
    $.ajax({
        url: "{{route('chart.dates', array('role'=>'apl'))}}",
        ifModified:true,
        success: function(content){
            drawDateChart(content.data);
        }
    });
}
loadDateData();
    
</script>
@show