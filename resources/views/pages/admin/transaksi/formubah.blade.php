@extends('pages.admin.master')

@section('title', 'Ubah Data Transaksi')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Ubah Data Transaksi</h1>
            <a href="{{ url('/admin/transaksi') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><span class="fa fa-chevron-left text-white-150"></span> Kembali</a>
        </div>

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Ubah Data Transaksi</h6>
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
                        

                                {{--  Form Barang Masuk  --}}
                                <form action="{{ url('/admin/transaksi-update/' . $updates->kd_transaksi ) }}" method="post">
                                    @method('patch')
                                    @csrf
                                    <div class="form-group">
                                        <label for="kd_barang">Kode Barang</label>
                                        <input type="hidden" name="tgl_transaksi" value="{{ $updates->tgl_transaksi }}" readonly>
                                        <input type="text" class="form-control" id="kd_barang" name="kd_barang" value="{{ $updates->kd_barang }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="nama_barang">Nama Barang</label>
                                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ $updates->nama_barang }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="harga">Harga Barang</label>
                                        <input type="text" class="form-control" id="harga_barang" onKeyUp="sum();" name="harga" value="{{ $updates->harga }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="qty">Qty</label>
                                        <input type="hidden" class="form-control" name="before_qty" placeholder="Masukan Qty Barang..." value="{{ $updates->qty }}">
                                        <input type="text" class="form-control" id="qty" name="qty" onKeyUp="sum();" placeholder="Masukan Qty Barang..." value="{{ $updates->qty }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="sub_total">Sub Total</label>
                                        <input type="text" class="form-control" id="sub_total" name="sub_total" placeholder="" readonly value="{{ $updates->sub_total }}">
                                    </div>
                                            
                                    
                                    <button class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                        <i class="fas fa-edit"></i>
                                        </span>
                                        <span class="text">Ubah Data</span>
                                    </button>

                                </form>
                                {{--  End of Form Barang Masuk  --}}


                    </div>
                    
                </div>
            </div>

        </div>
    </div>
@endsection