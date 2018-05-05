@extends('layouts.admin')

@section('content')
<div class="main-content container-fluid">
    <div id="page-content" class="page-content">
        <section>
            <div class="page-header">
                <h3>Repartition des produits par type</h3>
            </div>
            <div class="row-fluid">
                <div class="widget widget-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i></h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <div id="chart" style="width: 100%; height: 400px;"></div>
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
function loadData() {
    $.ajax({
        url: "{{route('chart.categories')}}",
        ifModified:true,
        success: function(content){
            drawChart(content.data);
        }
    });
}
loadData();
function drawChart($data){
    var chart = AmCharts.makeChart("chart", {
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
        "balloonText": "<b>[[type]]: [[nombre]]</b>",
        "fillColorsField": "color",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "type": "column",
        "valueField": "nombre"
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
</script>
@show