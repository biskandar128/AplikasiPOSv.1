@extends('pages.kasir.master')

@section('title', 'Halaman Dashboard')

@section('content')
        <div class="container-fluid">

              <!-- Page Heading -->
              <div class="d-sm-flex align-items-center justify-content-between mb-4">
                  <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
              </div>

              <!-- Content Row -->
              <div class="row">

                  <!-- Earnings (Monthly) Card Example -->
                  <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">
                      <div class="card-body">
                      <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Penghasilan (Harian)</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($biaya_perhari, 2, ',', '.') }}</div>
                          </div>
                          <div class="col-auto">
                          <i class="fas fa-calendar fa-2x text-gray-300"></i>
                          </div>
                      </div>
                      </div>
                  </div>
                  </div>

                  <!-- Earnings (Monthly) Card Example -->
                  <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-success shadow h-100 py-2">
                      <div class="card-body">
                      <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Penghasilan (Bulanan)</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($biaya_perbulan, 2, ',', '.') }}</div>
                          </div>
                          <div class="col-auto">
                          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                          </div>
                      </div>
                      </div>
                  </div>
                  </div>

                  <!-- Earnings (Monthly) Card Example -->
                  <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-info shadow h-100 py-2">
                      <div class="card-body">
                      <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Penghasilan (Tahunan)</div>
                          <div class="row no-gutters align-items-center">
                              <div class="col-auto">
                              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Rp. {{ number_format($biaya_pertahun, 2, ',', '.') }}</div>
                              </div>
                              <div class="col">
                                  <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                              
                              </div>
                          </div>
                          </div>
                          <div class="col-auto">
                          <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                          </div>
                      </div>
                      </div>
                  </div>
                  </div>

                  <!-- Pending Requests Card Example -->
                  <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-warning shadow h-100 py-2">
                      <div class="card-body">
                      <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah Transaksi (Perhari)</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_transaksi }}</div>
                          </div>
                          <div class="col-auto">
                          <i class="fas fa-comments fa-2x text-gray-300"></i>
                          </div>
                      </div>
                      </div>
                  </div>
                  </div>
              </div>

                  <!-- Area Chart -->
                  <div class="col-xl-12 col-lg-12 col-md-12">
                  <div class="card shadow mb-4">
                      <!-- Card Header - Dropdown -->
                      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                      </div>
                      <!-- Card Body -->
                      <div class="card-body">
                          <div id="container"></div>
                      </div>
                 </div>           
                 </div>
            </div>
@endsection

   {{-- {!! <-  jika array ada quote maka gunakan teknik ini  -> !!} --}}

@section('footer-js')
  <script>
  var jumlah = {{ json_encode($details) }}
  var bulan = {!! json_encode($detail) !!}
    Highcharts.chart('container', {
        chart: {
            type: 'area'
        },
        title: {
            text: 'Data Penjualan'
        },
        xAxis: {
            categories: bulan,
            tickmarkPlacement: 'on',
            title: {
                enabled: false
            }
        },
        yAxis: {
            title: {
                text: 'Pembeli'
            },
            labels: {
                formatter: function() {
                    return this.value ;
                }
            }
        },
        tooltip: {
            split: false,
            valueSuffix: ' Orang'
        },
        plotOptions: {
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },
        series: [{
            name: 'Jumlah',
            data: jumlah,
        }]
});
  
  </script>
@endsection