@extends('pages.admin.master')

@section('title', 'Detail Barang')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Data Stok Barang Keluar dalam Gudang</h1>
            <a href="{{ url('/admin/laporan-stok-out') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><span class="fa fa-chevron-left text-white-150"></span> Kembali</a>
        </div>

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Info Detail Data Stok Barang dalam Gudang</h6>
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

                        <table class="tg" width="40%">
                            <tr>
                                <td class="">No Transaksi</td>
                                <td class="">{{ $tanggal->kd_transaksi }}</td>
                            </tr>
                            <tr>
                                <td class="">Tanggal Transaksi</td>
                                <td class="">{{ $tanggal->tgl_transaksi }}</td>
                            </tr>
                        </table>

                        <br>
                        <table class="tg" width="100%" id="transaksi">
                            <tr align="center">
                                <th class="tg-031e">No</th>
                                <th class="tg-yw4l">Kode Barang</th>
                                <th class="tg-yw4l">Nama Barang</th>
                                <th class="tg-yw4l">Harga</th>
                                <th class="tg-yw4l">Qty</th>
                                <th class="tg-yw4l">Sub Total</th>
                            </tr>
                            
                            @foreach($reports as $report)
                            <tr align="center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $report->kd_barang }}</td>
                                <td>{{ $report->nama_barang }}</td>
                                <td>{{ $report->harga_jual }}</td>
                                <td>{{ $report->qty }}</td>
                                <td>{{ $report->sub_total }}</td>
                            </tr>
                            @endforeach
                            
                            <tr align="center">
                                <td colspan="5" style="text-align:right"><b>Total Harga : </b></td>
                                <td><b>{{ $sum   }}</b></td>
                            </tr>
                        </table>

                    </div>
                    
                </div>
            </div>

        </div>
    </div>
@endsection