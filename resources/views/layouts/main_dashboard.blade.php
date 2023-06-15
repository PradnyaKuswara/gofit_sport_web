@extends('layouts/dashboard_layout')

@section('judul')
    Dashboard Main
@endsection

@section('main')
    <div class="card p-5 rounded-4 shadow-sm">
        <div class="card-body ">
            <div class="alert alert-warning">
                Hello {{ $user->NAMA_PEGAWAI }}, your role is {{ $user->ROLE_PEGAWAI }}
            </div>
        </div>
        <!-- /.card-body -->
        <!-- /.card-footer-->
    </div>

    @if ($user->ROLE_PEGAWAI == 'Manajer Operasional')
        <div class="card mt-5">
            <div class="card-body mr-5">
                <canvas id="myChartDashboard" height="100px"></canvas>
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-body mr-5">
                <canvas id="myChartDashboard2" height="100px"></canvas>
            </div>
        </div>
    @endif
@endsection

@section('footer-script')
    <script type="text/javascript">
        var year = {{ Js::from($year) }};
        var label = {{ Js::from($report_keys) }}
        var value = {{ Js::from($report_value) }}

        console.log(value)

        const data = {
            labels: label,
            datasets: [{
                label: 'Laporan Transaksi Deposit dan Aktivasi ' + year,
                backgroundColor: 'rgb(249, 226, 175)',
                borderColor: 'rgb(255,0,0)',
                borderWidth: 1,
                data: value,
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        const config2 = {
            type: 'line',
            data: data,
            options: {}
        };

        const myChart = new Chart(
            document.getElementById('myChartDashboard'),
            config
        );

        const myChart2 = new Chart(
            document.getElementById('myChartDashboard2'),
            config2
        );
    </script>
@endsection
