@extends('pages.admin.master')

@section('title', 'Ubah Data Barang Masuk')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Ubah Data Barang Masuk</h1>
            <a href="{{ url('/admin/pemasok') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><span class="fa fa-chevron-left text-white-150"></span> Kembali</a>
        </div>

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Ubah Data Barang Masuk</h6>
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
                                <form action="{{ url('/admin/pemasok/' . $supplier->id) }}" method="post">
                                    @method('patch')
                                    @csrf
                                    <div class="form-group">
                                        <label for="kd_pemasok">Kode Supplier</label>
                                        <input type="text" class="form-control @error('kd_supplier') is-invalid @enderror" id="kd_pemasok" name="kd_supplier" placeholder="Masukkan Kode Pemasok..." value="{{ $supplier->kd_supplier }}" readonly>
                                        @error('kd_supplier')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="nama_pemasok">Nama Supplier</label>
                                        <input type="text" class="form-control @error('nama_supplier') is-invalid @enderror" id="nama_pemasok" name="nama_supplier" placeholder="Masukan Nama Pemasok..." value="{{ $supplier->nama_supplier }}" readonly>
                                        @error('nama_supplier')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="kd_barang">Kode Barang</label>
                                        <input type="text" class="form-control @error('kd_barang') is-invalid @enderror" id="kd_barang" name="kd_barang" placeholder="Masukan Kode Barang..."value="{{ $supplier->kd_barang }}" readonly>
                                        @error('kd_barang')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="qty">Qty</label>
                                        <input type="hidden" class="form-control" id="qty" name="before_qty" placeholder="Masukan Qty Barang..." value="{{ $supplier->qty }}">
                                        <input type="text" class="form-control @error('qty') is-invalid @enderror" id="qty" name="qty" placeholder="Masukan Qty Barang..." value="{{ $supplier->qty }}">
                                        @error('qty')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="harga_beli">Harga Pemasok</label>
                                        <input type="text" class="form-control @error('harga_beli') is-invalid @enderror" id="harga_beli" name="harga_beli" placeholder="Masukan Harga Pembelian..." value="{{ $supplier->harga_beli }}">
                                        @error('harga_beli')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl">Tanggal Barang Datang</label>
                                        <input type="date" class="form-control @error('tgl_barang_datang') is-invalid @enderror" id="tgl" name="tgl_barang_datang" placeholder="" value="{{ $supplier->tgl_barang_datang }}">
                                        @error('tgl_barang_datang')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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