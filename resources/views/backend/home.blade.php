@extends('backend.layouts.app')

@section('content')

    <style>
        .axisLabel {
            position: absolute;
            text-align: center;
            font-size: 12px;
        }

        .xaxisLabel {
            bottom: 3px;
            left: 0;
            right: 0;
        }

        .yaxisLabel {
            top: 50%;
            left: 2px;
            transform: rotate(-90deg);
            -o-transform: rotate(-90deg);
            -ms-transform: rotate(-90deg);
            -moz-transform: rotate(-90deg);
            -webkit-transform: rotate(-90deg);
            transform-origin: 0 0;
            -o-transform-origin: 0 0;
            -ms-transform-origin: 0 0;
            -moz-transform-origin: 0 0;
            -webkit-transform-origin: 0 0;
        }
    </style>

    <div class="p-w-md m-t-sm">

        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab-1"> Dashboard</a></li>
{{--                <li class=""><a data-toggle="tab" href="#tab-2"> Data Poliklinik</a></li>--}}
{{--                <li class=""><a data-toggle="tab" href="#tab-3"> Data Kunjungan Terbanyak</a></li>--}}
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="widget style1 lazur-bg">
                                    <div class="row">
                                        <div class="col-xs-8 text-right">
                                            <span> Total Jaringan  </span>
                                            <h2 class="font-bold">{{ $totjaringan }} OPD</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="widget style1 lazur-bg">
                                    <div class="row">
                                        <div class="col-xs-6 text-center">
                                            <span> Total Aplikasi Diskominfo </span>
                                            <h2 class="font-bold" >{{ $totaplikasi_kominfo }} </h2>
                                        </div>
                                        <div class="col-xs-6 text-center">
                                            <span> Total Aplikasi Non Diskominfo </span>
                                            <h2 class="font-bold">{{ $totaplikasi_non}} </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <h1 class="m-b-xs">
                                    {{ $totmonaplikasi }}
                                </h1>
                                <small>
                                    Total Error Monitoring Aplikasi 3 bulan terakhir
                                </small>
                                <div id="sparkline1" class="m-b-sm"></div>
                                <div class="row">
                                    <div class="col-xs-3">
                                        <small class="stats-label">Bulan kemarin</small>
                                        <h4>{{ $listaplikasimonth[1] }}</h4>
                                    </div>

                                    <div class="col-xs-3">
                                        <small class="stats-label">Bulan ini</small>
                                        <h4>{{ $listaplikasimonth[2]  }}</h4>
                                    </div>
                                    <div class="col-xs-3">
                                        <small class="stats-label">Hari ini</small>
                                        <h4>{{ $maplikasinow->jumlah_harian }}</h4>
                                    </div>

                                </div>

                            </div>
                            <div class="col-sm-4">
                                <h1 class="m-b-xs">
                                    {{ $totmonjaringan }}
                                </h1>
                                <small>
                                    Total Error Monitoring Jaringan 3 bulan terakhir
                                </small>
                                <div id="sparkline2" class="m-b-sm"></div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <small class="stats-label">Bulan kemarin</small>
                                        <h4>{{ $listjaringanmonth[1] }}</h4>
                                    </div>

                                    <div class="col-xs-4">
                                        <small class="stats-label">Bulan ini</small>
                                        <h4>{{ $listjaringanmonth[2]  }}</h4>
                                    </div>
                                    <div class="col-xs-4">
                                        <small class="stats-label">Hari ini</small>
                                        <h4>{{ $mjaringannow->jumlah_harian  }}</h4>
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <h1 class="m-b-xs">
                                    {{ $totmonserver }}
                                </h1>
                                <small>
                                    Total Monitoring Error Server 3 bulan terakhir
                                </small>
                                <div id="sparkline3" class="m-b-sm"></div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <small class="stats-label">Bulan kemarin</small>
                                        <h4>{{ $listservermonth[1] }}</h4>
                                    </div>

                                    <div class="col-xs-4">
                                        <small class="stats-label">Bulan ini</small>
                                        <h4>{{ $listservermonth[2]  }}</h4>
                                    </div>
                                    <div class="col-xs-4">
                                        <small class="stats-label">Hari ini</small>
                                        <h4>{{  $mservernow->jumlah_harian  }}</h4>
                                    </div>
                                </div>


                            </div>




                        </div>
                        {{--//test--}}
                        <div class="ibox-tools">
                            <form role="form" class="form-inline" action="{{ route('backend.home') }}"
                                  method="GET">
                                <div class="form-group">
                                    <input type="text" id="pilyear" name="pilyear" value={{  $pilyear2 }} required>
                                </div>
                                <button class="btn btn-white" type="submit">Cari</button>
                            </form>
                        </div>

                        {{--                                test--}}


                        <div class="row">
                            <table class="col-lg-12">




                                <tr>
                                    <td style="width: 3%;transform: rotate(-90deg);"><b>Total</b></td>
                                    <td style="width: 97%;">
                                        <canvas id="lineChart" height="70"></canvas>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <center><b> Data Error Monitoring Harian Bulan {{ $bulan_ini }}
                                            Tahun {{$tahun_ini}}


                                            </b></center>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <br>
                    </div>
                </div>

            </div>


        </div>

    </div>

@endsection

@section('onpage-js')
    <!-- Flot -->
    <script src="{{ asset('plugin-inspinia/js/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('plugin-inspinia/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset('plugin-inspinia/js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ asset('plugin-inspinia/js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('plugin-inspinia/js/plugins/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('plugin-inspinia/js/plugins/flot/jquery.flot.symbol.js') }}"></script>
    <script src="{{ asset('plugin-inspinia/js/plugins/flot/jquery.flot.time.js') }}"></script>


    <!-- Sparkline -->
    <script src="{{ asset('plugin-inspinia/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

    @include('backend.layouts.message')

    <!-- ChartJS-->
    <script src=" {{ asset('plugin-inspinia/js/plugins/chartJs/Chart.min.js') }} "></script>

    <script>
        $(document).ready(function () {

            var sparklineCharts = function () {


                var aplikasibulanan = {{ $maplikasimonth }};
                var jaringanbulanan = {{ $mjaringanmonth }};
                var serverbulanan = {{ $mservermonth }};

                {{--var weekly = {{ $bulanan }};--}}




                $("#sparkline1").sparkline(aplikasibulanan, {
                    type: 'line',
                    width: '100%',
                    height: '50',
                    lineColor: '#1ab394',
                    fillColor: "transparent"
                });

                $("#sparkline2").sparkline(jaringanbulanan, {
                    type: 'line',
                    width: '100%',
                    height: '50',
                    lineColor: '#1ab394',
                    fillColor: "transparent"
                });

                $("#sparkline3").sparkline(serverbulanan, {
                    type: 'line',
                    width: '100%',
                    height: '50',
                    lineColor: '#1C84C6',
                    fillColor: "transparent"
                });
            };

            var sparkResize;

            $(window).resize(function (e) {
                clearTimeout(sparkResize);
                sparkResize = setTimeout(sparklineCharts, 500);
            });

            sparklineCharts();

            var apharian = {{ $apharian }};
            var hari = {{ $hari }};
            var jaharian = {{ $jaharian }};
            var serharian = {{ $serharian }};




            var lineData = {

                title: {
                    text: 'Date'
                },

                labels: hari,//["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "Aplikasi ",
                        backgroundColor: "rgba(26,179,148,0.5)",
                        borderColor: "rgba(26,179,148,0.7)",
                        pointBackgroundColor: "rgba(26,179,148,1)",
                        pointBorderColor: "#fff",
                        data: apharian // [28, 48, 40, 19, 100, 27, 90]
                    },
                    {
                        label: "Jaringan",
                        backgroundColor: "rgba(255, 100, 90)",
                        borderColor: "rgba(255, 20, 60)",
                        pointBackgroundColor: "rgba(255, 20, 20)",
                        pointBorderColor: "#fff",
                        data: jaharian //[65, 59, 80, 81, 56, 55, 40]
                    }
                    ,
                    {
                        label: "Server",
                        backgroundColor: "rgba(255, 255, 51)",
                        borderColor: "rgba(255, 255, 0)",
                        pointBackgroundColor: "rgba(0, 0,255)",
                        pointBorderColor: "#fff",
                        data: serharian
                    }
                ]
            };

            var lineOptions = {
                responsive: true
            };


            var ctx = document.getElementById("lineChart").getContext("2d");
            new Chart(ctx, {type: 'line', data: lineData, options: lineOptions});

        });

        // /date
        $('#pilyear').datepicker({
            format: "yyyy-mm",
            todayBtn: "linked",
            keyboardNavigation: false,
            viewMode: "months",
            minViewMode: "months",
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });
    </script>
@endsection
