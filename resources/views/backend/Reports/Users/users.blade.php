@extends('layouts.backend.master')

@section('header')
    @parent
    <title>System statistics</title>
@stop

@section('content')

    <div class="row">
        <div class="col-md-4">
            <h3>Users</h3>

            <div id="userCounty" style="height: 250px;">

            </div>

        </div>
    </div>

@stop

@section('scripts')
    @parent
    <script>
        $.get("/backend/reports/users/users-by-county").done(function (data) {

            console.log(data.id);

            $('#userCounty').highcharts({
                title: {
                    text: 'Users vs ages',
                    x: -20 //center
                },
                xAxis: {
                    categories: ['antony', 'caro', 'james', 'peter', 'anne']
                },
                yAxis: {
                    title: {
                        text: 'Ages (Years)'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    valueSuffix: 'years'
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: [{
                    name: 'Ages',
                    data: [18, 20, 22, 24, 20]
                }]
            });
        });
    </script>
@stop