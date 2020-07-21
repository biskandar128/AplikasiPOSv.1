@extends('pages.kasir.master')

@section('title', 'Jenis Barang')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Laporan Aktifitas Perusahaan</h1>
        </div>
        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Info Aktifitas Perusahaan</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        

                               <div class="table-responsive text-nowrap">
                                <!--Table-->
                                <table class="table table-bordered" id="tabel_aktifitas">

                                <!--Table head-->
                                <thead>
                                    <tr>
                                    <th>#</th>
                                    <th>Kode Aktifitas</span>
                                    <th>Tanggal Aktifitas</span>
                                    <th>Total Biaya dikeluarkan</span>                                    
                                    </tr>
                                </thead>
                                <!--Table head-->

                                <!--Table body-->
                                <tbody>

                                @foreach ($details as $detail)
                                <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td><a href="{{ url('laporan-aktifitas/' . $detail->kd_aktivitas . '/detail') }}">{{ $detail->kd_aktivitas }}</a></td>
                                <td>{{ $detail->tgl_aktifitas }}</td>
                                <td>Rp. {{ number_format($detail->total_biaya, 2, ',', '.') }}</td>
                                </tr>
                                @endforeach

                                </tbody>
                                <!--Table body-->


                                </table>
                                <!--Table-->
                            </div>
                        </section>
                        <!--Section: Live preview-->


                    </div>
                    
                </div>
            </div>

        </div>
    </div>
@endsection