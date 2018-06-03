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
                        <h4>Utilisateurs recents</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <ul>
                            @foreach($recent['users'] as $user)
                                <li>{{$user->name}}</li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="span6 widget widget-simple">
                    <div class="widget-header">
                        <h4>Produits recents</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <ul>
                            @foreach($recent['products'] as $product)
                                <li>{{$product->title}}</li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12 widget widget-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des utilisateurs par date d'inscription</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <div id="chart-users" style="width: 100%; height: 400px;"></div>
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
    var chart = AmCharts.makeChart("chart-users", {
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
            "valueField": "count",
            "balloonText": "<span style='font-size:18px;'>[[count]]</span>"
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
var data = {!!$data!!};
drawCategoryChart(data.users);
</script>
@show