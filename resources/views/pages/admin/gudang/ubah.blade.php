@extends('pages.admin.master')

@section('title', 'Ubah Data Stok Barang')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Ubah Data Stok Barang dalam Gudang</h1>
            <a href="{{ url('/admin/gudang') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><span class="fa fa-chevron-left text-white-150"></span> Kembali</a>
        </div>

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Ubah Data Stok Barang dalam Gudang</h6>
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
                                <form action="{{ url('/admin/gudang/' . $gudang->id) }}" method="post">
                                    @method('patch')
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label for="kd_gudang">Kode Gudang</label>
                                        <input type="text" id="kd_gudang" class="form-control" name="kd_gudang" readonly value="{{ $gudang->kd_gudang }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="kd_pemasok">Kode Supplier</label>
                                        <input type="text" id="kd_pemasok" class="form-control" name="kd_pemasok" readonly value="{{ $gudang->kd_supplier }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="kd_barang">Kode Barang</label>
                                        <input type="text" id="kd_barang" class="form-control" name="kd_barang" readonly value="{{ $gudang->kd_barang }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="harga_pemasok">Harga Supplier (Rp)</label>
                                        <input type="text" class="form-control" id="harga_pemasok" name="harga_supplier" readonly value="{{ $gudang->harga_supplier }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="harga_jual">Harga Jual (Rp)</label>
                                        <input type="number" id="harga_jual" class="form-control @error('harga_jual') is-invalid @enderror" name="harga_jual" value="{{ $gudang->harga_jual }}">
                                        @error('harga_jual')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="stok">Stok Barang</label>
                                        <input type="number" id="stok" class="form-control" name="stok" readonly value="{{ $gudang->stok }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="status_harga">Status Harga</label>
                                        <select id="status_harga" class="form-control" name="status_harga">
                                            <option value="Harga Tidak Aktif" @if( $gudang->status_harga === 'Harga Tidak Aktif' ) {{ 'selected' }} @else {{ '' }}  @endif>Harga Tidak Aktif</option>
                                            <option value="Harga Aktif" @if( $gudang->status_harga === 'Harga Aktif' ) {{ 'selected' }} @else {{ '' }}  @endif>Harga Aktif</option>
                                        </select>
                                    </div>
                                    
                                    <button class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                        <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text">Simpan Data</span>
                                    </button>
                                </form>
                                {{--  End of Form Barang Masuk  --}}


                    </div>
                    
                </div>
            </div>

        </div>
    </div>
@endsection