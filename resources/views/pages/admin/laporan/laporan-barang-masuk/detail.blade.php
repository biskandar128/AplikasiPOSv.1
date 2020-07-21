@extends('pages.admin.master')

@section('title', 'Detail Barang')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Data Barang dalam Gudang</h1>
        </div>

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Info Detail Data Barang dalam Gudang</h6>
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
                                <table class="table table-striped">

                                <!--Table head-->
                                <thead>
                                    <tr>
                                    <th>#</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Kode Jenis Barang</th>
                                    <th>Berat Barang</th>
                                    <th>Stok(gudang)</th>
                                    <th>Stok(keluar)</th>
                                    <th>Harga Jual</th>
                                    <th>Status Harga</th>
                                    </tr>
                                </thead>
                                <!--Table head-->

                                <!--Table body-->
                                <tbody>

                                @foreach ($details as $detail)
                                    <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td><a href="{{ url('laporan-barang-masuk/detail-stok/'. $detail->kd_barang) }}">{{ $detail->kd_barang }}</a></td>
                                    <td>{{ $detail->nama_barang }}</td>
                                    <td>{{ $detail->kd_jenis }}</td>
                                    <td>{{ $detail->berat }}</td>
                                    <td>{{ $detail->stok }}</td>
                                    <td>{{ $detail->stok_out }}</td>
                                    <td>{{ $detail->harga_jual }}</td>
                                    <td>{{ $detail->status_harga }}</td>
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