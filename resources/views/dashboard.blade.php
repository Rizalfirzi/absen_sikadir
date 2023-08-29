@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <h4 class="pheader">Sistem Informasi Kehadiran Pegawai Direktorat Jenderal Cipta Karya</h4>
        <hr>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-5 d-flex align-items-strech">
                <div class="col-lg-10">
                    <img src="{{ asset('assets/img/att.PNG') }}" class='imgblur' style="width: 100%;">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="row">
                    <div class="col-lg-12 alert alert-info">
                        <!-- Yearly Breakup -->
                        Catatan :
                        <ul>
                            <li>Lupa absen dikenai sanksi sebanyak 240 menit </li>
                            <li>Lupa absen tidak dapat diganti / dihapus dengan izin atau dispensasi </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="container" class='col-md-12'>
                <!-- Chart container -->
                <div id="chartContainer" style="height: 300px;"></div>
            </div>
        </div>

        {{-- <div class="py-6 px-6 text-center">
            <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank"
                    class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a
                    href="https://themewagon.com">ThemeWagon</a></p>
        </div> --}}
    </div>
    </div>
    </div>
    
    <script src="{{ asset('js/chart/code/highcharts.js') }}"></script>
    <script src="{{ asset('js/chart/code/modules/exporting.js') }}"></script>
    <script src="{{ asset('js/chart/code/highchartv11-1-0.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/chart-data')
                .then(response => response.json())
                .then(data => {
                    const chart = Highcharts.chart('chartContainer', {
                        chart: {
                            type: 'pie'

                        },
                        title: {
                            text: 'Data Jumlah Pegawai Direktorat Jenderal Cipta Karya'
                        },
                        tooltip: {
                            pointFormat: '<b>{point.y:.0f} Pegawai</b>'
                            //pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.y:.0f} Pegawai',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme
                                            .contrastTextColor) || 'black'
                                    }
                                }
                            }
                        },
                        series: [{
                            name: 'Pegawai',
                            data: [
                                ['PNS', data.pns],
                                ['Non PNS Pendukung', data.pendukung],
                                ['Non PNS Substansi', data.substansi],
                                ['Bukan Non PNS', data.ki],
                            ]
                        }]
                    });
                });
        });
    </script>
@endsection
