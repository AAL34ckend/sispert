@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

<div class="row mt-3">
    <div class="col-12 col-lg-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            @guard(['user'])
                                Pengaduan Terkirim
                            @endguard
                            @guard(['admin', 'petugas'])
                                Pengaduan Masuk
                            @endguard
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $totalTerkirim }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-envelope fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4 mt-3 mt-lg-0">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pengaduan Diterima</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $totalDiterima }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-inbox fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4 mt-3 mt-lg-0">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pengaduan Diproses</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $totalDiproses }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12 col-lg-6">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pengaduan Selesai</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $totalSelesai }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-to-slot fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 mt-3 mt-lg-0">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pengaduan Ditolak</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $totalDitolak }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-rectangle-xmark fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12 col-lg-6">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="mb-0 text-primary font-weight-bold">Semua Pengaduan</h6>
            </div>
            <div class="card-body">
                <div id="donut-chart" style="width: 100%; height: 400px;"></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 mt-3 mt-lg-0">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="mb-0 text-primary font-weight-bold">Pengaduan 7 Hari Terakhir</h6>
            </div>
            <div class="card-body">
                <div id="line-chart" style="width: 100%; height: 400px;"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
const donutChartEl = document.getElementById('donut-chart');
const donutChart = echarts.init(donutChartEl);

donutChart.setOption({
  legend: {
    top: '5%',
    left: 'center'
  },
  series: [
    {
      name: 'Access From',
      type: 'pie',
      radius: ['40%', '70%'],
      avoidLabelOverlap: false,
      itemStyle: {
        borderRadius: 10,
        borderColor: '#fff',
        borderWidth: 2
      },
      label: {
        show: false,
        position: 'center'
      },
      emphasis: {
        label: {
          show: false,
          fontSize: 40,
          fontWeight: 'bold'
        }
      },
      labelLine: {
        show: false
      },
      data: [
        {
            value: {{ $totalTerkirim }},
            name: 'Masuk',
            itemStyle: {
                color: '#AB4459'
            }
        },
        {
            value: {{ $totalDiterima }},
            name: 'Diterima',
            itemStyle: {
                color: '#36b9cc'
            }
        },
        {
            value: {{ $totalDiproses }},
            name: 'Diproses',
            itemStyle: {
                color: '#f6c23e'
            }
        },
        {
            value: {{ $totalSelesai }},
            name: 'Selesai',
            itemStyle: {
                color: '#1cc88a'
            }
        },
        {
            value: {{ $totalDitolak }},
            name: 'Ditolak',
            itemStyle: {
                color: '#e74a3b'
            }
        },
      ]
    }
  ]
});

const lineChartEl = document.getElementById('line-chart');
const lineChart = echarts.init(lineChartEl);
const lineData = JSON.parse('<?= $lineChartData ?>');

lineChart.setOption({
  tooltip: {
    trigger: 'axis'
  },
  grid: {
    top: '2%',
    left: '3%',
    right: '7%',
    bottom: '10%',
    containLabel: true
  },
  xAxis: [
    {
      type: 'category',
      boundaryGap: false,
      data: lineData.map(item => item.tanggal)
    }
  ],
  yAxis: [
    {
      type: 'value'
    }
  ],
  series: [
    {
      name: 'Jumlah Pengaduan',
      type: 'line',
      stack: 'Total',
      data: lineData.map(item => item.total),
      itemStyle: {
        color: '#AB4459'
      }
    },
  ]
});
</script>
@endsection
